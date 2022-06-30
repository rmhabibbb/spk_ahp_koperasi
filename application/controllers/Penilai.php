<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Penilai extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 2))
          {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus login terlebih dahulu', 'danger');
            redirect('login');
            exit;
          }  
    
    $this->load->model('login_m');  
    $this->load->model('Koperasi_m');   
    $this->load->model('DanaBantuan_m');   
    $this->load->model('Kriteria_m');         
    $this->load->model('Subkriteria_m');     
    $this->load->model('Penilai_m');     
    $this->load->model('Penilaian_m');        
    $this->load->model('MPKriteria_m');      
    $this->load->model('MPSubKriteria_m');        
    $this->load->model('IR_m');        
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]);  
    $this->data['p-penilai'] = $this->Penilai_m->get_row(['email' =>$this->data['email'] ]);   
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{    
      $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,['status > ' => 0]);
      $this->data['index'] = 1;
      $this->data['content'] = 'penilai/danabantuan';
      $this->template($this->data,'penilai');
}


public function danabantuan()
{     

  if ($this->POST('inputnilai')) { 
        
    $i = 0; 
    $nilai = $this->POST('kriteria');
    $list_kriteria = $this->Kriteria_m->get();

    foreach ($list_kriteria as $k) {
      if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) >= 2) {
        $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);

        foreach ($list_sub as $s) {
          $data = [  
            'id_penilai ' => $this->data['p-penilai']->id_penilai, 
            'id_koperasi ' => $this->POST('id_koperasi'),  
            'id_kriteria  ' => $k->id_kriteria, 
            'subkriteria' => $s->nama_sub,
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
        }
      }else{
         $data = [  
            'id_penilai ' => $this->data['p-penilai']->id_penilai, 
            'id_koperasi ' => $this->POST('id_koperasi'),  
            'id_kriteria  ' => $k->id_kriteria, 
            'subkriteria' => '-',
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
      }

    }

    

    $this->flashmsg2('Penilaian berhasil diinput', 'success');
    redirect('penilai/danabantuan/'.$this->POST('id_danabantuan'));
    exit();  
  } 
  if ($this->POST('editnilai')) { 
        
    $this->Penilaian_m->delete_by(['id_koperasi' => $this->POST('id_koperasi')]);
    $i = 0; 
    $nilai = $this->POST('kriteria');
    $list_kriteria = $this->Kriteria_m->get();

    foreach ($list_kriteria as $k) {
      if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) >= 2) {
        $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);

        foreach ($list_sub as $s) {
          $data = [  
            'id_penilai ' => $this->data['p-penilai']->id_penilai, 
            'id_koperasi ' => $this->POST('id_koperasi'),  
            'id_kriteria  ' => $k->id_kriteria, 
            'subkriteria' => $s->nama_sub,
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
        }
      }else{
         $data = [  
            'id_penilai ' => $this->data['p-penilai']->id_penilai, 
            'id_koperasi ' => $this->POST('id_koperasi'),  
            'id_kriteria  ' => $k->id_kriteria, 
            'subkriteria' => '-',
            'nilai  ' => $nilai[$i]
          ];
          $this->Penilaian_m->insert($data);
          $i++;
      }

    }

    

    $this->flashmsg2('Penilaian berhasil diedit', 'success');
    redirect('penilai/danabantuan/'.$this->POST('id_danabantuan'));
    exit();  
  } 
  elseif ($this->POST('deletenilai')) {
    if ($this->Penilaian_m->delete_by(['id_koperasi' => $this->POST('id_koperasi')])) {
      $this->flashmsg2('Penilaian berhasil dihapus.', 'success');
      redirect('penilai/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }
  }


  elseif ($this->POST('selesai')) { 
        
  
    if ($this->DanaBantuan_m->update($this->POST('id'),['status' => 2])) { 
      $this->flashmsg2('Berhasil ke tahap penilaian', 'success');
      redirect('penilai/danabantuan/'.$this->POST('id'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/danabantuan/'.$this->POST('id'));
      exit();  
    }
  } 
  
  elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);



    $this->data['danabantuan'] = $this->DanaBantuan_m->get_row(['id_danabantuan' => $id]);

    if($this->data['danabantuan']->status == 2){
      $ahp = $this->Penilaian_m->ahp($id); 

      $this->data['rank'] = $ahp['rank'];
    }
    $this->data['list_koperasi'] = $this->Koperasi_m->get(['id_danabantuan' => $id]);
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 1  ;
    $this->data['content'] = 'penilai/detaildb';
    $this->template($this->data,'penilai');
  }
  else {
      $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,['status > ' => 0]);
    $this->data['index'] = 1  ;
    $this->data['content'] = 'penilai/danabantuan';
    $this->template($this->data,'penilai');
  }
}

public function ahp()
{     
  if ($this->uri->segment(3)) {
    $id = $this->uri->segment(3); 

    $this->data['danabantuan'] = $this->DanaBantuan_m->get_row(['id_danabantuan' => $id]);

    if($this->data['danabantuan']->status == 2){
      $ahp = $this->Penilaian_m->ahp($id); 

      $this->data['rank'] = $ahp['rank'];
      $this->data['prioo'] = $ahp['prioo'];
      $this->data['hasil'] = $ahp['hasil'];
      $this->data['mp'] = $ahp['mp'];

       
      $this->data['eigen'] = $ahp['eigen'];
      $this->data['nilai_awal'] = $ahp['nilai_awal'];
    }
    $this->data['list_koperasi'] = $this->Koperasi_m->get(['id_danabantuan' => $id]);
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 1  ;
    $this->data['content'] = 'penilai/ahp';
    $this->template($this->data,'penilai');
  }
  else {
    redirect('penilai');
    exit();
  }
}

public function kriteria()
{     

  if ($this->POST('add')) {  
     
    $data = [
      'nama_kriteria' => $this->POST('nama') ,
      'inisial' => $this->POST('inisial') 
    ];

    if ($this->Kriteria_m->insert($data)) {
      $id = $this->db->insert_id();

      $list_kriteria = $this->Kriteria_m->get();

      foreach ($list_kriteria as $k) {
        if ($k->id_kriteria == $id) {
          $nilai = 1;
        }else {
          $nilai = 0;
        }
        $data = [
          'id_kriteria' => $id,
          'id_kriteria_2' => $k->id_kriteria,
          'nilai' => $nilai
        ];
        $this->MPKriteria_m->insert($data);
      }

      foreach ($list_kriteria as $k) {

        if ($this->MPKriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria, 'id_kriteria_2' => $id]) == 0) {
          if ($k->id_kriteria != $id) {
               $data = [
                'id_kriteria' => $k->id_kriteria,
                'id_kriteria_2' => $id,
                'nilai' => 0
              ];
              $this->MPKriteria_m->insert($data);
            } 
           
          }
      }
        

      $this->flashmsg2('Dana Bantuan berhasil dibuat', 'success');
      redirect('penilai/kriteria/'.$id);
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/');
      exit();  
    }
  }


  elseif ($this->POST('setmp')) {
    $list_kriteria = $this->Kriteria_m->get();


    foreach ($list_kriteria as $a) {
      foreach ($list_kriteria as $b) {
        $this->MPKriteria_m->update_where(['id_kriteria' => $a->id_kriteria, 'id_kriteria_2' => $b->id_kriteria],['nilai' => $this->POST('mp-'.$a->id_kriteria.'-'.$b->id_kriteria)]);
      }
    }

    $this->flashmsg2('Matrik Perbadingan Kriteria berhasil disimpan, <a href="#rasio">Cek Perhitungan Rasio Konsistensi</a>', 'success');
      redirect('penilai/kriteria/');
      exit();  
  }



  elseif ($this->POST('add_sub')) { 
         
    $id_kriteria = $this->POST('id_kriteria');
    $data = [
      'nama_sub' => $this->POST('nama') ,
      'inisial' => $this->POST('inisial'),
      'id_kriteria' => $id_kriteria 
    ];

    if ($this->Subkriteria_m->insert($data)) {
      $id = $this->db->insert_id();


      $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $id_kriteria]);

      foreach ($list_sub as $k) {
        if ($k->id_subkriteria  == $id) {
          $nilai = 1;
        }else {
          $nilai = 0;
        }
        $data = [
          'id_subkriteria ' => $id,
          'id_subkriteria_2' => $k->id_subkriteria ,
          'nilai' => $nilai
        ];
        $this->MPSubKriteria_m->insert($data);
      }

      foreach ($list_sub as $k) {

        if ($this->MPSubKriteria_m->get_num_row(['id_subkriteria' => $k->id_subkriteria , 'id_subkriteria_2' => $id]) == 0) {
          if ($k->id_subkriteria  != $id) {
               $data = [
                'id_subkriteria ' => $k->id_subkriteria ,
                'id_subkriteria_2' => $id,
                'nilai' => 0
              ];
              $this->MPSubKriteria_m->insert($data);
            } 
           
          }
      }


      $this->flashmsg2('Sub Kriteria berhasil ditambah', 'success');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }
  } 


  elseif ($this->POST('setmpsub')) {
    $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $this->POST('id_kriteria')]);


    foreach ($list_sub as $a) {
      foreach ($list_sub as $b) {
        $this->MPSubKriteria_m->update_where(['id_subkriteria' => $a->id_subkriteria, 'id_subkriteria_2' => $b->id_subkriteria],['nilai' => $this->POST('mp-'.$a->id_subkriteria.'-'.$b->id_subkriteria)]);
      }
    }

    $this->flashmsg2('Matrik Perbadingan Sub Kriteria berhasil disimpan, <a href="#rasio">Cek Perhitungan Rasio Konsistensi</a>', 'success');
      redirect('penilai/kriteria/'. $this->POST('id_kriteria'));
      exit();  
  }



  elseif ($this->POST('edit')) {
    if ($this->Kriteria_m->update($this->POST('id_kriteria'), ['nama_kriteria' => $this->POST('nama'),
      'inisial' => $this->POST('inisial') ] ) ) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('penilai/kriteria/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/');
      exit();  
    }
  }

  elseif ($this->POST('editsub')) {
    if ($this->Subkriteria_m->update($this->POST('id_subkriteria'), ['nama_sub' => $this->POST('nama'),
      'inisial' => $this->POST('inisial') ] ) ) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }
  }


  elseif ($this->POST('editsub')) {
    if ($this->Subkriteria_m->update($this->POST('id_subkriteria'), ['nama_sub' => $this->POST('nama'),
      'inisial' => $this->POST('inisial') ] ) ) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }
  }


  elseif ($this->POST('delete')) {
    if ($this->Kriteria_m->delete($this->POST('id_kriteria'))) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success');
      redirect('penilai/kriteria/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/');
      exit();  
    }
  }
  elseif ($this->POST('deletesub')) {
    if ($this->Subkriteria_m->delete($this->POST('id_subkriteria'))) {
      $this->flashmsg2('Kriteria berhasil dihapus.', 'success'); 
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('penilai/kriteria/'.$this->POST('id_kriteria'));
      exit();  
    }
  }
  elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);
    $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $id]);
    $this->data['list_sub'] = $this->Subkriteria_m->get(['id_kriteria' => $id]);
    $this->data['index'] = 2  ;
    $this->data['content'] = 'penilai/detailkriteria';
    $this->template($this->data,'penilai');
  }
  else {
    $this->data['list_kriteria'] = $this->Kriteria_m->get();




    $this->data['index'] = 2  ;
    $this->data['content'] = 'penilai/kriteria';
    $this->template($this->data,'penilai');
  }
}
 

 
 
// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('emailx')) { 
        $this->flashmsg2('Email telah digunakan!', 'warning');
        redirect('penilai/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('emailx'),['email' => $this->POST('email')])) {
          $user_session = [
            'email' => $this->POST('email')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('penilai/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('penilai/profile/');
          exit();  
        } 
       

    } 

    if ($this->POST('gpw')) { 

      $cek = 0;
      $msg = ''; 
      if (md5($this->POST('passwordold')) != $this->data['profil']->password) {
        $msg = $msg . 'Password lama salah! <br>';
        $cek++;
      }

      if ($this->POST('passwordnew') != $this->POST('passwordnew2')) {
        $msg = $msg . 'Password baru tidak sama!';
        $cek++;
      }

      if ($cek != 0) {

        $this->flashmsg2($msg, 'warning');
        redirect('penilai/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('penilai/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('penilai/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'penilai/profile';
    $this->template($this->data,'penilai');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('penilai/profil');
      exit();    
    }   
    else{ 
      redirect('penilai/profil');
      exit();
    } 
  }  
 
  public function cekemail(){ echo $this->login_m->cekemail2($this->input->post('email')); } 
  public function cekpasslama(){ echo $this->login_m->cekpasslama2($this->data['email'],$this->input->post('password')); } 
  public function cekpass(){ echo $this->login_m->cek_password_length2($this->input->post('password')); }
  public function cekpass2(){ echo $this->login_m->cek_passwords2($this->input->post('password'),$this->input->post('password2')); }
// PROFIL
 
}

 ?>

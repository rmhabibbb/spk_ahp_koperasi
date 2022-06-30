<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Admin extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 1))
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
    
    $this->data['profil'] = $this->login_m->get_row(['email' =>$this->data['email'] ]);   
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{    
      $this->data['index'] = 1;
      $this->data['content'] = 'admin/dashboard';
      $this->template($this->data,'admin');
}


public function danabantuan()
{     

  if ($this->POST('add')) { 
        
 
     
    $data = [
      'nama' => $this->POST('nama'), 
      'jumlah_penerima' => $this->POST('jumlah_penerima'), 
      'keterangan' => $this->POST('keterangan'), 
      'tanggal' => date('Y-m-d H:i:s'), 
      'status' => 0
    ];

    if ($this->DanaBantuan_m->insert($data)) {
      $id = $this->db->insert_id();
      $this->flashmsg2('Dana Bantuan berhasil dibuat', 'success');
      redirect('admin/danabantuan/'.$id);
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/danabantuan/');
      exit();  
    }
  }elseif ($this->POST('add_koperasi')) { 
        
 
     
    $data = [
      'id_danabantuan' => $this->POST('id_danabantuan'), 
      'nama_koperasi' => $this->POST('nama'), 
      'alamat' => $this->POST('alamat'),  
      'kontak' => $this->POST('kontak'),  
      'email' => $this->POST('email'),  
      'status' => 0 
    ];

    if ($this->Koperasi_m->insert($data)) {
      $id = $this->db->insert_id();
      $this->flashmsg2('Koperasi berhasil ditambah', 'success');
      redirect('admin/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }
  } elseif ($this->POST('selesai')) { 
        
  
    if ($this->DanaBantuan_m->update($this->POST('id'),['status' => 1])) { 
      $this->flashmsg2('Berhasil ke tahap penilaian', 'success');
      redirect('admin/danabantuan/'.$this->POST('id'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/danabantuan/'.$this->POST('id'));
      exit();  
    }
  } 
  elseif ($this->POST('delete')) {
    if ($this->DanaBantuan_m->delete($this->POST('id'))) {
      $this->flashmsg2('Dana Bantuan berhasil dihapus.', 'success');
      redirect('admin/danabantuan/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/danabantuan/');
      exit();  
    }
  }elseif ($this->POST('delete_koperasi')) {
    if ($this->Koperasi_m->delete($this->POST('id_koperasi'))) {
      $this->flashmsg2('Koperasi berhasil dihapus.', 'success');
      redirect('admin/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/danabantuan/'.$this->POST('id_danabantuan'));
      exit();  
    }
  }
  elseif ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);
    $this->data['danabantuan'] = $this->DanaBantuan_m->get_row(['id_danabantuan' => $id]);
    $this->data['list_koperasi'] = $this->Koperasi_m->get(['id_danabantuan' => $id]);
    $this->data['index'] = 2  ;
    $this->data['content'] = 'admin/detaildb';
    $this->template($this->data,'admin');
  }
  else {
    $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,[]);
    $this->data['index'] = 2  ;
    $this->data['content'] = 'admin/danabantuan';
    $this->template($this->data,'admin');
  }
}
 


public function akun()
{     

  if ($this->POST('add')) { 
        
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
      $this->flashmsg2('Email telah digunakan!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

     
    $data = [
      'email' => $this->POST('email'), 
      'role' => $this->POST('role'),
      'password' => md5($this->POST('password')) 
    ];

    if ($this->login_m->insert($data)) {
      $this->flashmsg2('Akun berhasil ditambah', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
        
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email_x') != $this->POST('email')) {
      $this->flashmsg2('Email telah digunakan!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

   
    $data = [
      'email' => $this->POST('email'), 
      'role' => $this->POST('role')
    ];
    
    

    if ($this->login_m->update($this->POST('email_x'),$data)) {
      $this->flashmsg2('Akun berhasil diedit.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('edit2')) { 
        
    if ($this->POST('password') != $this->POST('password2')) {
      $this->flashmsg2('Konfirmasi password tidak sama!', 'warning');
      redirect('admin/akun/');
      exit();  
    }

   
    $data = [
      'password' => md5($this->POST('password') )
    ];
    
    

    if ($this->login_m->update($this->POST('email'),$data)) {
      $this->flashmsg2('Password '.$this->POST('email'). ' berhasil diganti.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  elseif ($this->POST('delete')) {
    if ($this->login_m->delete($this->POST('email'))) {
      $this->flashmsg2('Akun berhasil dihapus.', 'success');
      redirect('admin/akun/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/akun/');
      exit();  
    }
  }
  else {
    $this->data['users'] = $this->login_m->get(['email !=' => $this->data['email']  ]);
    $this->data['index'] = 3;
    $this->data['content'] = 'admin/users';
    $this->template($this->data,'admin');
  }
}
 
 
public function penilai()
{     

  if ($this->POST('add')) { 
    $cek = 0;
    $msg = ''; 
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0) {
      $msg = $msg . 'Email telah digunakan!<br>';
      $cek++;
    } 

    if ($cek != 0) {

      $this->flashmsg2($msg, 'warning');
      redirect('admin/penilai/');
      exit();  
    }
     
    $data = [
      'email' => $this->POST('email'), 
      'role' => 2,
      'password' => md5($this->POST('password')) 
    ];

    if ($this->login_m->insert($data)) {

      $d = [ 
        'nama' =>  $this->POST('nama'),
        'email' => $this->POST('email'),   
        'jk' => $this->POST('jk') ,
        'kontak' => $this->POST('kontak') ,
        'alamat' => $this->POST('alamat') 
      ];

      if ($this->Penilai_m->insert($d)) {
         $this->flashmsg2('Data Penilai berhasil ditambah', 'success');
          redirect('admin/penilai/');
          exit(); 
      }else{
        $this->login_m->delete($this->POST('email'));
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/penilai/');
        exit();  
      }

      
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/penilai/');
      exit();  
    }
  }
  elseif ($this->POST('edit')) { 
         
    $cek = 0;
    $msg = ''; 
    if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email_x') != $this->POST('email')) {
      $msg = $msg . 'Email telah digunakan!<br>';
      $cek++;
    } 

    if ($cek != 0) {

      $this->flashmsg2($msg, 'warning');
      redirect('admin/penilai/');
      exit();  
    }
     
   
    $data = [
      'email' => $this->POST('email') 
    ];
    
    

    if ($this->login_m->update($this->POST('email_x'),$data)) {

      $d = [ 
        'nama' =>  $this->POST('nama'),
        'email' => $this->POST('email'),   
        'jk' => $this->POST('jk'),
        'kontak' => $this->POST('kontak') ,
        'alamat' => $this->POST('alamat') 
      ];

      if ($this->Penilai_m->update($this->POST('id_x'), $d)) {
        $this->flashmsg2('Data Penilai berhasil diedit.', 'success');
        redirect('admin/penilai/');
        exit(); 
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/penilai/');
        exit();  
    }

       
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/kmteam/');
      exit();  
    } 
  } 
  elseif ($this->POST('delete')) {
    if ($this->login_m->delete($this->POST('email'))) {
      $this->flashmsg2('Data Penilai berhasil dihapus.', 'success');
      redirect('admin/penilai/');
      exit();  
    }else{
      $this->flashmsg2('Gagal, Coba lagi!', 'warning');
      redirect('admin/penilai/');
      exit();  
    }
  }
  else {
    $this->data['penilai'] = $this->Penilai_m->get();
    $this->data['index'] = 4;
    $this->data['content'] = 'admin/penilai';
    $this->template($this->data,'admin');
  }
}
 
// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('emailx')) { 
        $this->flashmsg2('Email telah digunakan!', 'warning');
        redirect('admin/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('emailx'),['email' => $this->POST('email')])) {
          $user_session = [
            'email' => $this->POST('email')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('admin/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('admin/profile/');
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
        redirect('admin/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('admin/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('admin/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'admin/profile';
    $this->template($this->data,'admin');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('admin/profil');
      exit();    
    }   
    else{ 
      redirect('admin/profil');
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

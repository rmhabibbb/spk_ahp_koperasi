<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class kepaladinas extends MY_Controller
{

  function __construct()
  {
    parent::__construct();
  
        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role'); 
          if (!$this->data['email'] || ($this->data['id_role'] != 3))
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
     
    date_default_timezone_set("Asia/Jakarta");


  }

public function index()
{    
      $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,['status > ' => 1]);
      $this->data['index'] = 1;
      $this->data['content'] = 'kepaladinas/danabantuan';
      $this->template($this->data,'kepaladinas');
}


public function danabantuan()
{     
 if ($this->uri->segment(3)) {
    $id = $this->uri->segment(3);



    $this->data['danabantuan'] = $this->DanaBantuan_m->get_row(['id_danabantuan' => $id]);

    if($this->data['danabantuan']->status == 2){
      $ahp = $this->Penilaian_m->ahp($id); 

      $this->data['rank'] = $ahp['rank'];
    }
    $this->data['list_koperasi'] = $this->Koperasi_m->get(['id_danabantuan' => $id]);
    $this->data['list_kriteria'] = $this->Kriteria_m->get();
    $this->data['index'] = 1  ;
    $this->data['content'] = 'kepaladinas/detaildb';
    $this->template($this->data,'kepaladinas');
  }
  else {
      $this->data['danabantuan'] = $this->DanaBantuan_m->get_by_order('tanggal', 'desc' ,['status > ' => 1]);
    $this->data['index'] = 1  ;
    $this->data['content'] = 'kepaladinas/danabantuan';
    $this->template($this->data,'kepaladinas');
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
    $this->data['content'] = 'kepaladinas/ahp';
    $this->template($this->data,'kepaladinas');
  }
  else {
    redirect('kepaladinas');
    exit();
  }
}
 
 
// PROFIL
  public function profile(){
    if ($this->POST('save')) {
      if ($this->login_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('emailx')) { 
        $this->flashmsg2('Email telah digunakan!', 'warning');
        redirect('kepaladinas/profile/');
        exit();  
      }

        if ($this->login_m->update($this->POST('emailx'),['email' => $this->POST('email')])) {
          $user_session = [
            'email' => $this->POST('email')
          ];
          $this->session->set_userdata($user_session);

          $this->flashmsg2('Berhasil!', 'success');
          redirect('kepaladinas/profile/');
          exit();  
        }else{
          $this->flashmsg2('Gagal, Coba lagi!', 'warning');
          redirect('kepaladinas/profile/');
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
        redirect('kepaladinas/profile/');
        exit();  
      }

      $data = [ 
        'password' => md5($this->POST('passwordnew')) 
      ];
      if ($this->login_m->update($this->data['profil']->email, $data)) {
        $this->flashmsg2('Password berhasil diganti!', 'success');
        redirect('kepaladinas/profile/');
        exit();  
      }else{
        $this->flashmsg2('Gagal, Coba lagi!', 'warning');
        redirect('kepaladinas/profile/');
        exit();  
      } 
    }

    $this->data['index'] = 5;
    $this->data['content'] = 'kepaladinas/profile';
    $this->template($this->data,'kepaladinas');
  }
  public function proses_edit_profil(){
    if ($this->POST('edit')) {
      
      


      
    } 
    elseif ($this->POST('edit2')) { 
      
      
      $this->login_m->update($this->data['email'],$data);
  
      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('kepaladinas/profil');
      exit();    
    }   
    else{ 
      redirect('kepaladinas/profil');
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

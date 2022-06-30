<?php
$data =[ 
  'index' => $index
];
$this->load->view('penilai/template/header',$data);
$this->load->view('penilai/template/sidebar',$data);
$this->load->view('penilai/template/navbar');
$this->load->view($content);
$this->load->view('penilai/template/footer');
 ?>

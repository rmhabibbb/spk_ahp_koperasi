<?php
$data =[ 
  'index' => $index
];
$this->load->view('kepaladinas/template/header',$data);
$this->load->view('kepaladinas/template/sidebar',$data);
$this->load->view('kepaladinas/template/navbar');
$this->load->view($content);
$this->load->view('kepaladinas/template/footer');
 ?>

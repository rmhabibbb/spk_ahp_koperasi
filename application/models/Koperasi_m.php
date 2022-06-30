<?php 
class Koperasi_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_koperasi';
    $this->data['table_name'] = 'koperasi';
  }
}

 ?>

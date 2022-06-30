<?php 
class DanaBantuan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_danabantuan';
    $this->data['table_name'] = 'dana_bantuan';
  }
}

 ?>

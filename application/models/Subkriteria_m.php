<?php 
class Subkriteria_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_subkriteria';
    $this->data['table_name'] = 'subkriteria';
  }
}

 ?>

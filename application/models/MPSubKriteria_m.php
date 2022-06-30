<?php 
class MPSubKriteria_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'mp_subkriteria';
  }

  public function get_sum($id){
  	$query = $this->db->query('SELECT sum(nilai) as sum FROM ' . $this->data['table_name'] . ' where id_subkriteria_2 = ' . $id);
  	return $query->row();

  }
}

 ?>

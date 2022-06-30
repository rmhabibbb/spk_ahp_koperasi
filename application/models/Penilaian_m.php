<?php 
class Penilaian_m extends MY_Model
{ 
  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id';
    $this->data['table_name'] = 'penilaian';
    
  }


  public function ahp($id){

  	$list_koprerasi = $this->Koperasi_m->get_by_order('id_koperasi', 'asc', ['id_danabantuan' => $id]);
  	$list_kriteria = $this->Kriteria_m->get();


  	$i = 0;
  	foreach ($list_kriteria as $k) {
	  	if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) {
	       $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);
	       foreach ($list_sub as $s) {
	       	$prioo[$i]  = 0;
  			$i++;
	       }

  		}else{
  			$prioo[$i]  = 0;
  			$i++;
  		}
  	}
  	$i = 0;
  	foreach ($list_kriteria as $k) {
  		if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) {
  			$jum = 0; 
  			foreach ($list_kriteria as $k2) {
	  			$sum = $this->MPKriteria_m->get_sum($k2->id_kriteria)->sum;
	            $mp = $this->MPKriteria_m->get_row(['id_kriteria' => $k->id_kriteria, 'id_kriteria_2' => $k2->id_kriteria]);

	            $x = $mp->nilai/$sum;
	            $jum = $jum +  $x;
	  		}
	  		$xx = number_format($jum/sizeof($list_kriteria),3);

  			$list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);
		    foreach ($list_sub as $s) {
		    	$jum = 0; 
		  		foreach ($list_sub as $s2) {
		  			$sum = $this->MPSubKriteria_m->get_sum($s2->id_subkriteria)->sum;
		            $mp = $this->MPSubKriteria_m->get_row(['id_subkriteria' => $s->id_subkriteria, 'id_subkriteria_2' => $s2->id_subkriteria]);

		            $x = $mp->nilai/$sum;  
		            $jum = $jum +  $x;
		  		}
		  		 $prioo[$i] = number_format($xx*($jum/sizeof($list_sub)),3);
		  		 $i++;   	
		    }
  		}else{
  			$jum = 0; 
	  		foreach ($list_kriteria as $k2) {
	  			$sum = $this->MPKriteria_m->get_sum($k2->id_kriteria)->sum;
	            $mp = $this->MPKriteria_m->get_row(['id_kriteria' => $k->id_kriteria, 'id_kriteria_2' => $k2->id_kriteria]);

	            $x = $mp->nilai/$sum;
	            $jum = $jum +  $x;
	  		}
	  		 $prioo[$i] = number_format($jum/sizeof($list_kriteria),3);
	  		 $i++;
  		}
  	}
 	
 	$nilai_awal = array();
 		
	  	foreach ($list_kriteria as $k) {
		  	if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) {
		       $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);
		       foreach ($list_sub as $s) {
		        	$nilai = array();
 					foreach ($list_koprerasi as $kop) { 
 						$x = $this->Penilaian_m->get_row(['id_koperasi' => $kop->id_koperasi, 'id_kriteria' => $k->id_kriteria, 'subkriteria' => $s->nama_sub])->nilai ;

 						array_push($nilai, $x);
 					}
 					$data = [ 
				  		'nilai' => $nilai
				  	];
				  	array_push($nilai_awal, $data);
		       }

	  		}else{
	  			$nilai = array();
	  			foreach ($list_koprerasi as $kop) { 
	  				$x = $this->Penilaian_m->get_row(['id_koperasi' => $kop->id_koperasi, 'id_kriteria' => $k->id_kriteria])->nilai ;

 						array_push($nilai, $x);
 				}
 				$data = [ 
			  		'nilai' => $nilai
			  	];
			  	array_push($nilai_awal, $data);
	  		}
	  	}
	  	


  	$mp = [];

  	for ($z=0; $z < sizeof($nilai_awal); $z++) { 
  		for ($i=0; $i < sizeof($nilai_awal[$z]['nilai']) ; $i++) { 
  			$mp[$z]['sum'][$i] = 0;
  		}
  	}
  	for ($z=0; $z < sizeof($nilai_awal); $z++) { 
  		for ($i=0; $i < sizeof($nilai_awal[$z]['nilai']) ; $i++) {   
	  		for ($j=0; $j < sizeof($nilai_awal[$z]['nilai']) ; $j++) { 

	  			if ($nilai_awal[$z]['nilai'][$i] == $nilai_awal[$z]['nilai'][$j]) {
	  				$x = 1;
	  			}else{ 
	  				$a = $nilai_awal[$z]['nilai'][$i]/25;
	  				$b = $nilai_awal[$z]['nilai'][$j]/25;

	  				$x = $a - $b ;
	  				if ($x == -1) {
	  					$x = 0.333;
	  				}elseif ($x == 1) {
	  					$x = 3;
	  				}elseif ($x == -2) {
	  					$x = 0.2;
	  				}elseif ($x == 2) {
	  					$x = 5;
	  				}elseif ($x == -3) {
	  					$x = 0.143;
	  				}elseif ($x == 3) {
	  					$x = 7;
	  				}elseif ($x == -4) {
	  					$x = 0.111;
	  				}elseif ($x == 4) {
	  					$x = 9;
	  				}
	  				 
	  			}
	  			$mp[$z]['nilai'][$i][$j] = $x; 
	  			$mp[$z]['sum'][$j] += $x;
	  		}  
	  	}
  	}
  	
  	$eigen = [];
  	for ($z=0; $z < sizeof($nilai_awal); $z++) { 
  		for ($i=0; $i < sizeof($nilai_awal[$z]['nilai']) ; $i++) { 
  			$eigen[$z]['jum'][$i] = 0;
  			$eigen[$z]['eigen'][$i] = 0;
  		}
  	}

  	for ($z=0; $z < sizeof($mp); $z++) {  
  		for ($i=0; $i < sizeof($mp[$z]['nilai']); $i++) { 
  			for ($j=0; $j < sizeof($mp[$z]['nilai']); $j++) { 
	  			 $x = $mp[$z]['nilai'][$i][$j]/$mp[$z]['sum'][$j];

	  			 $eigen[$z]['nilai'][$i][$j] = $x ;
 				 $eigen[$z]['jum'][$i] += $x;
	  		} 

 			$eigen[$z]['eigen'][$i] = $eigen[$z]['jum'][$i]/sizeof($mp[$z]['nilai']);
  		}  
  	}
 
  	$j = 0;
  	$hasil_akhir = array();
  	foreach ($list_koprerasi as $kop) { 
  		$x = 0;
  		for ($i=0; $i < sizeof($eigen); $i++) {  
  			$x = $x + ($eigen[$i]['eigen'][$j]*$prioo[$i]);
	  		
  		} 
  		$data = [
  			'nilai_akhir' => $x,
  			'id_koperasi' => $kop->id_koperasi,
  			'nama_koperasi' => $kop->nama_koperasi
  		];
  		array_push($hasil_akhir, $data);
  		$j++; 
 
  	}

  	

  	$this->data['hasil'] = $hasil_akhir;

  	rsort($hasil_akhir);

  	$this->data['rank'] = $hasil_akhir;
  	$this->data['prioo'] = $prioo;
  	$this->data['mp'] = $mp;
  	$this->data['nilai_awal']  = $nilai_awal; 
  	$this->data['eigen'] = $eigen;   

  	return $this->data;

  }
}

 ?>

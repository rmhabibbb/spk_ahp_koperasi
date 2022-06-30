    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('penilai')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('penilai/kriteria')?>">Kriteria </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$kriteria->nama_kriteria?></li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right"> 
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Sub Kriteria</a>  
            </div>
          </div>
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0"><?=$kriteria->nama_kriteria?> (<?=$kriteria->inisial?>)</h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
              
               <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>No.</th>
                    <th>Nama Subkriteria</th>  
                    <th>Inisial</th>   
                    <th>Action</th> 
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_sub as $row): ?> 
                  <tr> 
                    <td>
                      <?=$i++?>
                    </td> 
                    <td>
                      <?=$row->nama_sub?>
                    </td> 
                    <td>
                      <?=$row->inisial?>
                    </td>   
 
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#edit-<?=$row->id_subkriteria?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Edit</span>
                        </button>
                      </a>
                      <a href="" data-toggle="modal" data-target="#delete2-<?=$row->id_subkriteria?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Hapus</span>
                        </button>
                      </a>
                       
                    </td> 
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
 
            </div>
          </div>

          <?php if (sizeof($list_sub) > 1) { ?>
          <div class="card" id="mp">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matrik Perbandingan Sub Kriteria</h3>
            </div>
            <!-- Light table -->
            <form action="<?=base_url('penilai/kriteria')?>" method="POST">
              <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Sub Kriteria</th>  
                    <?php $i = 1; foreach ($list_sub as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_sub as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   
                    <?php foreach ($list_sub as $row2): ?> 
                      <?php $mp = $this->MPSubKriteria_m->get_row(['id_subkriteria' => $row->id_subkriteria, 'id_subkriteria_2' => $row2->id_subkriteria]); ?>
                      <td>
                        <?php if ($row->id_subkriteria == $row2->id_subkriteria) { ?>

                        <input type="hidden" name="mp-<?=$row->id_subkriteria?>-<?=$row2->id_subkriteria?>"  value="<?=$mp->nilai?>" >
                        <?php  echo $mp->nilai;
                        }else { ?> 
                        <input type="number" name="mp-<?=$row->id_subkriteria?>-<?=$row2->id_subkriteria?>"  class="form-control" style="width: 80px" value="<?=$mp->nilai?>" step="any" required>
                        <?php  }  ?> 
                      </td>   
                    <?php endforeach; ?>
                    
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                      <th>Jumlah</th>

                      <?php $i = 1; foreach ($list_sub as $row): ?> 
                        <?php $sum = $this->MPSubKriteria_m->get_sum($row->id_subkriteria)->sum; ?>
                        <td><?=$sum?></td>
                      <?php endforeach; ?>
                    </tr>
                </tbody>
              </table>
            </div> 
            <center>
              
            <input type="submit" name="setmpsub" class="btn bg-gradient-primary text-white" value="Simpan ">
            </center>
            <br>
            </form>
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matriks Nilai Bobot Kriteria</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>  
                    <?php $i = 1; foreach ($list_sub as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                    <th>Jumlah</th>
                    <th>Prioritas</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php 
                      for ($i=0; $i < sizeof($list_sub) ; $i++) { 
                          $jj[$i]  = 0;
                      }

                      for ($i=0; $i < sizeof($list_sub) ; $i++) { 
                          $prioo[$i]  = 0;
                      }
                    ?>
                 <?php  $i=0;  $prio = 0; foreach ($list_sub as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   
                    <?php
                     $jum = 0; 
                     foreach ($list_sub as $row2): ?> 
                      <?php $sum = $this->MPSubKriteria_m->get_sum($row2->id_subkriteria)->sum; ?>
                      <?php $mp = $this->MPSubKriteria_m->get_row(['id_subkriteria' => $row->id_subkriteria, 'id_subkriteria_2' => $row2->id_subkriteria]); ?>
                      <td>
                         <?php 
                          $x = $mp->nilai/$sum;
                          $jum = $jum +  $x;
                          $jj[$i] +=  $x;
                          
                          echo round($x,3);

                         ?>
                      </td>   
                    <?php endforeach; ?>
                    <td>
                      <?=round($jum,3)?>
                    </td>
                    <td>
                      <?php 
                      $prioo[$i] = $jum/sizeof($list_sub);
                      $prio += $jum/sizeof($list_sub); 
                      $i++;
                      ?>
                      <?=round($jum/sizeof($list_sub),3)?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <tr>
                    <th>Jumlah</th>
                    <?php 
                      for ($i=0; $i < sizeof($list_sub) ; $i++) { 
                        echo '<td>'. round($jj[$i],3) .'</td>';
                      }
                    ?>
                    <td></td>
                    <td><?=round($prio,3)?></td>
                  </tr>
                </tbody>
              </table>
            </div> 
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Matriks Penjumlahan Setiap Baris Kriteria</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>  
                    <?php $i = 1; foreach ($list_sub as $row): ?> 
                      <th><?=$row->inisial?></th>
                    <?php endforeach; ?>
                    <th>Jumlah</th> 
                  </tr>
                </thead>
                <tbody class="list"> 
                 <?php 
                   for ($i=0; $i < sizeof($list_sub) ; $i++) { 
                          $jpb[$i]  = 0;
                      }
                      $j = 0;
                  $prio = 0; foreach ($list_sub as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->inisial?>
                    </td>   

                    <?php
                     $jum = 0;  $i=0;
                     foreach ($list_sub as $row2): ?> 
                      <?php $sum = $this->MPSubKriteria_m->get_sum($row2->id_subkriteria)->sum; ?>
                      <?php $mp = $this->MPSubKriteria_m->get_row(['id_subkriteria' => $row->id_subkriteria, 'id_subkriteria_2' => $row2->id_subkriteria]); ?>
                      <td>
                         <?php 
                          $x =  $mp->nilai * $prioo[$i];
                          $jum += $x;
                          echo  round($x,3) ;
                          $i++;
                         ?>
                      </td>   
                    <?php endforeach; ?>
                    <td> 
                      <?=round($jum,3)?>
                    </td>
                     
                  </tr>
                  <?php $jpb[$j] = $jum ; $j++ ?>
                  <?php endforeach; ?>
                  
                </tbody>
              </table>
            </div> 
          </div>

          <div class="card" id="rasio">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Perhitungan Rasio Konsistensi</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>   
                    <th>Nama Kriteria</th>   
                    <th>Jumlah Per Baris </th> 
                    <th>Prioritas</th>
                    <th>Hasil</th>  
                  </tr>
                </thead>
                <tbody class="list"> 
                 <?php $i=0; $jumlahhasil = 0; foreach ($list_sub as $row): ?> 
                  <tr> 
                 
                    <td>
                      <?=$row->nama_sub?>
                    </td>   
                   
                    <td> 
                        <?php 
                       
                          echo round($jpb[$i],3); 
                       ?>
                    </td>
                    <td> 
                       <?php 
                       
                          echo round($prioo[$i],3);
                         
                       ?>
                    </td>
                    <td> 
                       <?php 
                          $jumlahhasil += ($jpb[$i]+$prioo[$i]);
                          echo round($jpb[$i]+$prioo[$i],3);
                           $i++;
                       ?>
                    </td>
                     
                  </tr>
                  <?php endforeach; ?>
                  
                </tbody>
              </table>
            </div> 
            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
               <tr>
                  <th>Principe Eigen Vector (λ maks)</th>
                  <th><?php 
                  $lmax = $jumlahhasil/sizeof($list_sub);
                  echo (round($jumlahhasil/sizeof($list_sub),5))?></th>
                </tr>
                <tr>
                  <th>Consistency Index</th>
                  <th><?php
                   $ci = ($jumlahhasil/sizeof($list_sub)-sizeof($list_sub))/(sizeof($list_sub)-1);
                   echo (round($ci,5))?></th>
                </tr>
                <tr>
                  <th>Consistency Ratio</th>
                  <th><?php 

                  $ir = $this->IR_m->get_row(['jumlah' => sizeof($list_sub)])->nilai; 
                  if (sizeof($list_sub) > 2) {
                    $cr = ($ci/$ir);
                  }else{
                    $cr = ($ci/$lmax);
                  }
                  echo (round($cr,3))?></th>
                </tr>

              </table>
              <?php if ($cr > 0.1) { ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
                <span class="alert-text"><strong>Nilai Consistency Ratio melebihi dari 0.1!</strong> Input ulang matrik perbandingan ->> <a href="#mp">Input</a>!!!</span>
                 
              </div>
               <?php  }else{  ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert"> 
                <span class="alert-text"><strong>Nilai Consistency Ratio kurang dari 0.1</strong>  </span>
                 
              </div>
               <?php  }  ?>
            </div> 
          </div>

          <?php  } ?>
        </div>
      </div>
    </div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Sub Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('penilai/kriteria/') ?>
      <div class="modal-body">
         
            <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
              <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kriteria</label>
                <input class="form-control" type="text" required name="nama" >
            </div>   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Inisial</label>
                <input class="form-control" type="text" required name="inisial" >
            </div>   
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add_sub" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 



<?php $i = 1; foreach ($list_sub as $row): ?> 
<div class="modal fade" id="edit-<?=$row->id_subkriteria?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('penilai/kriteria/') ?>
      <div class="modal-body">
         
           <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
          <input type="hidden" required name="id_subkriteria"  value="<?=$row->id_subkriteria?>"> 
   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Kriteria</label>
                <input class="form-control" type="text" required name="nama" value="<?=$row->nama_sub?>" >
            </div>   
             <div class="form-group">
                <label for="example-email-input" class="form-control-label">Inisial</label>
                <input class="form-control" type="text" required name="inisial" value="<?=$row->inisial?>" >
            </div>   
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="editsub" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete2-<?=$row->id_subkriteria?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Subkriteria ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('penilai/kriteria')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id_kriteria" value="<?=$kriteria->id_kriteria?>">
                  <input type="hidden" name="id_subkriteria" value="<?=$row->id_subkriteria?>">
                
                   
                      <input type="hidden" value="<?=$row->id_subkriteria?>" name="id_subkriteria">  
                      <input type="submit" class="btn btn-white" name="deletesub" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>


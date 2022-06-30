 
<div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('kepaladinas')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('kepaladinas/danabantuan')?>">Dana Bantuan </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('kepaladinas/danabantuan')?>"><?=$danabantuan->nama?></a></li>
                  <li class="breadcrumb-item active" aria-current="page">Metode AHP</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
            
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
            <div class="card-header border-0" style="padding-bottom: 0">
              <h3 class="mb-0">Egien Kriteria & Subkriteria</h3>
            </div>
            <!-- Light table -->
            <div class="card-body" style="padding-top: 0"> 
               <div class="table-responsive py-4">
                  <table class="table table-flush">
                    <thead class="thead-light">
                      <tr>  
                        <th>Kriteria</th>
                        <th>Sub Kriteria</th>  
                        <th>Egien</th>   
                      </tr>
                    </thead>
                    <tbody class="list">
                    <?php $i = 0 ; foreach ($list_kriteria as $k): ?>

                      <?php if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) { ?>
                        <?php $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]); ?>
                         <?php $h = 1; foreach ($list_sub as $s): ?>
                          <tr>
                            <td><?php 
                              if ($h == 1) {
                                echo $k->nama_kriteria;
                              }
                              $h++;
                            ?></td> 
                            <td><?=$s->nama_sub?></td>
                            <td><?=$prioo[$i++]?></td>
                          </tr>
                         <?php endforeach; ?>

                      <?php  }else { ?>
                         <tr>
                            <td><?php  
                                echo $k->nama_kriteria; 
                            ?></td>
                            <td>-</td>
                            <td><?=$prioo[$i++]?></td>
                          </tr>
                      <?php  } ?>



                    <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
 
            </div>
          </div>


          <?php $i = 0 ; foreach ($list_kriteria as $k): ?>
          <?php if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) { ?>
                          <?php $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]); ?>
                           <?php $h = 1; foreach ($list_sub as $s): ?>
                            <div class="card">
                              <!-- Card header -->
                              <div class="card-header border-0" style="padding-bottom: 0">
                                <h3 class="mb-0"><?=$k->nama_kriteria?> - <?=$s->nama_sub?></h3>
                              </div>
                              <!-- Light table -->
                              <div class="card-body" style="padding-top: 0"> 
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>ID Koperasi</th>
                                      <th>Nama Koperasi</th>  
                                      <th>Nilai</th>   
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php foreach ($list_koperasi as $row): ?> 
                                         <?php $x = $this->Penilaian_m->get_row(['id_koperasi' => $row->id_koperasi, 'id_kriteria' => $k->id_kriteria, 'subkriteria' => $s->nama_sub])->nilai ; ?>
                                           
                                          <tr> 
                                            <td>
                                              <?=$row->id_koperasi?>
                                            </td> 
                                            <td>
                                              <?=$row->nama_koperasi?>
                                            </td>  
                                            <th>
                                              <?=$x?>
                                            </th>
                                          </tr>
                                          <?php  endforeach; ?>
                                    </tbody>
                                  </table>
                              </div>
                              <h3 class="mb-0">- Matrik Perbandingan Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_koperasi as $row): ?> 
                                        <th><?=$row->nama_koperasi?></th>
                                     <?php  endforeach; ?> 
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_koperasi as $row): ?> 
                                          <tr>
                                            <th><?=$row->nama_koperasi?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".$mp[$i]['nilai'][$z][$l]."</td>";
                                              }
                                            ?>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      <tr>
                                        <th>Jumlah</th>
                                        <?php 
                                          for ($l=0; $l < sizeof($mp[$i]['nilai']) ; $l++) { 
                                            echo "<th>".$mp[$i]['sum'][$l]."</th>";
                                          }
                                        ?>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>

                              <h3 class="mb-0">- Eigen Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_koperasi as $row): ?> 
                                        <th><?=$row->nama_koperasi?></th>
                                     <?php  endforeach; ?> 
                                      <th>Jumlah</th>
                                      <th>Eigen</th>
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_koperasi as $row): ?> 
                                          <tr>
                                            <th><?=$row->nama_koperasi?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".round($eigen[$i]['nilai'][$z][$l],4)."</td>";
                                              }
                                            ?>
                                            <th><?=round($eigen[$i]['jum'][$z],4)?></th>
                                            <th><?=round($eigen[$i]['eigen'][$z],4)?></th>
                                            <th></th>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      
                                    </tbody>
                                  </table>
                              </div>
                            </div>
                          </div>

             <?php $i++; endforeach; ?> 
          <?php  }else { ?>
            <div class="card">
                              <!-- Card header -->
                              <div class="card-header border-0" style="padding-bottom: 0">
                                <h3 class="mb-0"><?=$k->nama_kriteria?></h3>
                              </div>
                              <!-- Light table -->
                              <div class="card-body" style="padding-top: 0"> 
                                <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>ID Koperasi</th>
                                      <th>Nama Koperasi</th>  
                                      <th>Nilai</th>   
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php foreach ($list_koperasi as $row): ?> 
                                         <?php $x = $this->Penilaian_m->get_row(['id_koperasi' => $row->id_koperasi, 'id_kriteria' => $k->id_kriteria])->nilai ; ?>
                                           
                                          <tr> 
                                            <td>
                                              <?=$row->id_koperasi?>
                                            </td> 
                                            <td>
                                              <?=$row->nama_koperasi?>
                                            </td>  
                                            <th>
                                              <?=$x?>
                                            </th>
                                          </tr>
                                          <?php  endforeach; ?>
                                    </tbody>
                                  </table>
                              </div>
                              <h3 class="mb-0">- Matrik Perbandingan Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_koperasi as $row): ?> 
                                        <th><?=$row->nama_koperasi?></th>
                                     <?php  endforeach; ?> 
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_koperasi as $row): ?> 
                                          <tr>
                                            <th><?=$row->nama_koperasi?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".$mp[$i]['nilai'][$z][$l]."</td>";
                                              }
                                            ?>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      <tr>
                                        <th>Jumlah</th>
                                        <?php 
                                          for ($l=0; $l < sizeof($mp[$i]['nilai']) ; $l++) { 
                                            echo "<th>".$mp[$i]['sum'][$l]."</th>";
                                          }
                                        ?>
                                      </tr>
                                    </tbody>
                                  </table>
                              </div>

                              <h3 class="mb-0">- Eigen Alternatif</h3>
                              <div class="table-responsive py-4">
                                <table class="table table-flush">
                                  <thead class="thead-light">
                                    <tr>  
                                      <th>Alternatif</th>

                                     <?php foreach ($list_koperasi as $row): ?> 
                                        <th><?=$row->nama_koperasi?></th>
                                     <?php  endforeach; ?> 
                                      <th>Jumlah</th>
                                      <th>Eigen</th>
                                    </tr>
                                  </thead>
                                  <tbody class="list">

                                     <?php $z =0; foreach ($list_koperasi as $row): ?> 
                                          <tr>
                                            <th><?=$row->nama_koperasi?></th>
                                            <?php 
                                              for ($l=0; $l < sizeof($mp[$i]['nilai'][$z]) ; $l++) { 
                                                echo "<td>".round($eigen[$i]['nilai'][$z][$l],4)."</td>";
                                              }
                                            ?>
                                            <th><?=round($eigen[$i]['jum'][$z],4)?></th>
                                            <th><?=round($eigen[$i]['eigen'][$z],4)?></th>
                                            <th></th>
                                          </tr>
                                      <?php $z++;  endforeach; ?>

                                      
                                    </tbody>
                                  </table>
                              </div>
                   
                              </div>
                            </div>
          <?php  } ?>
          <?php endforeach; ?>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0" style="padding-bottom: 0">
              <h3 class="mb-0"> Hasil Akhir Penentuan Koperasi Terbaik</h3>
            </div>
            <!-- Light table -->
            <div class="card-body" style="padding-top: 0"> 
               <div class="table-responsive py-4">
                  <table class="table table-flush">
                    <thead class="thead-light">
                      <tr>  
                        <th></th>
                        <?php $i = 1 ; foreach ($list_kriteria as $k): ?>

                      <?php if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) > 1) { ?>
                        <?php $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]); ?>
                         <?php $h = 1; foreach ($list_sub as $s): ?>
                           <th>K<?=$i?> - S<?=$h++?></th>
                         <?php endforeach; ?>
                         <?php $i ++ ;?>
                      <?php  }else { ?>
                         <th>K<?=$i++?></th>
                      <?php  } ?>



                    <?php endforeach; ?>
                    <th>Jumlah</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                     <?php $j = 0; foreach ($list_koperasi as $row): ?> 
                
                   
                  <tr>  
                    <td>
                      <?=$row->nama_koperasi?>
                    </td>  
                    <?php 
                      $x = 0;
                        for ($z=0; $z < sizeof($eigen); $z++) {  
                          $x = $x + ($eigen[$z]['eigen'][$j]*$prioo[$z]);
                          echo "<td>". round($eigen[$z]['eigen'][$j]*$prioo[$z],4) .'</td>';
                          
                        }  
                        $j++; 
                        echo "<th>". round($x,4) . "</th>";
                    ?>
                  </tr>
                  <?php   endforeach; ?>
                    </tbody>
                  </table>
                </div>
 
            </div>
          </div>

          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Perankingan Koperasi Terbaik</h3>
            </div>
            <!-- Light table -->
            <div class="card-body"> 
               <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>Rank</th>
                    <th>Nama Koperasi</th>  
                    <th>Nilai</th>   
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($rank as $row): ?>  
                  <tr>  
                    <th>
                      <?=$i++?>
                    </th> 
                    <th>
                      <?=$row['nama_koperasi']?>
                    </th> 
                    <th>
                      <?= round($row['nilai_akhir'],4) ?>
                    </th>   
 
                  </tr>
                  <?php  endforeach; ?>
                </tbody>
              </table>
            </div>
 
            </div>
          </div>
        </div>
      </div>
  
 
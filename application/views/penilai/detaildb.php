<?php if ($danabantuan->status == 1) { ?>
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
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('penilai/danabantuan')?>">Dana Bantuan </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$danabantuan->nama?></li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
            <?php if ($danabantuan->status == 1) { ?>
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Input Penilaian</a> 
              <?php   } ?>
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
              <h3 class="mb-0"><?=$danabantuan->nama?></h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
              <table>
                <tr>
                  <th>Jumlah Penerima  </th>
                  <td> : </td>
                  <td><?=$danabantuan->jumlah_penerima?></td>
                </tr>
                <tr>
                  <th>Jumlah Koperasi  </th>
                  <td> : </td>
                  <td><?=sizeof($list_koperasi)?> Koperasi</td>
                </tr>
                <tr>
                  <th>Tanggal  </th>
                  <td> : </td>
                  <td><?=$danabantuan->tanggal?></td>
                </tr>
                <tr>
                  <th>Keterangan </th>
                  <td> : </td>
                  <td><?=$danabantuan->keterangan?></td>
                </tr>
                <tr>
                  <th>Status  </th>
                  <td> : </td>
                  <td>
                    <?php if ($danabantuan->status == 0) {
                        echo "Tahap Input Koperasi";
                      }elseif ($danabantuan->status == 1) {
                        echo "Tahap Penilaian";
                      }elseif ($danabantuan->status == 2) {
                        echo "Selesai";
                      }
                      ?>
                  </td>
                </tr>
              </table>

               <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>ID Koperasi</th>
                    <th>Nama Koperasi</th>  
                    <th>Email</th>  
            <?php if ($danabantuan->status == 1) { ?>
                    <th>Action</th>
              <?php   } ?>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_koperasi as $row): ?> 
                 <?php if ($this->Penilaian_m->get_num_row(['id_koperasi' => $row->id_koperasi]) != 0) { ?>
                   
                  <tr> 
                    <td>
                      <?=$row->id_koperasi?>
                    </td> 
                    <td>
                      <?=$row->nama_koperasi?>
                    </td> 
                    <td>
                      <?=$row->email?>
                    </td>   

            <?php if ($danabantuan->status == 1) { ?>
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#edit-<?=$row->id_koperasi?>">
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Lihat Nilai</span>
                        </button>
                      </a>
                      <a href="" data-toggle="modal" data-target="#delete2-<?=$row->id_koperasi?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Hapus</span>
                        </button>
                      </a>
                       
                    </td>
              <?php  } ?>
                  </tr>
                  <?php } endforeach; ?>
                </tbody>
              </table>
            </div>

            <?php if ($danabantuan->status == 1) { ?>
            <hr>
            
               <a href="" data-toggle="modal" data-target="#selesai">
                <button type="button" class="btn btn-twitter btn-icon"> 
                  <span class="btn-inner--text">Selesai Tahap Penilaian</span>
                </button>
              </a>
              <?php   } ?>
            </div>
          </div>
        </div>
      </div>
  


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Input Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('penilai/danabantuan/') ?>
      <div class="modal-body">
         
            <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Koperasi</label>
                 <select class="form-control" name="id_koperasi" required>
                    <option value="">Pilih Koperasi</option>
                    <?php  foreach ($list_koperasi as $k): ?> 
                    <?php if ($this->Penilaian_m->get_num_row(['id_koperasi' => $k->id_koperasi]) == 0) { ?>
                      <option value="<?=$k->id_koperasi?>"><?=$k->nama_koperasi?></option>
                    <?php } endforeach; ?>
                  </select>
            </div> 

            <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
                            <table class="table table-bordered">
                             
                              <?php $i= 1; foreach ($list_kriteria as $row): ?>  
                              <?php if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $row->id_kriteria]) >= 2) { ?>   

                                <?php 

                                  $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $row->id_kriteria]);

                                  foreach ($list_sub as $s) { ?>
                                    <tr>
                                        <th style="width: 70%; white-space:normal"><?=$row->nama_kriteria?> - <?=$s->nama_sub?></th>
                                        <td>
                                            <select class="form-control"  required name="kriteria[]">
                                                <option value="">- Pilih -</option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                             </select> 
                                        </td>
                                    </tr>
                                <?php   }  ?>

                              <?php }else{ ?>
                                <tr>
                                    <th><?=$row->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria[]"> 
                                                <option value="">- Pilih -</option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                         </select> 
                                    </td>
                                </tr>

                              <?php }  ?>
                                <?php   endforeach; ?>
                              
                            </table>
                                
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="inputnilai" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 



<?php $i = 1; foreach ($list_koperasi as $row): ?> 

<div class="modal fade" id="edit-<?=$row->id_koperasi?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Edit Nilai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('penilai/danabantuan/') ?>
      <div class="modal-body">
         
            <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Koperasi</label>
                 <input type="text" class="form-control" readonly value="<?=$row->nama_koperasi?>">
                 <input type="hidden" class="form-control" name="id_koperasi" value="<?=$row->id_koperasi?>">
            </div> 

            <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
                            <table class="table table-bordered">
                             
                              <?php $i= 1; foreach ($list_kriteria as $k): ?>  
                              <?php if ($this->Subkriteria_m->get_num_row(['id_kriteria' => $k->id_kriteria]) >= 2) { ?>   

                                <?php 

                                  $list_sub = $this->Subkriteria_m->get(['id_kriteria' => $k->id_kriteria]);

                                  foreach ($list_sub as $s) { 
                                    $nilai = $this->Penilaian_m->get_row(['id_koperasi' => $row->id_koperasi, 'id_kriteria' => $k->id_kriteria, 'subkriteria' => $s->nama_sub])->nilai;
                                    ?>
                                    <tr>
                                        <th style="width: 70%; white-space:normal"><?=$k->nama_kriteria?> - <?=$s->nama_sub?></th>
                                        <td>
                                            <select class="form-control"  required name="kriteria[]">
                                                <option value="<?=$nilai?>"><?=$nilai?></option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                             </select> 
                                        </td>
                                    </tr>
                                <?php   }  ?>

                              <?php }else{ 
                                 $nilai = $this->Penilaian_m->get_row(['id_koperasi' => $row->id_koperasi, 'id_kriteria' => $k->id_kriteria])->nilai;
                                ?>
                                <tr>
                                    <th><?=$k->nama_kriteria?></th>
                                    <td>
                                        <select class="form-control"  required name="kriteria[]"> 
                                                
                                                <option value="<?=$nilai?>"><?=$nilai?></option> 
                                                <option value="0">0</option>  
                                                <option value="25">25</option>  
                                                <option value="50">50</option>  
                                                <option value="75">75</option>  
                                                <option value="100">100</option>  
                                         </select> 
                                    </td>
                                </tr>

                              <?php }  ?>
                                <?php   endforeach; ?>
                              
                            </table>
                                
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="editnilai" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 


<div class="modal fade" id="delete2-<?=$row->id_koperasi?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Penilaian ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('penilai/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
                
                   
                      <input type="hidden" value="<?=$row->id_koperasi?>" name="id_koperasi">  
                      <input type="submit" class="btn btn-white" name="deletenilai" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>

 


<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-green"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Tahap Penilaian Selesai  ? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('penilai/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id" value="<?=$danabantuan->id_danabantuan?>">
                
                     
                      <input type="submit" class="btn btn-white" name="selesai" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>

<?php }elseif($danabantuan->status == 2){  ?>
<div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('penilai')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('penilai/danabantuan')?>">Dana Bantuan </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$danabantuan->nama?></li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
             
              <a href="<?=base_url('penilai/ahp/'.$danabantuan->id_danabantuan)?>"   class="btn btn-sm btn-neutral">Lihat Perhitungan Metode AHP</a>  
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
              <h3 class="mb-0"><?=$danabantuan->nama?></h3>
            </div>
            <!-- Light table -->
            <div class="card-body">
              <table>
                <tr>
                  <th>Jumlah Penerima  </th>
                  <td> : </td>
                  <td><?=$danabantuan->jumlah_penerima?></td>
                </tr>
                <tr>
                  <th>Jumlah Koperasi  </th>
                  <td> : </td>
                  <td><?=sizeof($list_koperasi)?> Koperasi</td>
                </tr>
                <tr>
                  <th>Tanggal  </th>
                  <td> : </td>
                  <td><?=$danabantuan->tanggal?></td>
                </tr>
                <tr>
                  <th>Keterangan </th>
                  <td> : </td>
                  <td><?=$danabantuan->keterangan?></td>
                </tr>
                <tr>
                  <th>Status  </th>
                  <td> : </td>
                  <td> Selesai</td>
                </tr>
              </table>

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
                  <?php if ($i <= $danabantuan->jumlah_penerima) { ?> 
                  <tr style="background: lime; color : white"> 
                    <?php }else{ ?>
                  <tr> 
                    <?php } ?>
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
  

<?php }  ?>
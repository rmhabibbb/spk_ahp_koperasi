    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('admin')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('admin/danabantuan')?>">Dana Bantuan </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$danabantuan->nama?></li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
            <?php if ($danabantuan->status == 0) { ?>
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Tambah Data Koperasi</a> 
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
                    <th>No.</th>
                    <th>Nama Koperasi</th>  
                    <th>Email</th>  
                    <th>Kontak</th>  
                    <th>Alamat</th>   
            <?php if ($danabantuan->status == 0) { ?>
                    <th>Action</th>
              <?php   } ?>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($list_koperasi as $row): ?> 
                  <tr> 
                    <td>
                      <?=$i++?>
                    </td> 
                    <td>
                      <?=$row->nama_koperasi?>
                    </td> 
                    <td>
                      <?=$row->email?>
                    </td>  
                    <td>
                      <?=$row->kontak?>
                    </td> 
                    <td>
                      <?=$row->alamat?>
                    </td>  

            <?php if ($danabantuan->status == 0) { ?>
                    <td class="text-right">
                      <a href="" data-toggle="modal" data-target="#delete2-<?=$row->id_koperasi?>">
                        <button type="button" class="btn btn-instagram btn-icon"> 
                          <span class="btn-inner--text">Hapus</span>
                        </button>
                      </a>
                       
                    </td>
              <?php  } ?>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>

            <?php if ($danabantuan->status == 0) { ?>
            <hr>
             <a href="" data-toggle="modal" data-target="#delete">
                <button type="button" class="btn btn-instagram btn-icon"> 
                  <span class="btn-inner--text">Hapus Dana Bantuan</span>
                </button>
              </a>
               <a href="" data-toggle="modal" data-target="#selesai">
                <button type="button" class="btn btn-twitter btn-icon"> 
                  <span class="btn-inner--text">Lanjut ke Tahap Penilaian</span>
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
        <h5 class="modal-title" id="exampleModalLabel">Form Dana Bantuan Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <?= form_open_multipart('admin/danabantuan/') ?>
      <div class="modal-body">
         
            <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama Koperasi</label>
                <input class="form-control" type="text" required name="nama" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Email</label>
                <input class="form-control" type="email" required name="email" >
            </div>  
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Kontak</label>
                <input class="form-control" type="text" required name="kontak" >
            </div>   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Alamat</label>
                <textarea class="form-control"  name="alamat" ></textarea> 
            </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add_koperasi" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 



<?php $i = 1; foreach ($list_koperasi as $row): ?> 
<div class="modal fade" id="delete2-<?=$row->id_koperasi?>" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Koperasi ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id_danabantuan" value="<?=$danabantuan->id_danabantuan?>">
                
                   
                      <input type="hidden" value="<?=$row->id_koperasi?>" name="id_koperasi">  
                      <input type="submit" class="btn btn-white" name="delete_koperasi" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
<?php endforeach; ?>

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Hapus Dana Bantuan ini? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id" value="<?=$danabantuan->id_danabantuan?>">
                
                     
                      <input type="submit" class="btn btn-white" name="delete" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>



<div class="modal fade" id="selesai" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-green"> 
              
                  <div class="modal-body">
                    
                      <div class="py-3 text-center">
                          <i class="ni ni-bell-55 ni-3x"></i>
                          <h4 class="heading mt-4"> Lanjut ke Tahap Penilaian ? </h4> 
                      </div>
                      
                  </div>
                  
                  <form action="<?= base_url('admin/danabantuan')?>" method="Post" >  
                  <div class="modal-footer">

                  <input type="hidden" name="id" value="<?=$danabantuan->id_danabantuan?>">
                
                     
                      <input type="submit" class="btn btn-white" name="selesai" value="Ya!">
                     
                      <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
                  </div>
                </form>
          </div>
  </div>
</div>
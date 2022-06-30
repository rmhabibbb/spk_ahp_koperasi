    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href=" href="<?=base_url('admin')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Dana Bantuan</li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
              <a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral">Buat Dana Bantuan</a> 
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
              <h3 class="mb-0">Data Dana Bantuan</h3>
            </div>
            <!-- Light table -->

            <div class="table-responsive py-4">
              <table class="table table-flush" id="datatable-basic">
                <thead class="thead-light">
                  <tr>  
                    <th>No.</th>
                    <th>Nama Dana Bantuan</th>  
                    <th>Jumlah Penerima</th>  
                    <th>Tanggal</th>  
                    <th>Keterangan</th>  
                    <th>Status</th>  
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="list">

                 <?php $i = 1; foreach ($danabantuan as $row): ?> 
                  <tr> 
                    <td>
                      <?=$i++?>
                    </td> 
                    <td>
                      <?=$row->nama?>
                    </td> 
                    <td>
                      <?=$row->jumlah_penerima?>
                    </td> 
                    <td>
                      <?=date('d-m-Y',strtotime($row->tanggal))?>
                    </td> 

                    <td>
                      <?=$row->keterangan?>
                    </td> 
                    <td>
                      <?php if ($row->status == 0) {
                        echo "Tahap Input Koperasi";
                      }elseif ($row->status == 1) {
                        echo "Tahap Penilaian";
                      }elseif ($row->status == 2) {
                        echo "Selesai";
                      }
                      ?>
                    </td> 
                    
                    <td class="text-right">
                      <a href="<?=base_url('admin/danabantuan/'.$row->id_danabantuan)?>"  >
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <span class="btn-inner--text">Lihat</span>
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
         
          
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Nama</label>
                <input class="form-control" type="text" required name="nama" >
            </div> 
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Jumlah Penerima</label>
                <input class="form-control" type="number" required name="jumlah_penerima" >
            </div>   
            <div class="form-group">
                <label for="example-email-input" class="form-control-label">Keterangan</label>
                <textarea class="form-control"  name="keterangan" ></textarea> 
            </div>  
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" name="add" value="Submit"> 
      </div>
      </form>
    </div>
  </div>
</div> 
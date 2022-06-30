    <!-- Header -->
    <!-- Header -->
    <div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="<?=base_url('kepaladinas')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page">Daftar Dana Bantuan</li>
                </ol>
              </nav>
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

                      <a href="<?=base_url('kepaladinas/danabantuan/'.$row->id_danabantuan)?>"  >
                        <button type="button" class="btn btn-twitter btn-icon"> 
                          <?php if ($row->status == 1) { ?>
                            <span class="btn-inner--text">Input Nilai</span>
                          <?php  }else{ ?>
                            <span class="btn-inner--text">Lihat Laporan</span>
                          <?php  } ?>
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
  
 
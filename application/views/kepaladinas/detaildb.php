 
<div class="header   pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">  
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a   href="<?=base_url('kepaladinas')?>"><i class="fas fa-home"></i></a></li> 
                  <li class="breadcrumb-item active" aria-current="page"><a   href="<?=base_url('kepaladinas/danabantuan')?>">Dana Bantuan </a></li>
                  <li class="breadcrumb-item active" aria-current="page"><?=$danabantuan->nama?></li>
                </ol>
              </nav>
            </div> 
            <div class="col-lg-6 col-5 text-right">
             
              <a href="<?=base_url('kepaladinas/ahp/'.$danabantuan->id_danabantuan)?>"   class="btn btn-sm btn-neutral">Lihat Perhitungan Metode AHP</a>  
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
  
 
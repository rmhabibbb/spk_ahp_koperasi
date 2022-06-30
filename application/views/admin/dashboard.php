 <!-- Header -->
    <div class="header  pb-6" style="background-color: blue">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              
              <h6 class="h2 text-white d-inline-block mb-0">Dahsboard</h6>
               
            </div>
            
          </div> 
        </div>
        <?= $this->session->flashdata('msg2') ?>
      </div>
    </div>  

    <div class="container-fluid mt--6">
       <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Data Akun</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$this->login_m->get_num_row([])?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                        <i class="ni ni-badge "></i>
                      </div>
                    </div>
                  </div>
                  
                <p class="mt-3 mb-0 text-sm">
                  <a href="<?=base_url('admin/akun')?>" class="text-nowrap text-primary font-weight-600">Lihat</a>
                </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Data Penilai</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$this->Penilai_m->get_num_row([])?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                        <i class="ni ni-badge "></i>
                      </div>
                    </div>
                  </div>
                  
                <p class="mt-3 mb-0 text-sm">
                  <a href="<?=base_url('admin/penilai')?>" class="text-nowrap text-primary font-weight-600">Lihat</a>
                </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Dana Bantuan</h5>
                      <span class="h2 font-weight-bold mb-0"><?=$this->DanaBantuan_m->get_num_row([])?></span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                        <i class="ni ni-single-02"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-sm">
                    <a href="<?=base_url('admin/danabantuan')?>" class="text-nowrap text-primary font-weight-600">Lihat</a>
                  </p>
                </div>
              </div>
            </div> 
             
          </div>
    </div>

 

 
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?=base_url('admin')?>">
            <img src="<?=base_url('assets/argon/')?>img/brand/logo.png" class="navbar-brand-img"   alt="...">  
            
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($index == 1){ echo 'active'; } ?>" href="<?=base_url('admin/')?>">
                <i class="fas fa-home text-black"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($index == 2){ echo 'active'; } ?>" href="<?=base_url('admin/danabantuan')?>">
                <i class="ni ni-money-coins text-black"></i>
                <span class="nav-link-text">Dana Bantuan</span>
              </a>
            </li>
          </ul>

            <hr class="my-3">
            <h6 class="navbar-heading p-0 text-muted">
              <span class="docs-normal"></span>
            </h6>

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($index == 3){ echo 'active'; } ?>" href="<?=base_url('admin/akun')?>">
                <i class="ni ni-badge text-black"></i>
                <span class="nav-link-text">Kelola Akun</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($index == 4){ echo 'active'; } ?>" href="<?=base_url('admin/penilai')?>">
                <i class="ni ni-single-02 text-black"></i>
                <span class="nav-link-text">Kelola Penilai</span>
              </a>
            </li> 
 
            
          </ul>
         
          <hr class="my-3">
          <!-- Heading -->
          <h6 class="navbar-heading p-0 text-muted">
            <span class="docs-normal"></span>
          </h6>
          <!-- Navigation -->
          <ul class="navbar-nav mb-md-3">
             <li class="nav-item">
              <a class="nav-link <?php if($index == 5){ echo 'active'; } ?>" href="<?=base_url('admin/profile')?>"  >
                <i class="ni ni-circle-08 text-black"></i>
                <span class="nav-link-text">Profil saya</span>
              </a>
            </li> 
            <li class="nav-item">
              <a class="nav-link active active-pro" href="<?=base_url('logout')?>">
                <i class="ni ni-button-power text-dark"></i>
                <span class="nav-link-text">Logout</span>
              </a>
            </li>
          </ul>

        </div>
      </div>
    </div>
  </nav>
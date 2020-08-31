<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url() ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">Admin Panel</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Aplikasi Retail</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
           <li class="nav-item">
            <?php 
              if($menu == 'dashboard'){
                  $active = 'active';
              } 
              else {
                  $active = '';
              }
            ?> 
            <a href="#" class="nav-link <?= $active ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
             <?php 
              if($menu == 'barang'){
                  $active = 'active';
              } 
              else {
                  $active = '';
              }
            ?> 
            <a href="<?= base_url() ?>atasan/barang" class="nav-link <?= $active ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Master Data Barang
              </p>
            </a>
          </li>
          <li class="nav-item">
             <?php 
              if($menu == 'transaksi'){
                  $active = 'active';
              } 
              else {
                  $active = '';
              }
            ?> 
            <a href="<?= base_url() ?>atasan/transaksi" class="nav-link <?= $active ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Peminjaman 
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'auth/logout' ?>" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url() ?>" class="brand-link">
      <img src="<?= base_url('assets/') ?>img/logo.png" alt="Logo CAPERTE" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">JELAJAH SULTRA</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= $user_image ?>" class="" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url('profile') ?>" class="d-block"><?= $name ?></a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="<?= base_url('admin/dashboard') ?>" class="nav-link" id="dashboard_index">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/wisata') ?>" class="nav-link" id="wisata_index">
              <i class="nav-icon fas fa-map-pin"></i>
              <p>
                Wisata
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('admin/kategori') ?>" class="nav-link" id="kategori_index">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Data Kategori Wisata
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
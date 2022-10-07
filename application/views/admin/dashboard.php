    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $page ?></h1>
            </div>
          </div>
        </div>
      </div>
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <?php if( $this->session->userdata('role_name') == 'Admin' ): ?>
            <div class="col-lg-lg-4 col-md-4 col-sm-12">
              <div class="info-box shadow-sm">
                <span class="info-box-icon bg-secondary"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Data Admin</span>
                  <span class="info-box-number"><?= $users ?></span>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="col-lg-lg-4 col-md-4 col-sm-12">
              <div class="info-box shadow-sm">
                <span class="info-box-icon bg-success"><i class="fas fa-book"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Wisata</span>
                  <span class="info-box-number"><?= $wisata ?></span>
                </div>
              </div>
            </div>
            <div class="col-lg-lg-4 col-md-4 col-sm-12">
              <div class="info-box shadow-sm">
                <span class="info-box-icon bg-info"><i class="fas fa-th"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Kategori Wisata</span>
                  <span class="info-box-number"><?= $kategori ?></span>
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="card">
                <div class="card-body text-center">
                  <h3>SELAMAT DATANG DI HALAMAN ADMIN</h3>
                  <p class="mt-5"><b>SISTEM INFORMASI<br>PENDATAAN TEMPAT WISATA SULAWESI TENGGARA</b></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
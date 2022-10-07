<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JELAJAH SULTRA</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo" style="font-size: 1.4rem;">
      <a href="<?= base_url() ?>">JELAJAH<b> SULTRA</b></a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk</p>

        <form action="<?= base_url('auth/login') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8"></div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <script>
    if( '<?= $this->session->flashdata('alert') ?>' == 'success' ) {
      Swal.fire( 'Berhasil!', '<?= $this->session->flashdata('message') ?>', 'success' );
    }
    
    if( '<?= $this->session->flashdata('alert') ?>' == 'warning' ) {
      Swal.fire( 'Peringatan!', '<?= $this->session->flashdata('message') ?>', 'warning' );
    }

    if( '<?= $this->session->flashdata('alert') ?>' == 'error' ) {
      Swal.fire( 'Gagal!', '<?= $this->session->flashdata('message') ?>', 'error' );
    }
  </script>
</body>
</html>

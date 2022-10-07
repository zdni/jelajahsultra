  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="image" style="margin-top: -5px">
              <img src="<?= $user_image ?>" class="img-circle elevation-1" alt="User Image" width='35'>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">Setting</span>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('profile') ?>" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Profil
            </a>
            <div class="dropdown-divider"></div>
            <a href="<?= base_url('auth/logout') ?>" class="dropdown-item">
              <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
          </div>
        </li>
      </ul>
    </nav>
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
            <div class="col-12">
              <div class="card">
                <form action="<?= base_url('profile/update') ?>" method="post">
                  <div class="card-header">
                    <h5>Profil</h5>
                  </div>
                  <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                    <input type="hidden" name="username_old" id="username_old" value="<?= $data->username ?>">
                    <div class="form-group">
                      <label for="">Username</label>
                      <input type="text" name="username" id="username" class="form-control" value="<?= $data->username ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="">Nama</label>
                      <input type="text" name="name" id="name" class="form-control" value="<?= $data->name ?>" required>
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Ubah Profil</button>
                  </div>
                </form>
              </div>
              <div class="card mt-5">
                <form action="<?= base_url('profile/update_password') ?>" method="post">
                  <div class="card-header">
                    <h5>Ganti Password</h5>
                  </div>
                  <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                    <input type="hidden" name="password" id="password" value="<?= $data->password ?>">
                    <div class="form-group">
                      <label for="">Password Lama</label>
                      <input type="text" name="old_password" id="old_password" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Password Baru</label>
                      <input type="text" name="new_password" id="new_password" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="">Konfirmasi Password Baru</label>
                      <input type="text" name="confirm_password" id="confirm_password" class="form-control">
                    </div>
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Ganti Password</button>
                  </div>
                </form>
              </div>
              <div class="card mt-5">
                <form action="<?= base_url('profile/change_profile_picture') ?>" method="post" enctype="multipart/form-data">
                  <div class="card">
                    <div class="card-header">
                      <h5>Ganti Foto Profil</h5>
                    </div>
                    <div class="card-body">
                      <input type="hidden" name="id" id="id" value="<?= $data->id ?>">
                      <input type="hidden" name="username" id="username" value="<?= $data->username ?>">
                      <img src="<?= $user_image ?>" alt="Foto Profil" width="150px">
                      <div class="form-group">
                        <label for="">Foto Profil</label>
                        <input type="file" name="image" id="image" class="form-control">
                      </div>
                    </div>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-sm btn-primary">Ganti Foto Profil</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
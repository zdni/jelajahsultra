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
                <div class="card-header">
                  <h5>Daftar <?= $page ?></h5>
                  <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-tambah-users">Tambah <?= $page ?></button>
                  <div class="modal fade" id="modal-tambah-users">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="<?= base_url('admin/users/tambah') ?>" method="post">
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah <?= $page ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <span style="color: red; font-weight: bold; font-size: 10px;">*username harus menggunakan huruf kecil dan tidak boleh menggunakan spasi<br>Password default akan sesuai dengan username</span>
                            <div class="form-group">
                              <label for="">Username</label>
                              <input type="text" class="form-control" name="username" id="username" required>
                            </div>
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                              <label for="">Email</label>
                              <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                              <label for="">Level User</label>
                              <select name="role_id" id="role_id" class="form-control">
                                <?php foreach ($roles as $role) { ?>
                                  <option value="<?= $role->id ?>"><?= $role->name ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-sm btn-primary">Tambah <?= $page ?></button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered table-striped table-hover table-data">
                    <thead>
                      <th>No.</th>
                      <th>Username</th>
                      <th>User</th>
                      <th>Email</th>
                      <th>Level</th>
                      <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $number = 1; foreach ($datas as $data) {  ?>
                        <tr>
                          <td><?= $number ?></td>
                          <td><?= $data->username ?></td>
                          <td><?= $data->name ?></td>
                          <td><?= $data->email ?></td>
                          <td><?= $data->role_name ?></td>
                          <td>
                            <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-ubah-users-<?= $data->id ?>">Ubah</button>
                            <div class="modal fade" id="modal-ubah-users-<?= $data->id ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form action="<?= base_url('admin/users/ubah') ?>" method="post">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Ubah <?= $page ?></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" name="id" id="id" class="form-control" required value="<?= $data->id ?>">
                                      <span style="color: red; font-weight: bold; font-size: 10px;">*username harus menggunakan huruf kecil dan tidak boleh menggunakan spasi<br>Password default akan sesuai dengan username</span>
                                      <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" required value="<?= $data->username ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name" required value="<?= $data->name ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" required value="<?= $data->email ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Level User</label>
                                        <select name="role_id" id="role_id" class="form-control">
                                          <?php foreach ($roles as $role) { ?>
                                            <option <?= ($role->id == $data->role_id) ? 'selected' : '' ?> value="<?= $role->id ?>"><?= $role->name ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-sm btn-primary">Ubah <?= $page ?></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-toggle="modal" data-target="#modal-reset-password-users-<?= $data->id ?>">Reset Password</button>
                            <div class="modal fade" id="modal-reset-password-users-<?= $data->id ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form action="<?= base_url('admin/users/reset_password') ?>" method="post">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Reset Password</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" name="id" id="id" class="form-control" required value="<?= $data->id ?>">
                                      <input type="hidden" name="username" id="username" class="form-control" required value="<?= $data->username ?>">
                                      <p>Yakin ingin mereset password User <?= $data->name ?> menjadi default?</p>
                                      <span style="color: red; font-weight: bold; font-size: 10px;">*default password adalah sama dengan username</span>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-sm btn-secondary">Reset Password</button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                            <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal" data-target="#modal-hapus-users-<?= $data->id ?>">Hapus</button>
                            <div class="modal fade" id="modal-hapus-users-<?= $data->id ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form action="<?= base_url('admin/users/hapus') ?>" method="post">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Hapus <?= $page ?></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" name="id" id="id" class="form-control" required value="<?= $data->id ?>">
                                      <p>Yakin ingin menghapus User <?= $data->name ?></p>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                                      <button type="submit" class="btn btn-sm btn-danger">Hapus <?= $page ?></button>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>                        
                      <?php $number++; } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
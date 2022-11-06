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
                  <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#modal-tambah-wisata">Tambah <?= $page ?></button>
                  <div class="modal fade" id="modal-tambah-wisata">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="<?= base_url('admin/wisata/tambah') ?>" method="post" enctype="multipart/form-data">
                          <div class="modal-header">
                            <h4 class="modal-title">Tambah <?= $page ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="">Nama</label>
                              <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="form-group">
                              <label for="">Jam Operasional</label>
                              <input type="text" class="form-control" name="jam_operasional" id="jam_operasional" required>
                            </div>
                            <div class="form-group">
                              <label for="">Lokasi</label>
                              <textarea name="lokasi" id="lokasi" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="">Fasilitas</label>
                              <textarea name="fasilitas" id="fasilitas" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="">Keterangan</label>
                              <textarea name="keterangan" rows="10" id="keterangan" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="">URL Map</label>
                              <textarea name="map" rows="2" id="map" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <select name="kategori_id" id="kategori_id" class="form-control">
                                    <?php foreach ($kategori as $kat) { ?>
                                        <option value="<?= $kat->id ?>"><?= $kat->nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" name="image" id="image" class="form-control" required>
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
                      <th>Wisata</th>
                      <th>Gambar</th>
                      <th>Aksi</th>
                    </thead>
                    <tbody>
                      <?php $number = 1; foreach ($datas as $data) {  ?>
                        <tr>
                          <td><?= $number ?></td>
                          <td>
                            <?= $data->nama ?>
                            <br>
                            <span class="badge badge-secondary"><?= $data->lokasi ?></span>
                          </td>
                          <td>
                            <img src="<?= base_url('uploads/wisata/') . $data->image ?>" alt="" width="260px">
                          </td>
                          <td>
                            <a href="<?= base_url('admin/wisata/detail/') . $data->id ?>" class="btn btn-sm btn-outline-secondary">Detail</a>
                            <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-ubah-wisata-<?= $data->id ?>">Ubah</button>
                            <div class="modal fade" id="modal-ubah-wisata-<?= $data->id ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form action="<?= base_url('admin/wisata/ubah') ?>" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Ubah <?= $page ?></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" name="id" id="id" class="form-control" required value="<?= $data->id ?>">
                                      <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" name="nama" id="nama" required value="<?= $data->nama ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Jam Operasional</label>
                                        <input type="text" class="form-control" name="jam_operasional" id="jam_operasional" required value="<?= $data->jam_operasional ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="">Lokasi</label>
                                        <textarea name="lokasi" id="lokasi" class="form-control" required><?= $data->lokasi ?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Fasilitas</label>
                                        <textarea name="fasilitas" id="fasilitas" class="form-control" required><?= $data->lokasi ?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="">Keterangan</label>
                                        <textarea name="keterangan" rows="10" id="keterangan" class="form-control" required><?= $data->keterangan ?></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="">URL Map</label>
                                        <textarea name="map" rows="2" id="map" class="form-control" required><?= $data->map ?></textarea>
                                      </div>
                                      <div class="form-group">
                                          <select name="kategori_id" id="kategori_id" class="form-control">
                                              <?php foreach ($kategori as $kat) { ?>
                                                  <option <?php if($data->kategori_id == $kat->id) echo 'selected'; ?> value="<?= $kat->id ?>"><?= $kat->nama ?></option>
                                              <?php } ?>
                                          </select>
                                      </div>
                                      <div class="form-group">
                                          <label for="">Foto</label>
                                          <input type="file" name="image" id="image" class="form-control">
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
                            <button class="btn btn-sm btn-outline-danger" type="button" data-toggle="modal" data-target="#modal-hapus-wisata-<?= $data->id ?>">Hapus</button>
                            <div class="modal fade" id="modal-hapus-wisata-<?= $data->id ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form action="<?= base_url('admin/wisata/hapus') ?>" method="post">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Hapus <?= $page ?></h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <input type="hidden" name="id" id="id" class="form-control" required value="<?= $data->id ?>">
                                      <p>Yakin ingin menghapus SPBU <?= $data->nama ?></p>
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
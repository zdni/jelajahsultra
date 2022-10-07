<div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"><?= $page ?></h1>
              <a href="<?= base_url('admin/wisata') ?>" class="btn btn-sm btn-outline-secondary">Kembali</a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <img src="<?= base_url('uploads/wisata/') . $data->image ?>" alt="" class="img-fluid">
                  <div class="mt-3">
                    <h4><?= $data->nama ?></h4>
                  </div>
                  <div class="col-12">
                    <b>Lokasi</b>
                    <span class="badge badge-secondary px-2 ml-4"><?= $data->lokasi ?></span>
                  </div>
                  <div class="col-12">
                    <b>Jam Operasional</b>
                    <span class="badge badge-success px-2 ml-4"><?= $data->jam_operasional ?></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <p><b>Fasilitas Tempat Wisata</b></p>
                  <?= $data->fasilitas ?>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <p><b>Keterangan Tempat Wisata</b></p>
                  <?= $data->keterangan ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
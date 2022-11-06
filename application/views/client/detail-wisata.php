    <section data-anim="fade" class="d-flex items-center py-15 border-top-light">
    </section>

    <section class="layout-pb-md">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="relative d-flex">
              <img src="<?= base_url('uploads/wisata/') . $data->image ?>" alt="image" class="col-12 rounded-4">

              <div class="absolute z-2 px-50 py-60">
                <h1 class="text-50 fw-600 text-white"><?= $data->nama ?></h1>
                <div class="text-white"><?= $data->lokasi ?></div>
              </div>

            </div>
          </div>
        </div>

        <div class="row y-gap-20 pt-40">

          <div class="col-xl-8">
            <p class="text-15 text-dark-1">
              <?= $data->keterangan ?>              
            </p>
          </div>

        </div>

        <div class="pt-30 mt-30 border-top-light"></div>

        <div class="row y-gap-20">
          <div class="col-12">
            <h2 class="text-22 fw-500">Jam Operasional</h2>
          </div>

          <div class="col-12">
            <?= $data->jam_operasional ?>
          </div>

        </div>

        <div class="pt-30 mt-30 border-top-light"></div>

        <div class="row y-gap-20">
          <div class="col-12">
            <h2 class="text-22 fw-500">Fasilitas</h2>
          </div>
          <div class="col-12">
            <?= $data->fasilitas ?>
          </div>
        </div>

        <div class="pt-30 mt-30 border-top-light"></div>

        <a href="<?= $data->map ?>" target="_blank" class="button -md -blue-1 bg-blue-1-05 text-blue-1">Lihat di Peta</a>

      </div>
    </section>
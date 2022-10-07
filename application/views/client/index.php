    <section data-anim-wrap class="masthead -type-1 z-5">
      <div data-anim-child="fade" class="masthead__bg">
        <img src="#" alt="image" data-src="<?= base_url('assets/client/') ?>img/masthead/1/bg.webp" class="js-lazy">
      </div>

      <div class="container">
        <div class="row justify-center">
          <div class="col-auto">
            <div class="text-center">
              <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Jelajahi Sulawesi Tenggara</h1>
              <p data-anim-child="slide-up delay-5" class="text-white mt-6 md:mt-10">Temukan Destinasi Anda</p>
            </div>

            <div style="width: 100%; height: 213.125px"></div>
          </div>
        </div>
      </div>
    </section>

    <section class="layout-pt-lg layout-pb-md">
      <div class="container">
        <div data-anim="slide-up delay-1" class="row y-gap-20 justify-between items-end">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Destinasi Wisata</h2>
            </div>
          </div>

          <div class="col-auto md:d-none">

            <a href="<?= base_url('dashboard/wisata') ?>" class="button -md -blue-1 bg-blue-1-05 text-blue-1">
              Lihat Semua Destinasi <div class="icon-arrow-top-right ml-15"></div>
            </a>

          </div>
        </div>

        <div class="relative pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="base-2 xl-4 lg-3 md-2 sm-2 base-1" data-anim="slide-up delay-2">
          <div class="swiper-wrapper">
            <?php foreach ($datas as $data) { ?>
              <div class="swiper-slide">
  
                <a href="<?= base_url('dashboard/detail/') . $data->id ?>" class="citiesCard -type-1 d-block rounded-4 ">
                  <div class="citiesCard__image ratio ratio-3:4">
                    <img src="#" data-src="<?= base_url('uploads/wisata/') . $data->image ?>" alt="image" class="js-lazy">
                  </div>
  
                  <div class="citiesCard__content d-flex flex-column justify-between text-center pt-30 pb-20 px-20">
                    <div class="citiesCard__bg"></div>
  
                    <div class="citiesCard__top">
                    </div>
  
                    <div class="citiesCard__bottom">
                      <h4 class="text-18 md:text-12 lh-13 text-white mb-20"><?= $data->nama ?></h4>
                      <button class="button col-12 h-60 -blue-1 bg-white text-dark-1">Lihat</button>
                    </div>
                  </div>
                </a>
  
              </div>
            <?php } ?>

          </div>


          <button class="section-slider-nav -prev flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-prev">
            <i class="icon icon-chevron-left text-12"></i>
          </button>

          <button class="section-slider-nav -next flex-center button -blue-1 bg-white shadow-1 size-40 rounded-full sm:d-none js-next">
            <i class="icon icon-chevron-right text-12"></i>
          </button>


          <div class="slider-scrollbar bg-light-2 mt-40 sm:d-none js-scrollbar"></div>

          <div class="row pt-20 d-none md:d-block">
            <div class="col-auto">
              <div class="d-inline-block">

                <a href="<?= base_url('dashboard/wisata') ?>" class="button -md -blue-1 bg-blue-1-05 text-blue-1">
                  Lihat Semua Destinasi <div class="icon-arrow-top-right ml-15"></div>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="layout-pt-md layout-pb-lg">
      <div class="container">
        <div class="row">
          <div class="col-auto">
            <div class="sectionTitle -md">
              <h2 class="sectionTitle__title">Daftar Destinasi</h2>
            </div>
          </div>
        </div>

        <div class="tabs -pills pt-40 js-tabs">
          <div class="tabs__controls d-flex js-tabs-controls">
            <?php $index = 1; foreach ($kategori as $kat) {  ?>
              <div>
                <button class="tabs__button fw-500 text-15 px-30 py-15 rounded-4 js-tabs-button <?= ($index == 1) ? 'is-tab-el-active' : '' ?>" data-tab-target=".-tab-kategori-<?= $kat->id ?>"><?= $kat->nama ?></button>
              </div>
            <?php $index++; } ?>

          </div>

          <div class="tabs__content pt-30 js-tabs-content">
            <?php $index = 1; foreach ($destinasi as $key => $dest) {  ?>
            
            <div class="tabs__pane -tab-kategori-<?= $key ?> <?= ($index == 1) ? 'is-tab-el-active' : '' ?>">
              <div class="row y-gap-20">
                <?php foreach ($dest as $value) { ?>
                  <div class="w-1/5 lg:w-1/4 md:w-1/3 sm:w-1/2">
                    <a href="<?= base_url('dashboard/detail/') . $value->id ?>" class="d-block">
                      <div class="text-15 fw-500">Deskripsi</div>
                      <div class="text-14 text-light-1"><?= $value->nama ?></div>
                    </a>
                  </div>
                <?php } ?>
              </div>
            </div>

            <?php $index++; } ?>

          </div>
        </div>
      </div>
    </section>
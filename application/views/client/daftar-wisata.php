    <section class="layout-pt-md layout-pb-lg">
      <div class="container">
        <div class="row y-gap-30">
          <div class="col-xl-3 col-lg-4 lg:d-none">
            <aside class="sidebar y-gap-40">
              <form action="<?= base_url('dashboard/wisata') ?>" method="get">
                <div class="sidebar__item -no-border">
                  <h5 class="text-18 fw-500 mb-10">Kategori</h5>
                  <div class="sidebar-checkbox">
                    <?php foreach ($kategori as $value) { ?>
                      <div class="row y-gap-10 items-center justify-between">
                        <div class="col-auto">
                          <div class="d-flex items-center">
                            <div class="form-checkbox ">
                              <input type="checkbox" value="<?= $value->id ?>" name="kategori_id[]" id="kategori_id[]">
                              <div class="form-checkbox__mark">
                                <div class="form-checkbox__icon icon-check"></div>
                              </div>
                            </div>
                            <div class="text-15 ml-10"><?= $value->nama ?></div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="mt-30 sidebar__item -no-border">
                  <div class="single-field relative d-flex items-center py-10">
                    <input class="pl-50 border-light text-dark-1 h-50 rounded-8" type="text" placeholder="e.g. Pantai Toronipa" name="keyword" id="keyword">
                    <button class="absolute d-flex items-center h-full">
                      <i class="icon-search text-20 px-15 text-dark-1"></i>
                    </button>
                  </div>
                </div>
                <div class="mt-30 sidebar__item -no-border">
                  <div class="col-12">
                    <button class="button -dark-1 py-15 px-35 h-60 col-12 rounded-4 bg-blue-1 text-white" type="submit">
                      <i class="icon-search text-20 mr-10"></i>
                      Cari
                    </button>
                  </div>
                </div>
              </form>

            </aside>
          </div>

          <div class="col-xl-9 col-lg-8">
            <div class="row y-gap-10 items-center justify-between">
              <div class="col-auto">
                <!-- <div class="text-18"><span class="fw-500">3,269 properties</span> in Europe</div> -->
              </div>
            </div>

            <div class="border-top-light mt-30 mb-30"></div>
            <div class="row y-gap-30">
              <?php foreach ($datas as $data) { ?>
                <div class="col-lg-4">
                  <a href="<?= base_url('dashboard/detail/') . $data->id ?>" class="tourCard -type-1 rounded-4 ">
                    <div class="tourCard__image">
                      <div class="cardImage ratio ratio-1:1">
                        <div class="cardImage__content">
                          <img class="rounded-4 col-12 js-lazy" src="#" data-src="<?= base_url('uploads/wisata/') . $data->image ?>" alt="image">
                        </div>
                      </div>
                    </div>
  
                    <div class="tourCard__content mt-10">
                      <div class="d-flex items-center lh-14 mb-5">
                        <div class="size-3 bg-light-1 rounded-full ml-10 mr-10"></div>
                        <div class="text-14 text-light-1"><?= $data->jam_operasional ?></div>
                      </div>
  
                      <h4 class="tourCard__title text-dark-1 text-18 lh-16 fw-500">
                        <span><?= $data->nama ?></span>
                      </h4>
  
                      <p class="text-light-1 lh-14 text-14 mt-5"><?= $data->lokasi ?></p>
                    </div>
                  </a>
  
                </div>
              <?php } ?>
            </div>

            <!-- <div class="border-top-light mt-30 pt-30">
              <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                <div class="col-auto md:order-1">
                  <button class="button -blue-1 size-40 rounded-full border-light">
                    <i class="icon-chevron-left text-12"></i>
                  </button>
                </div>

                <div class="col-md-auto md:order-3">
                  <div class="row x-gap-20 y-gap-20 items-center md:d-none">

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">1</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">3</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-light-2">4</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">5</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">...</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">20</div>

                    </div>

                  </div>

                  <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">1</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>

                    </div>

                    <div class="col-auto">

                      <div class="size-40 flex-center rounded-full">3</div>

                    </div>

                  </div>

                  <div class="text-center mt-30 md:mt-10">
                    <div class="text-14 text-light-1">1 – 20 of 300+ properties found</div>
                  </div>
                </div>

                <div class="col-auto md:order-2">
                  <button class="button -blue-1 size-40 rounded-full border-light">
                    <i class="icon-chevron-right text-12"></i>
                  </button>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
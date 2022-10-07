<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url('assets/client/') ?>css/vendors.css">
  <link rel="stylesheet" href="<?= base_url('assets/client/') ?>css/main.css">
  <link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">

  <title>GoTrip</title>
</head>

<body>
  <div class="preloader js-preloader">
    <div class="preloader__wrap">
      <div class="preloader__icon">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="" width="30px">
      </div>
    </div>

    <div class="preloader__title">Jelajah Sultra</div>
  </div>

  <main>
  <?php if( !isset($index) ): ?>
    <div class="header-margin"></div>
  <?php endif; ?>

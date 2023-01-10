<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $this->renderSection('title') ?> - Admin Dashboard</title>

  <link rel="stylesheet" href="<?= base_url('assets/css/main/app.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/main/app-dark.css') ?>" />
  <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.svg') ?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?= base_url('assets/images/logo/favicon.png') ?>" type="image/png" />
  <link rel="stylesheet" href="<?= base_url('assets/css/shared/iconly.css') ?>" />
  <?= $this->renderSection('css') ?>
</head>

<body>
  <script src="<?= base_url('assets/js/initTheme.js') ?>"></script>
  <div id="app">
    <?= $this->include('admin/layout/sidebar') ?>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <div class="page-title">
          <h3><?= $this->renderSection('title-content') ?></h3>
        </div>
        <div class="page-content">
          <?= $this->renderSection('content') ?>
        </div>
      </div>
      <?= $this->renderSection('modal'); ?>
      <?= $this->include('admin/layout/footer') ?>
    </div>
  </div>
  <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/js/app.js') ?>"></script>

  <!-- Need: Apexcharts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <?= $this->renderSection('js') ?>
</body>

</html>
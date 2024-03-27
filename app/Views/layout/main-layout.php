<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>
        <?= $title['title'] ?>
    </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('main/src/images/logo-pek.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('main/src/images/logo-pek.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('main/src/images/logo-pek.png') ?>">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('main/vendors/styles/core.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('main/vendors/styles/icon-font.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('main/vendors/styles/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('main/src/plugins/sweetalert2/sweetalert2.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('main/src/plugins/datatables/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('main/src/plugins/datatables/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('main/src/plugins/jvectormap/jquery-jvectormap-2.0.3.css') ?>">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body>
    <!-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo"><img src="<?= base_url('main/vendors/images/deskapp-logo.svg') ?>" alt=""></div>
            <div class='loader-progress' id="progress_div">
                <div class='bar' id='bar1'></div>
            </div>
            <div class='percent' id='percent1'>0%</div>
            <div class="loading-text">
                Loading...
            </div>
        </div>
    </div> -->

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <?= $this->include('partials/header'); ?>
            <?= $this->include('partials/sidebar'); ?>
            <?= $this->renderSection('content'); ?>
            <?= $this->include('partials/footer'); ?>
        </div>
    </div>

    <!-- js -->
    <script src="<?= base_url('main/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/layout-settings.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/jQuery-Knob-master/jquery.knob.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/highcharts-6.0.7/code/highcharts.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/highcharts-6.0.7/code/highcharts-more.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/dashboard2.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/responsive.bootstrap4.min.js') ?>"></script>
    <!-- buttons for Export datatable -->
    <script src="<?= base_url('main/src/plugins/datatables/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/buttons.print.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/datatables/js/vfs_fonts.js') ?>"></script>
    <!-- Datatable Setting js -->
    <script src="<?= base_url('main/vendors/scripts/datatable-setting.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/sweetalert2/sweetalert2.all.js') ?>"></script>
    <script src="<?= base_url('main/src/plugins/sweetalert2/sweet-alert.init.js') ?>"></script>
</body>

</html>
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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="<?= base_url('main/src/images/logo-pek.png') ?>" alt="" class="light-logo" height="80"
                        width="80" style="margin-left:50px;">
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?= base_url('main/vendors/images/login-page-img.png') ?>" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To SIKA</h2>
                        </div>
                        <form action="<?= site_url('/authprocess') ?>" method="POST">
                            <!-- <form> -->
                            <div class="select-role">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
                                        <input type="radio" name="level" id="SUPERADMIN" value="SUPERADMIN">
                                        <div class="icon"><img
                                                src="<?= base_url('main/vendors/images/briefcase.svg') ?>" class="svg"
                                                alt="">
                                        </div>
                                        <span>I'm</span>
                                        Superadmin
                                    </label>
                                    <label class="btn">
                                        <input type="radio" name="level" id="ADMIN" value="ADMIN">
                                        <div class="icon"><img src="<?= base_url('main/vendors/images/person.svg') ?>"
                                                class="svg" alt=""></div>
                                        <span>I'm</span>
                                        Admin
                                    </label>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="text" class="form-control form-control-lg" placeholder="Username"
                                    name="username" required>
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" class="form-control form-control-lg" placeholder="**********"
                                    required name="password">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
                                        <!-- <a class="btn btn-primary btn-lg btn-block"
                                            href="<?= base_url('/dashboard') ?>">Sign In</a> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="<?= base_url('main/vendors/scripts/core.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/script.min.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/process.js') ?>"></script>
    <script src="<?= base_url('main/vendors/scripts/layout-settings.js') ?>"></script>
</body>

</html>
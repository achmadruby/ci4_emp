<?= $this->extend('layout/main-layout'); ?>

<?= $this->section('content'); ?>

<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Dashboard</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card-box pd-20 height-100-p mb-30">
    <div class="row align-items-center">
        <div class="col-md-4">
            <img src="<?= base_url('main/vendors/images/banner-img.png') ?>" alt="">
        </div>
        <div class="col-md-8">
            <h4 class="font-20 weight-500 mb-10 text-capitalize">
                Selamat Datang <div class="weight-600 font-30 text-blue">
                    <?= $employeeData['nama'] ?>!
                </div>
            </h4>
            <p class="font-18 max-width-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde hic non
                repellendus debitis iure, doloremque assumenda. Autem modi, corrupti, nobis ea iure fugiat, veniam non
                quaerat mollitia animi error corporis.</p>
        </div>
    </div>
</div>
<div class="row clearfix progress-box">
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <input type="text" class="knob dial1" value="<?= $jumlahKaryawan ?>" data-width="120" data-height="120"
                    data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#1b00ff"
                    data-angleOffset="180" readonly>
                <h5 class="text-blue padding-top-10 h5">Jumlah Karyawan Aktif</h5>
                <span class="d-block">
                    <?= $jumlahKaryawan ?> Karyawan
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <input type="text" class="knob dial1" value="<?= $jumlahKaryawanNonaktif ?>" data-width="120"
                    data-height="120" data-linecap="round" data-thickness="0.12" data-bgColor="#fff"
                    data-fgColor="#00e091" data-angleOffset="180" readonly>
                <h5 class="text-green padding-top-10 h5">Jumlah Karyawan Nonaktif</h5>
                <span class="d-block">
                    <?= $jumlahKaryawanNonaktif ?> Karyawan
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <input type="text" class="knob dial1" value="<?= $user ?>" data-width="120" data-height="120"
                    data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#f56767"
                    data-angleOffset="180" readonly>
                <h5 class="text-orange padding-top-10 h5">Jumlah User</h5>
                <span class="d-block">
                    <?= $user ?> User
                </span>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
        <div class="card-box pd-30 height-100-p">
            <div class="progress-box text-center">
                <input type="text" class="knob dial1" value="<?= $dept ?>" data-width="120" data-height="120"
                    data-linecap="round" data-thickness="0.12" data-bgColor="#fff" data-fgColor="#a683eb"
                    data-angleOffset="180" readonly>
                <h5 class="text-purple padding-top-10 h5">Jumlah Departement</h5>
                <span class="d-block">
                    <?= $dept ?> Departement
                </span>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
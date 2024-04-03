<?= $this->extend('layout/main-layout'); ?>

<?= $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Karyawan</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Karyawan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-warning" href="<?= base_url('/emp') ?>" role="button">
                        <i class="icon-copy dw dw-back"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    <img src="<?= base_url('uploads/foto/' . $emp['emp']['image']) ?>" alt="" class="avatar-photo">
                </div>
                <h5 class="text-center h5 mb-0">
                    <?= $emp['emp']['nama'] ?>
                </h5>
                <p class="text-center text-muted font-14">
                    <?= $departmentData['departement'] ?>
                </p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Informasi Pribadi</h5>
                    <ul>
                        <li>
                            <span>Tempat, Tanggal Lahir:</span>
                            <?= $emp['emp']['tempat_lahir'] ?>,
                            <?= \Carbon\Carbon::parse($emp['emp']['tanggal_lahir'])->format('d-m-Y') ?>
                        </li>
                        <li>
                            <span>Jenis Kelamin:</span>
                            <?= $emp['emp']['jenis_kelamin'] ?>
                        </li>
                        <li>
                            <span>No KK:</span>
                            <?= $emp['emp']['no_kk'] ?>
                        </li>
                        <li>
                            <span>Agama:</span>
                            <?= $emp['emp']['agama'] ?>
                        </li>
                        <li>
                            <span>Alamat Email:</span>
                            <?= $emp['emp']['email'] ?>
                        </li>
                        <li>
                            <span>No HP:</span>
                            <?= $emp['emp']['no_hp'] ?>
                        </li>
                        <li>
                            <span>Kewarganegaraan:</span>
                            Indonesia
                        </li>
                        <li>
                            <span>Alamat:</span>
                            <?= $emp['emp']['alamat'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-80-p">
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Informasi Tambahan</h5>
                    <ul>
                        <li>
                            <span>Status:</span>
                            <?= $statusData['status'] ?>
                        </li>
                        <li>
                            <span>Pendidikan:</span>
                            <?= $pendidikanData['pendidikan'] ?>
                        </li>
                        <li>
                            <span>ID Card:</span>
                            <?= $emp['emp']['id_card'] ?>
                        </li>
                        <li>
                            <span>No Absen:</span>
                            <?= $emp['emp']['no_absen'] ?>
                        </li>
                        <li>
                            <span>Alamat Email:</span>
                            <?= $emp['emp']['email'] ?>
                        </li>
                        <li>
                            <span>Tanggal Bergabung:</span>
                            <?= \Carbon\Carbon::parse($emp['emp']['join_date'])->format('d-m-Y') ?>
                        </li>
                        <li>
                            <span>Status Keaktifan:</span>
                            <?= $emp['emp']['active'] ?>
                        </li>
                        <li>
                            <span>Jurusan:</span>
                            <?= $emp['emp']['jurusan'] ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-80-p">
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Sertifikat</h5>
                    <?php foreach ($SertifikatData as $sertifikat): ?>
                        <ul class="mb-10">
                            <li>
                                <div class="task-name text-blue"><i class="icon-copy ion-clipboard"></i>
                                    <?= $sertifikat['sertifikat']; ?>
                                </div>
                                <a href="<?= site_url('/sertifikat/view/' . $sertifikat['file']); ?>" target="_blank">
                                    Lihat Sertifikat <i class="icon-copy ion-share"></i>
                                </a>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
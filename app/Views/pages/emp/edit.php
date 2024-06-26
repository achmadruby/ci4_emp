<?= $this->extend('layout/main-layout'); ?>

<?= $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>
                        <?= $title['title'] ?>
                    </h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?= $title['title'] ?>
                        </li>
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
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">
                    <?= $title['title'] ?>
                </h4>
            </div>
        </div>
        <br>
        <form action="<?= site_url('/emp/update/' . $emp['emp']['id']) ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Dept</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="id_dept" required>
                        <option selected disabled>Pilih Dept</option>
                        <?php foreach ($dept['dept'] as $dept): ?>
                            <option value="<?= $dept['id'] ?>" <?= ($emp['emp']['id_dept'] == $dept['id']) ? 'selected' : ''; ?>>
                                <?= $dept['departement'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Status</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="id_status" required>
                        <option selected disabled>Pilih Status</option>
                        <?php foreach ($status['status'] as $status): ?>
                            <option value="<?= $status['id'] ?>" <?= ($emp['emp']['id_status'] == $status['id']) ? 'selected' : ''; ?>>
                                <?= $status['status'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Pendidikan</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="id_pendidikan" required>
                        <option selected disabled>Pilih Pendidikan</option>
                        <?php foreach ($pendidikan['pendidikan'] as $pendidikan): ?>
                            <option value="<?= $pendidikan['id'] ?>" <?= ($emp['emp']['id_pendidikan'] == $pendidikan['id']) ? 'selected' : ''; ?>>
                                <?= $pendidikan['pendidikan'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">ID Card</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="id_card" value="<?= $emp['emp']['id_card'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">No Absen</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="no_absen" value="<?= $emp['emp']['no_absen'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">NIK</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nik" value="<?= $emp['emp']['nik'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Nama</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nama" value="<?= $emp['emp']['nama'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Tempat Lahir</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="tempat_lahir"
                        value="<?= $emp['emp']['tempat_lahir'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="date" name="tanggal_lahir"
                        value="<?= $emp['emp']['tanggal_lahir'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="jenis_kelamin">
                        <option selected disabled>Pilih Jenis Kelamin</option>
                        <option value="PRIA" <?= ($emp['emp']['jenis_kelamin'] == 'PRIA') ? 'selected' : ''; ?>>Pria
                        </option>
                        <option value="WANITA" <?= ($emp['emp']['jenis_kelamin'] == 'WANITA') ? 'selected' : ''; ?>>Wanita
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Alamat</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="alamat" value="<?= $emp['emp']['alamat'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">No. KK</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="no_kk" value="<?= $emp['emp']['no_kk'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Agama</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="agama">
                        <option selected disabled>Pilih Agama</option>
                        <option value="ISLAM" <?= ($emp['emp']['agama'] == 'ISLAM') ? 'selected' : ''; ?>>Islam
                        </option>
                        <option value="KATOLIK" <?= ($emp['emp']['agama'] == 'KATOLIK') ? 'selected' : ''; ?>>
                            Katolik</option>
                        <option value="PROTESTAN" <?= ($emp['emp']['agama'] == 'PROTESTAN') ? 'selected' : ''; ?>>
                            Protestan</option>
                        <option value="HINDU" <?= ($emp['emp']['agama'] == 'HINDU') ? 'selected' : ''; ?>>Hindu
                        </option>
                        <option value="BUDDHA" <?= ($emp['emp']['agama'] == 'BUDDHA') ? 'selected' : ''; ?>>Budha
                        </option>
                        <option value="KONGHUCU" <?= ($emp['emp']['agama'] == 'KONGHUCU') ? 'selected' : ''; ?>>
                            Konghucu</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Join Date</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="join_date" type="date"
                        value="<?= $emp['emp']['join_date'] ?>">
                </div>
            </div>
            <input class="form-control" type="hidden" name="active" value="<?= $emp['emp']['active'] ?>">
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">No HP</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="no_hp" value="<?= $emp['emp']['no_hp'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Email</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="email" value="<?= $emp['emp']['email'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Jurusan</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="jurusan" value="<?= $emp['emp']['jurusan'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Upload Gambar</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="file" name="image" accept="image/*">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
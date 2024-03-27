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
                    <a class="btn btn-warning" href="<?= base_url('/sertifikat') ?>" role="button">
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
        <?= form_open_multipart('/sertifikat/store') ?>
        <div class="form-group row">
            <label class="col-sm-12 col-md-1 col-form-label">Nama Karyawan</label>
            <div class="col-sm-12 col-md-10">
                <select class="custom-select col-12" name="id_emp" required>
                    <option selected disabled>Pilih Karyawan</option>
                    <?php foreach ($emp['emp'] as $emp): ?>
                        <option value="<?= $emp['id'] ?>">
                            <?= $emp['nama'] ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-1 col-form-label">Judul Sertifikat</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" type="text" name="sertifikat">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-1 col-form-label">Upload Sertifikat</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" type="file" name="file" accept=".pdf">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
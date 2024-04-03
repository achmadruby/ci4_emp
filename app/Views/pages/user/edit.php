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
                    <a class="btn btn-warning" href="<?= base_url('/user') ?>" role="button">
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
        <form action="<?= site_url('/user/update/' . $user['user']['id']) ?>" method="POST">
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Level</label>
                <div class="col-sm-12 col-md-10">
                    <select class="custom-select col-12" name="level">
                        <option selected disabled>Pilih Level</option>
                        <option value="SUPERADMIN" <?= ($user['user']['level'] == 'SUPERADMIN') ? 'selected' : ''; ?>>
                            SuperAdmin
                        </option>
                        <option value="ADMIN" <?= ($user['user']['level'] == 'ADMIN') ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Username</label>
                <div class="col-sm-12 col-md-8">
                    <input class="form-control" type="text" name="username" value="<?= $user['user']['username'] ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-1 col-form-label">Password</label>
                <div class="col-sm-12 col-md-8">
                    <input class="form-control" type="text" name="password">
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
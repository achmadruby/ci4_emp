<?= $this->extend('layout/main-layout'); ?>

<?= $this->section('content'); ?>
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Data Status</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Status</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-primary" href="<?= base_url('/status/create') ?>" role="button">
                        <i class="icon-copy dw dw-add-user"></i> Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">Tabel Data Status</h4>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row data-table-export nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($status['status'] as $status):
                        ?>
                        <tr>
                            <th>
                                <?= $no++ ?>
                            </th>
                            <td class="table-plus">
                                <?= $status['status'] ?>
                            </td>
                            <td>
                                <a href="<?= site_url('/status/edit/' . $status['id']) ?>" class="btn btn-warning btn-sm"><i
                                        class="icon-copy dw dw-edit2"></i></a>
                                <a href="<?= site_url('/status/delete/' . $status['id']) ?>"
                                    class="btn btn-danger btn-sm"><i class="icon-copy dw dw-delete-3"></i></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
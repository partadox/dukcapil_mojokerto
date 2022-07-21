<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Dashboard</h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-account-multiple-outline"></i>
    <?php if (session()->get('level') == 1) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai author.
    <?php } ?>
    <?php if (session()->get('level') == 2) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai admin.
    <?php } ?>
</div>
<div class="row">

    <!-- <div class="col-sm-6 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div class="mini-stat-icon float-right">
                    <i class="mdi mdi-bullhorn-outline bg-secondary text-white"></i>
                </div>
                <div>
                    <h5 class="font-16">Pengumuman</h5>
                </div>
                <h3 class="mt-4">4</h3>
            </div>
        </div>
    </div> -->

</div>

<?= $this->endSection('isi') ?>
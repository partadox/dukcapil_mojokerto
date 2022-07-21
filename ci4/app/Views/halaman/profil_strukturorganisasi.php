<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<div class="page-wrapper">
    <div class="container">
        <div class="course-single-thumb mb-5">
            <img style="object-fit:fill;
                        width:485px;
                        height:600px;
                        border: solid 1px #CCC" src="<?= base_url()?>/img/profil/<?= $struktur_organisasi ?>" alt="" class="img-fluid w-100">
        </div>
    </div>
</div>

<?= $this->endSection('isi') ?>
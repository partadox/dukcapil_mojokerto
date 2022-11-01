<?= $this->extend('main') ?>

<?= $this->section('isi') ?>


<div class="page-wrapper">
    <div class="container">
        <div class="post-single">
            <div class="single-post-content">
                <div class="author">
                    <div class="author-img">
                        <img src="<?= base_url()?>/img/profil/<?= $sambutan_foto ?>" alt="" class="img-fluid">
                    </div>
                    <div class="author-info">
                        <h4> <?= $sambutan_nama ?></h4>
                        <p> <b><?= $sambutan_jabatan ?></b></p>
                    </div>
                </div>
                <blockquote>
                    <p> <?= $sambutan_isi ?> </p>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('isi') ?>
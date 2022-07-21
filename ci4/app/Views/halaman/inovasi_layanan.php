<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">

            <?php
            foreach ($inovasi as $data_inovasi) :?>

                <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"><?= $data_inovasi['inovasi_judul'] ?></h4>
                    <?= $data_inovasi['inovasi_isi'] ?>
                </div>

            <?php endforeach; ?>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
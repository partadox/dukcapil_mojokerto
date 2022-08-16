<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">

                <!-- Deskripsi ZI Start-->
                <div class="course-widget course-info">
                    <h4 class="course-title">Zona Integritas</h4>
                    <?= $zi_deskripsi ?>
                </div>
                <!-- Deskripsi ZI end-->

                <!-- Deskripsi file ZI Start-->
                <?php
                foreach ($zi_file as $data_zi) :?>
                    <h6 class="course-title"><?= $data_zi['zi_nama'] ?></h6>
                    <div class="course-widget course-info">
                        <iframe src="<?= base_url()?>/doc/zi/<?= $data_zi['zi_file'] ?>" width="100%" height="900px" allow="autoplay"></iframe>
                    </div>
                <?php endforeach; ?>
                <!-- Deskripsi file ZI end-->
                

            </div>
        </div>
    </div>
</section>


<?= $this->endSection('isi') ?>
<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">

                <!-- Tupoksi Start-->
                <div class="course-widget course-info">
                    <h4 class="course-title">Kebijakan Mutu</h4>
                    <?= $kualitas_deskripsi ?>
                </div>
                <!-- Tupoksi end-->

                <!-- Tupoksi Start-->
                <div class="course-widget course-info">
                    <iframe src="<?= base_url()?>/doc/profil/<?= $kualitas_pdf ?>" width="100%" height="900px" allow="autoplay"></iframe>
                </div>
                <!-- Tupoksi end-->

            </div>
        </div>
    </div>
</section>


<?= $this->endSection('isi') ?>
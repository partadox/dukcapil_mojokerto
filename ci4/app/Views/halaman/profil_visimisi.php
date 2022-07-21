<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">
                <!-- Visi Start-->
                <div class="course-widget course-info">
                    <h4 class="course-title">Visi Dinas Kependudukan dan Catatan Sipil Kota Mojokerto </h4>
                    <p> <b> <?= $visi ?></b></p>
                </div>
                <!-- Visi end-->

                <!-- Misi Start-->
                <div class="course-widget course-info">
                    <h4 class="course-title">Misi Dinas Kependudukan dan Catatan Sipil Kota Mojokerto</h4>
                    <p><b><?= $misi ?></b></p>
                    
                </div>
                <!-- Misi end-->

            </div>
        </div>
    </div>
</section>


<?= $this->endSection('isi') ?>
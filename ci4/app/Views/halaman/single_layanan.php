<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h2 style="color:white;">Dispendukcapil Kota Mojokerto</h2>
            <h4><a style="color:white;" href="<?= base_url('home/layanan_kategori/' . $LK_slug) ?>"> <?= esc($LK_nama) ?> </a> <i style="color:white;" class="ti-arrow-right"></i> <a style="color:white;"> <?= $layanan->layanan_subkategori ?></a> </h4>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">

                <div style="background-color: #ffffff;" class="course-widget course-info">
                    <h4 class="course-title"><?= $layanan->layanan_subkategori ?></h4>
                    
                    <p><?= $layanan->layanan_deskripsi ?></p>

                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
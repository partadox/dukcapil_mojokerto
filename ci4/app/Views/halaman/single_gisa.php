<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h4><a style="color:white;" href="<?= base_url('home/gisa_kategori/') ?>">Lapak Gisa Kategori: <?= $GK_nama ?> </a> <i style="color:white;" class="ti-arrow-right"></i> <a style="color:white;" href="<?= base_url('home/gisa_subkategori/' . $GK_slug) ?>"> Sub-Kategori: <?= $GKS_nama ?> </a> <i style="color:white;" class="ti-arrow-right"></i> <a style="color:white;"> Sub-Sub-Kategori: <?= $gisa->gisa_subkategori ?></a></h4>
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
                    <h4 class="course-title"><?= $gisa->gisa_subkategori ?></h4>
                    
                    <div class="course-widget course-info">
                        <iframe src="<?= base_url()?>/doc/gisa/<?= $gisa->gisa_file ?>" width="100%" height="900px" allow="autoplay"></iframe>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
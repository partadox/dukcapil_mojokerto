<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1><?= $LK_nama ?></h1>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="category-section3 mt-4">
        <div class="row no-gutters">
                <?php
                foreach ($layanan as $data_layanan) :?>
                    <div class="col-lg-3 col-md-6">
                        <div class="course-category">
                            <div class="category-icon">
                                <i class="bi bi-file"></i>
                            </div>
                            <h4><a href="<?= base_url('home/layanan/'. $data_layanan['layanan_slug']) ?>"><?= esc($data_layanan['layanan_subkategori']) ?></a></h4>
                        </div>
                    </div>

                <?php endforeach; ?>
        </div>
</section>

<?= $this->endSection('isi') ?>
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
    <div class="container">
        <div class="row no-gutters">
            <div class="course-categories">

                <?php
                foreach ($layanan as $data_layanan) :?>
                    <div class="category-item category-bg-3 mb-3">
                      <a href="<?= base_url('home/layanan/'. $data_layanan['layanan_slug']) ?>">
                        <div class="category-icon">
                            <i class="bi bi-file"></i>
                        </div>
                        <h3 style="color:#eee;"><?= esc($data_layanan['layanan_subkategori']) ?></h3>
                      </a>
                    </div>

                <?php endforeach; ?>

                

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
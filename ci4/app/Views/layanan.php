<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1 style="font-size:3.5vw;"><?= $LK_nama ?></h1>
          </div>
      </div>
    </div>
  </div>
</section>

<?php if ($LK_id == 8) { ?>
  <div class="row">
  <div class="col-lg-8">
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
  </div>
  <div class="col-sm-4 mt-4" style="padding-left:130px; padding-right:50px;" >
     <div class="course-sidebar">
        <div class="course-widget course-details-info">
          <h4 class="course-title">Pengaduan</h4>
          <a href="http://curhatningita.lapor.go.id/" target="_blank">
              <img style="object-fit:fill;
              width:350px;
              height:100px;" src="<?= base_url('/assets/images/ita.png') ?>" alt="" class="img-fluid">
          </a>
          <a href="https://wa.me/6285704241163" target="_blank">
              <img style="object-fit:fill;
              width:350px;
              height:100px;" src="<?= base_url('/assets/images/chat-via-WA.png') ?>" alt="" class="img-fluid">
          </a>
        </div>
     </div>
  </div>
  </div>
  
  
<?php } ?>

<?php if ($LK_id != 8) { ?>
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
<?php } ?>



<?= $this->endSection('isi') ?>
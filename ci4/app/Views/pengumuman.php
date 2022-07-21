<?= $this->extend('main') ?>

<?= $this->section('isi') ?>


<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1><?= $title ?></h1>
          </div>
      </div>
    </div>
  </div>
</section>


<section class="section-padding course">

    <div class="container">
        <div class="row">

            <?php
            foreach ($pengumuman as $data_pengumuman) :?>

                <div class="col-lg-4 col-md-6">
                    <div class="course-block">
                        <div class="course-img">
                            <img src="<?= base_url('img/pengumuman/default.png') ?>" alt="Dispendukcapil Kota Mojokerto" class="img-fluid">
                        </div>
                        
                        <div class="course-content"> 
                            <h4><a href="<?= base_url('home/pengumuman/' . $data_pengumuman['pengumuman_slug']) ?>"><?= esc($data_pengumuman['pengumuman_judul']) ?></a></h4> 
                        </div>
						<div class="course-meta ml-3">
                                <span><i class="bi bi-calendar"></i><?= date_indo($data_pengumuman['pengumuman_create_dt']) ?></span>
                                <span><i class="bi bi-user-ID"></i><?= esc($data_pengumuman['pengumuman_creator']) ?></span>
                            </div> 
                    </div>
                </div>
            
            <?php endforeach; ?>

            
        </div>


        <div class="row">
            <div class="col-lg-12">
                <?= $pager->links('tb_berita', 'custom_pagination'); ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
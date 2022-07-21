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
            foreach ($galeri as $data_galeri) :?>

                <div class="col-lg-4 col-md-6">
                    <div class="course-block">
                        <div class="course-img">
                            <img src="<?= base_url('img/sampul/' . $data_galeri['galeri_sampul']) ?>" alt="Dispendukcapil Kota Mojokerto" class="img-fluid">
                        </div>
                        
                        <div class="course-content"> 
                            
                            <h4><a href="<?= base_url('home/galeri/' . $data_galeri['galeri_slug']) ?>"><?= esc($data_galeri['galeri_nama']) ?></a></h4> 
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>

            
        </div>


        <div class="row">
            <div class="col-lg-12">
                <?= $pager->links('tb_galeri', 'custom_pagination'); ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
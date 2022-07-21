<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h2 style="color:white;">Dispendukcapil Kota Mojokerto</h2>
            <h4><a style="color:white;" href="<?= base_url('home/galeri') ?>"> Galeri </a> <i style="color:white;" class="ti-arrow-right"></i> <a style="color:white;" href="<?= base_url('home/galeri/' . $galeri->galeri_slug) ?>"> <?= esc($galeri->galeri_nama) ?></a> </h4>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="section-padding course">

    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <h3><?= $title ?></h3><br>
                <div id="galeri" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img src="<?= base_url('img/sampul/thumb/' . 'thumb_' . $galeri->galeri_sampul) ?>" alt="..." class="d-block img-fluid mx-auto">
                            <div class="carousel-caption d-none d-md-block">
                                <h4 style="color:white; background-color:#0c4805b8;">List Foto - Galeri <?= $galeri->galeri_nama ?> </h4>
                            </div>
                        </div>
                        <?php
                        foreach ($list_foto as $data) :
                        ?>
                            <div class="carousel-item">
                                <img src="<?= base_url('img/foto/thumb/' . 'thumb_' . $data['foto_nama']) ?>" alt="..." width="100%" class="d-block img-fluid mx-auto">
                                <div class="carousel-caption d-none d-md-block">
                                    <h4 style="color:white; background-color:#0c4805b8;"><?= $data['foto_keterangan'] ?> </h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#galeri" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#galeri" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                

                <div class="course-sidebar">
                    <div class="course-widget course-share d-flex justify-content-between align-items-center">
                        <a href="#"> <i style="background:#cd920b;" class="bi bi-calendar"></i> <?= longdate_indo($galeri->galeri_create_dt) ?></a>
                        <a href="#"> <i style="background:#cd920b;" class="bi bi-user-ID"></i> <?= $galeri->galeri_creator ?></a>
                    </div>
                </div>

                <div class="course-sidebar">
                    <div class="course-widget course-share d-flex justify-content-between align-items-center">
                        <span>Share</span>
                        <ul class="social-share list-inline">
                            <li class="list-inline-item"><a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/galeri/' . $galeri->galeri_slug) ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li  class="list-inline-item"><a href="http://twitter.com/share?url=<?= base_url('home/galeri/' .  $galeri->galeri_slug) ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li  class="list-inline-item"><a href="whatsapp://send?text=<?= base_url('home/galeri/' .  $galeri->galeri_slug) ?>" target="_blank" data-action="share/whatsapp/share"><i style="background:#44a747;" class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</section>

<?= $this->endSection('isi') ?>
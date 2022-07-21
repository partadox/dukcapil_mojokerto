<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h2 style="color:white;">Dispendukcapil Kota Mojokerto</h2>
            <h4><a style="color:white;" href="<?= base_url('home/pengumuman') ?>"> Pengumuman </a> <i style="color:white;" class="ti-arrow-right"></i> <a style="color:white;" href="<?= base_url('home/pengumuman/' . $pengumuman->pengumuman_slug) ?>"> <?= esc($pengumuman->pengumuman_judul) ?></a> </h4>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="section-padding course">

    <div class="container">
        <div class="row">

            <div class="col-lg-8">
                <div class="course-single-header black-text">
                    <span class="subheading">Pengumuman</span>
                    <h3 class="single-course-title"><?= $title ?></h3>  
                </div>
            </div>

            <div class="col-lg-4">

                <div class="course-sidebar">
                    <div class="course-widget course-share d-flex justify-content-between align-items-center">
                        <a href="#"> <i style="background:#cd920b;" class="bi bi-calendar"></i> <?= longdate_indo($pengumuman->pengumuman_create_dt) ?></a>
                        <a href="#"> <i style="background:#cd920b;" class="bi bi-user-ID"></i> <?= $pengumuman->pengumuman_creator ?></a>
                    </div>
                </div>

                <div class="course-sidebar">
                    <div class="course-widget course-share d-flex justify-content-between align-items-center">
                        <span>Share</span>
                        <ul class="social-share list-inline">
                            <li class="list-inline-item"><a href="http://www.facebook.com/sharer.php?u=<?= base_url('home/pengumuman/' . $pengumuman->pengumuman_slug) ?>" target="_blank"><i class="fab fa-facebook"></i></a></li>
                            <li  class="list-inline-item"><a href="http://twitter.com/share?url=<?= base_url('home/pengumuman/' .  $pengumuman->pengumuman_slug) ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li  class="list-inline-item"><a href="whatsapp://send?text=<?= base_url('home/pengumuman/' .  $pengumuman->pengumuman_slug) ?>" target="_blank" data-action="share/whatsapp/share"><i style="background:#44a747;" class="fab fa-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="single-course-details ">
                    <?= $pengumuman->pengumuman_isi ?>
                </div>
            </div>
        </div>

    </div>
</section>


<?= $this->endSection('isi') ?>
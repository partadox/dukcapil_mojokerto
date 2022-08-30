<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<!-- Banner Start -->
<section class="banner-style-8">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-4">
                <div class="banner-content">
                    <span class="subheading">DISPENDUKCAPIL KOTA MOJOKERTO</span>
                    <h1>Kami Ada <br> Untuk Anda</h1>
                    <a href="#">
                        <img style="object-fit:fill;
                        width:150px;
                        height:150px;" src="<?= base_url('/img/walikota/' . $foto_walkot) ?>" alt="" class="img-fluid">
                    </a>
                    <a href="#">
                        <img style="object-fit:fill;
                        width:150px;
                        height:150px;" src="<?= base_url('/img/walikota/' . $foto_wakil) ?>" alt="" class="img-fluid">
                    </a> <br>
                    <a class="mt-4 ml-4" ><?= $nama_walkot_wakil ?></a> <br>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="testimonials-slides-2 owl-carousel owl-theme">

                    <?php
                    foreach ($berita_pin as $pin1) :?>
                    <div class="review-item">
                        <div class="client-info">
                            <a href="<?= base_url('home/berita/' . $pin1['berita_slug']) ?>">
                                <img style="object-fit:fill;
                                width:350px;
                                height:350px;
                                border: solid 1px #CCC" src="<?= base_url('img/berita/' . $pin1['berita_sampul']) ?>" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="client-desc">
                            <div class="client-text">
                                <a href="<?= base_url('home/berita/' . $pin1['berita_slug']) ?>">
                                    <h4>Berita - <?= esc($pin1['berita_judul']) ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php
                    foreach ($pengumuman_pin as $pin2) :?>
                    <div class="review-item">
                        <div class="client-info">
                            <a href="<?= base_url('home/pengumuman/' . $pin2['pengumuman_slug']) ?>">
                                <img style="object-fit:fill;
                                width:350px;
                                height:350px;
                                border: solid 1px #CCC" src="<?= base_url()?>/img/pengumuman/default.png" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="client-desc">
                            <div class="client-text">
                                <a href="<?= base_url('home/pengumuman/' . $pin2['pengumuman_slug']) ?>">
                                    <h4>Pengumuman - <?= esc($pin2['pengumuman_judul']) ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <?php
                    foreach ($penghargaan_pin as $pin3) :?>
                    <div class="review-item">
                        <div class="client-info">
                            <a href="<?= base_url('home/penghargaan/' . $pin3['penghargaan_slug']) ?>">
                                <img style="object-fit:fill;
                                width:350px;
                                height:350px;
                                border: solid 1px #CCC" src="<?= base_url('img/penghargaan/' . $pin3['penghargaan_gambar']) ?>" alt="" class="img-fluid">
                            </a>
                        </div>
                        <div class="client-desc">
                            <div class="client-text">
                                <a href="<?= base_url('home/penghargaan/' . $pin3['penghargaan_slug']) ?>">
                                    <h4>Penghargaan - <?= esc($pin3['penghargaan_nama']) ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    
                  </div>
            </div>
        </div> <!-- / .row -->
    </div> <!-- / .container -->
</section>

<!-- Statistik Data Kependudukan start -->
<section class="feature-2  mt--100">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-4 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="text-center feature-icon">
                        <i class="bi bi-user-ID"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="text-center"><?= $jp_jenkel ?></h4>
                        <h6 class="text-center"><?= $jp_update ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="text-center feature-icon">
                        <i class="bi bi-user-ID"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="text-center"><?= $jp_wajib_ktp_jenkel ?></h4>
                        <h6 class="text-center"><?= $jp_update ?></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-item feature-style-2">
                    <div class="text-center feature-icon">
                        <i class="bi bi-user-ID"></i>
                    </div>
                    <div class="feature-text">
                        <h4 class="text-center"><?= $jp_kepemilikan_kk ?></h4>
                        <h6 class="text-center"><?= $jp_update ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--  Pelayanan start-->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="section-heading center-heading">
                    <h3>Pelayanan</h3>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            <div class="course-categories">
                
                    <?php
                    foreach ($layanan as $data_layanan) :?>
                        <div class="category-item category-bg-2">
                            <a href="<?= base_url('home/layanan/'. $data_layanan['layanan_slug']) ?>">
                                <div class="category-icon">
                                    <i class="bi bi-layer"></i>
                                </div>
                                <h4><?= esc($data_layanan['layanan_subkategori']) ?></h4>
                            </a>
                        </div>
                    <?php endforeach; ?>
                
            </div>
        </div>
    </div>
</section>

<!-- Semua Berita-->
<section class="section-padding course-grid-2 bg-feature">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-heading">
                    <span class="subheading">Kami Ada Untuk Anda</span>
                    <h3>Berita</h3>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="course-btn text-lg-right"><a href="<?= base_url('home/berita') ?>" class="btn btn-main">Lihat Selengkapnya <i class="fa fa-arrow-right ml-2"></i></a></div>
            </div>
        </div>

        <div class="row course-gallery ">
            <?php
            foreach ($berita as $data_berita) :?>

                <div class="course-item berita col-lg-4 col-md-6">
                    <div class="course-block style-5">
                        <div class="course-img">
                            <a href="<?= base_url('home/berita/' . $data_berita['berita_slug']) ?>">
                                <img style="object-fit:fill;
                                width:600px;
                                height:380px;
                                border: solid 1px #CCC" src="<?= base_url('img/berita/' . $data_berita['berita_sampul']) ?>" alt="" class="img-fluid">
                            </a>
                        </div>
                        
                        <div class="course-content">
                            <span>Berita</span>
                            <h4><a href="<?= base_url('home/berita/' . $data_berita['berita_slug']) ?>"><?= esc($data_berita['berita_judul']) ?></a></h4>    
                        
                            <div class="course-meta">
                                <span><i class="bi bi-calendar"></i><?= date_indo($data_berita['berita_create_dt']) ?></span>
                                <span><i class="bi bi-user-ID"></i><?= esc($data_berita['berita_creator']) ?></span>
                            </div> 
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>

        </div>
    </div>
</section>
<!-- Berita End -->

<!-- Pengumuman Start -->
<section class="about-section section-padding">
    <div class="container">
        <div class="row align-items-center">
             <div class="col-lg-6 col-md-12">
               <div class="about-img">
                   <img src="assets/images/bg/anouncement.png" alt="" class="img-fluid">
               </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="section-heading">
                    <span class="subheading">Kami Ada Untuk Anda</span>
                    <h3>Pengumuman</h3>
                </div>

                <div class="about-content">
                    <?php
                    foreach ($pengumuman as $data_pengumuman) :?>
                        <div class="about-text-block">
                            <i class="bi bi-speaker-on"></i>
                            <h3><a href="<?= base_url('home/pengumuman/' . $data_pengumuman['pengumuman_slug']) ?>"><?= esc($data_pengumuman['pengumuman_judul']) ?></a></h3>  
                        </div>
                    <?php endforeach; ?>

                    <a href="<?= base_url('home/pengumuman') ?>" class="btn btn-main">Lihat Selengkapnya <i class="fa fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section> 
<!-- Pengumuman End -->

<!--  Galeri Start -->
<section class="section-padding popular-courses bg-grey">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-7">
                <div class="section-heading center-heading">
                    <h3>Galeri</h3>
                </div>
            </div>
        </div>

        
        <div class="course-btn text-lg-right mb-2"><a href="<?= base_url('home/galeri') ?>" class="btn btn-main">Lihat Selengkapnya <i class="fa fa-arrow-right ml-2"></i></a></div>
      

        <div class="row">

            <?php
            foreach ($galeri as $data_galeri) :?>

                <div class="col-lg-4 col-md-6">
                    <div class="course-block style-5">
                        <div class="course-img">
                            <a href="<?= base_url('home/galeri/' . $data_galeri['galeri_slug']) ?>">
                                <img style="object-fit:fill;
                                width:600px;
                                height:385px;
                                border: solid 1px #CCC" src="<?= base_url('img/sampul/' . $data_galeri['galeri_sampul']) ?>" alt="" class="img-fluid">
                            </a>
                        </div>
                        
                        <div class="course-content"> 
                            <h4><a href="<?= base_url('home/galeri/' . $data_galeri['galeri_slug']) ?>"><?= esc($data_galeri['galeri_nama']) ?></a></h4>   
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>

        </div>
    </div>
</section>

<!--Data Statistik Pengunjung section start-->
<section class="section-padding video-section" >
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading text-center center-heading">
                    <h3>Statistik Pengunjung</h3>
                </div>
            </div>
        </div>

        <div class="row counter-wrap counter-section ptb-40">
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <i class="ti-dashboard"></i>
                    <div class="count">
                        <span class="counter h2"><?= $visitor_hariini ?></span>
                    </div>
                    <p>Hari ini </p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <i class="ti-dashboard"></i>
                    <div class="count">
                        <span class="counter h2"><?= $visitor_bulanini ?></span>
                    </div>
                    <p>Bulan ini</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">         
                <div class="counter-item">
                    <i class="ti-dashboard"></i>
                    <div class="count">
                        <span class="counter h2"><?= $visitor_tahunini ?></span>
                    </div>
                    <p>Tahun ini</p>
                </div>
            </div>
        
            <div class="col-lg-3 col-md-6">
                <div class="counter-item">
                    <i class="ti-heart"></i>
                    <div class="count">
                        <span class="counter h2"><?= $visitor_total ?></span>
                    </div>
                    <p>Total</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--  Link Terkait start -->
<section class="testimonial bg-grey section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-heading center-heading text-center">
                    <span class="subheading">Web Pemerintah Kota Mojokerto Lain</span>
                    <h3>Link Terkait</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonials-slides owl-carousel owl-theme">

                    <?php
                    foreach ($link as $data_link) :?>
                        <div class="review-item">
                            <div class="client-logo">
                                <a href="<?= esc($data_link['link_url']) ?>"><img style="object-fit:fill;
                                width:280px;
                                height:100px;
                                border: solid 1px #CCC" src="<?= base_url('img/link/' . $data_link['link_gambar']) ?>"  alt="" class="img-fluid"></a>
                            </div>
                            <div class="client-desc">
                                <div class="client-text">
                                    <a href="<?= esc($data_link['link_url']) ?>"><h4><?= esc($data_link['link_nama']) ?></h4></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                  </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial section-padding">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-4">
                <div class="section-heading">
                    <span class="subheading">Ulasan Google</span>
                    <h3>Kritik, Saran, dan Ulasan Anda Sangat Bermanfaat Bagi Kami</h3>
                </div>
            </div>
       
            <div class="col-lg-8">
                <div class="testimonials-slides-2 owl-carousel owl-theme">
                    <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Puas banget .pelayanannya ramah dan cepat di dispenduk capil Cetak KTP rusak gak sampai 5 menit Langsung jadi 😍</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/woman.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Ma Fafarida</h4>
                            </div>
                        </div>
                    </div>

                     <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Alhamdulillah pelayan cepat,mudah & ramah oleh kantor dispenduk kota mojokerto untuk penggurusan cetak kk yg hilang& pengurusan akte kelahiran,semoga kedepan pelayannya lebih baik agar bisa bermanfaat bagi warga mojokerto kota</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/man.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Herdan Avilon</h4>
                            </div>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Pembuatan akte kematian dan ktp cepat, pelayanan bagus. Terimakasih Dispenduk Capil</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/woman.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Susi Hari Winarti</h4>
                            </div>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Terima kasih Dispendukcapil kota Mojokerto saya sangat terbantu dan senang atas pelayanan yg diberikan semoga sukses dan maju kedepannya 👍👍</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/man.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Arif Fin</h4>
                            </div>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Pelayanan sangat baik, WA kirim berkas jam 2 jam 3 dikonfirmasi bahwa KK & KTP yg baru sudah selesai , bisa diambil besoknya . Semoga terus seperti ini pelayanannya 🙏🏻👍👍</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/woman.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Nanik Nita</h4>
                            </div>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="client-info">
                            <i class="bi bi-quote"></i>
                            <p>Pelayanan fast respon, weekend dan hari libur tetap bekerja, semangat trus untuk menjadi lebih baik dalam melayani masyarakat kota Mojokerto.</p>
                             <div class="rating">
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                                <a><i class="fa fa-star"></i></a>
                            </div>
                        </div>
                        <div class="client-desc">
                            <div class="client-img">
                                <img src="assets/images/clients/man.png" alt="" class="img-fluid">
                            </div>
                            <div class="client-text">
                                <h4>Heru Sutrisno</h4>
                            </div>
                        </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</section>

<section class="cta-2">
    <div class="container">
        <div class="row align-items-center subscribe-section ">
            <div class="col-lg-6">
                <div class="section-heading white-text">
                    <span class="subheading">Ulasan Google</span>
                    <h3>Berikan Ulasan Anda</h3>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="subscribe-form">
                    <form action="#">
                        <!-- <input type="text" class="form-control" placeholder="Email Address"> -->
                        <a href="https://www.google.com/search?q=dispendukcapil%20kota%20mojokerto&oq=dispendukcapil+kota+mojokerto&tbs=lf:1,lf_ui:2&tbm=lcl&rflfq=1&num=10&rldimm=16599407297742711441&lqi=Ch1kaXNwZW5kdWtjYXBpbCBrb3RhIG1vam9rZXJ0b0jyoemQuq2AgAhaKRAAGAEYAiIdZGlzcGVuZHVrY2FwaWwga290YSBtb2pva2VydG8yAmlkkgERZ292ZXJubWVudF9vZmZpY2WaASNDaFpEU1VoTk1HOW5TMFZKUTBGblNVUkpka3RmTkZwUkVBRaoBFhABKhIiDmRpc3BlbmR1a2NhcGlsKCY&ved=2ahUKEwiG3ajVx_H4AhWonNgFHf5oBocQvS56BAgMEAE&sa=X&rlst=f#rlfi=hd:;si:16599407297742711441,l,Ch1kaXNwZW5kdWtjYXBpbCBrb3RhIG1vam9rZXJ0b0jyoemQuq2AgAhaKRAAGAEYAiIdZGlzcGVuZHVrY2FwaWwga290YSBtb2pva2VydG8yAmlkkgERZ292ZXJubWVudF9vZmZpY2WaASNDaFpEU1VoTk1HOW5TMFZKUTBGblNVUkpka3RmTkZwUkVBRaoBFhABKhIiDmRpc3BlbmR1a2NhcGlsKCY;mv:[[-7.4677909,112.439889],[-7.489777300000001,112.4257411]];tbs:lrf:!1m4!1u3!2m2!3m1!1e1!1m4!1u2!2m2!2m1!1e1!2m1!1e2!2m1!1e3!3sIAE,lf:1,lf_ui:2" target="blank" style="background:#D16644;" class="btn btn-main">Google Review<i class="fa fa-angle-right ml-2"></i> </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection('isi') ?>
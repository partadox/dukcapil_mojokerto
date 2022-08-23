<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Website Resmi Dinas Kependudukan dan Catatan Sipil Kota Mojokerto">
  
  <meta name="Dinas Kependudukan dan Catatan Sipil Kota Mojokerto" content="https://dispenduk.mojokertokota.go.id/">

  <title>Dinas Kependudukan dan Catatan Sipil Kota Mojokerto Official Website</title>

  <!-- Mobile Specific Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- bootstrap.min css -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/bootstrap/bootstrap.css">
  <!-- Iconfont Css -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/bicon/css/bicon.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/themify/themify-icons.css">
  <!-- animate.css -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/animate-css/animate.css">
  <!-- WooCOmmerce CSS -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/woocommerce/woocommerce-layouts.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/woocommerce/woocommerce-small-screen.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/woocommerce/woocommerce.css">
   <!-- Owl Carousel  CSS -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/owl/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/vendors/owl/assets/owl.theme.default.min.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/responsive.css">

  <!-- Map Responsive -->
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/map-responsive.css">

  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url()?>/assets/images/favicon.png">

  <!-- Login Register CSS -->
  <link href="<?= base_url() ?>/assets/css/front_login_reg.css" rel="stylesheet" type="text/css">

  <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

</head>

<body id="top-header">

  
<!--  Header Menu start -->
    
<header>
    <div class="header-top header-top-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header-right float-right">
                        <div class="header-socials">
                            <ul>
                                <li><a href="<?= $facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="<?= $twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="<?= $instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                <li><a href="<?= $youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <!-- Main Menu Start -->
   
    <div class="site-navigation main_menu menu-style-8" id="mainmenu-area">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url('home') ?>">
                    <img src="<?= base_url()?>/assets/images/Logo-Dukcapil-Mojokerto.png" alt="Edutim" class="img-fluid">
                </a>

                <!-- Toggler -->

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a href="<?= base_url('home') ?>" class="nav-link js-scroll-trigger">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbar3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Profil<i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                 <a class="dropdown-item " href="<?= base_url('home/profil_sambutan') ?>">
                                    Sambutan Kepala Dinas
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/profil_visimisi') ?>">
                                    Visi Misi
                                </a> 
                                <a class="dropdown-item " href="<?= base_url('home/profil_strukturorganisasi') ?>">
                                    Struktur Organisasi 
                                </a> 
                                <a class="dropdown-item " href="<?= base_url('home/profil_tupoksi') ?>">
                                    Tupoksi 
                                </a> 
                                <a class="dropdown-item " href="<?= base_url('home/profil_kebijakan_mutu') ?>">
                                    Kebijakan Mutu
                                </a>  
                                
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('home/inovasi_layanan') ?>" class="nav-link js-scroll-trigger">
                                Inovasi Layanan
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbar3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Layanan<i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                <?php
                                foreach ($layanan_kategori as $data_LK) :?>
                                    <a class="dropdown-item " href="<?= base_url('home/layanan_kategori/'. $data_LK['LK_slug']) ?>">
                                        <?= esc($data_LK['LK_nama']) ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbar3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Media & Informasi<i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                <a class="dropdown-item " href="<?= base_url('home/alur_adu') ?>">
                                    Alur Pengaduan Masyarakat
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/berita') ?>">
                                    Berita
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/pengumuman') ?>">
                                    Pengumuman
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/penghargaan') ?>">
                                    Penghargaan
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/ikm') ?>">
                                    Indeks Kepuasan Masyarakat 
                                </a> 
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbar3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Zona Integritas<i class="fa fa-angle-down"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbar3">
                                <a class="dropdown-item " href="http://wbs.mojokertokota.go.id/" target="_blank">
                                    WBS
                                </a>
                                <a class="dropdown-item " href="<?= base_url('home/zona_integritas') ?>">
                                Zona Integritas
                                </a>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a href="<?= base_url('home/gisa_kategori/') ?>" class="nav-link">
                                Lapak #GISA
                            </a>
                        </li>
                        
                        <li class="nav-item ">
                            <a href="<?= base_url('home/hubungi_kami') ?>" class="nav-link">
                                Hubungi Kami
                            </a>
                        </li>
                    </ul>
                   
                </div> <!-- / .navbar-collapse -->
            </div> <!-- / .container -->
        </nav>
    </div>
</header>

<!--  Isi Content Halaman Start -->
<?= $this->renderSection('isi') ?>

<!--  Footer Start -->
<section class="footer pt-120">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 mr-auto col-sm-6 col-md-6">
				<div class="widget footer-widget mb-5 mb-lg-0">
					<h5 class="widget-title">Sosial Media</h5>
					<ul class="list-inline footer-socials">
						<li class="list-inline-item"><a href="<?= $facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"> <a href="<?= $twitter ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="<?= $instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="<?= $youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
					</ul>
				</div>
                <div class="footer-widget footer-contact mb-lg-0">
					<ul class="list-unstyled">
                        <h5 class="widget-title">Whatsapp Pelayanan</h5>
						<li><i class="fab fa-whatsapp"></i>
							<div>
								<strong>Pelayanan KK, Pindah dan Akta</strong>
								<?= $wa_akta ?>
							</div>
							
						</li>
						<li> <i class="fab fa-whatsapp"></i>
							<div>
								<strong>Pelayanan KTP dan KIA </strong>
								<?= $wa_ktp ?>
							</div>
						</li>
						<li> <i class="fab fa-whatsapp"></i>
							<div>
								<strong>Pelayanan Konsolidasi dan Pengaduan</strong>
								<?= $wa_pengaduan ?>
							</div>
						</li>
					</ul>
				</div>
			</div>

            <div class="col-lg-2 mr-auto col-sm-6 col-md-6">
                <div class="footer-widget footer-contact mb-5 mb-lg-0">
                    <h5 class="widget-title">Kontak</h5>
					<ul class="list-unstyled">
						<li><i class="bi bi-phone"></i>
							<div>
								<strong>Nomor Telepon</strong>
								<?= $nomor_telepon ?>
							</div>
							
						</li>
						<li> <i class="bi bi-envelop"></i>
							<div style="word-wrap: break-word;">
								<strong>Email</strong>
								<?= $email ?>
							</div>
						</li>
						<li><i class="bi bi-location-pointer"></i>
							<div>
								<strong>Alamat</strong>
								<?= $alamat ?>
							</div>
						</li>
					</ul>
				</div>
			</div>

            <div class="col-lg-2 mr-auto col-sm-6 col-md-6">
				<div class="footer-widget footer-contact mb-5 mb-lg-0">
					<h5 class="widget-title">Jam Pelayanan </h5>
					
					<ul class="list-unstyled">
						<li>
							<div>
								<strong>Senin - Kamis</strong>
								<?= $jam_senin_kamis ?>
							</div>
							
						</li>
                        <li>
							<div>
								<strong>Jum'at</strong>
								<?= $jam_jumat ?>
							</div>
							
						</li>
                        <li>
							<div>
								<strong>Sabtu - Minggu</strong>
								<?= $jam_sabtu_minggu ?>
							</div>
							
						</li>
					</ul>
				</div>
			</div>

            <div class="col-lg-4 col-sm-6 col-md-6">
				<div class="footer-widget footer-contact mb-5 mb-lg-0">
					<h5 class="widget-title">Peta Lokasi </h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="map-responsive">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.9663247770523!2d112.43690581528583!3d-7.468970675703767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e780d8100000001%3A0xe65cf0fd67fb2a91!2sDinas%20Kependudukan%20dan%20Catatan%20Sipil%20Kota%20Mojokerto!5e0!3m2!1sid!2sid!4v1652837918346!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
				</div>
			</div>

		</div>
	</div>

	<div class="footer-btm">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6">
					<div class="footer-logo">
						<img src="<?= base_url()?>/assets/images/Logo-Dukcapil-Mojokerto-Footer.png" alt="Edutim" class="img-fluid">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="copyright text-lg-center">
						<p>@ 2022 Dinas Kependudukan dan Catatan Sipil Kota Mojokerto.</a> </p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="fixed-btm-top">
	<a href="#top-header" class="js-scroll-trigger scroll-to-top"><i class="fa fa-angle-up"></i></a>
</div>



    <!-- 
    Essential Scripts
    =====================================-->
    
    <!-- Main jQuery -->
    <script src="<?= base_url()?>/assets/vendors/jquery/jquery.js"></script>
    <!-- Bootstrap 4.5 -->
    <script src="<?= base_url()?>/assets/vendors/bootstrap/bootstrap.js"></script>
    <!-- Counterup -->
    <script src="<?= base_url()?>/assets/vendors/counterup/waypoint.js"></script>
    <script src="<?= base_url()?>/assets/vendors/counterup/jquery.counterup.min.js"></script>
    <script src="<?= base_url()?>/assets/vendors/jquery.isotope.js"></script>
    <!-- <script src="assets/vendors/imagesloaded.js"></script> -->
    <!--  Owlk Carousel-->
    <script src="<?= base_url()?>/assets/vendors/owl/owl.carousel.min.js"></script>
    <script src="<?= base_url()?>/assets/js/script.js"></script>

    <script src="<?= base_url() ?>/assets/js/front_logreg.js"></script>

    <script src="<?= base_url() ?>/assets/js/sweetalert2@10.js"></script>



  </body>
  </html>
   
<?= $this->extend('layout/main') ?>
<?= $this->section('nav') ?>
<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">

        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <div id="clock"></div>
        </li>
        
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a href="javascript:void(0);"> Hello, <?= session()->get('nama') ?> </a>
        </li>

        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i style="color:#D49414; font-size: 30px;" class="fa fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a class="dropdown-item text-danger" href="#" id="logout"><i class="mdi mdi-power text-danger"></i> Keluar</a>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>

</nav>
<?= $this->endSection('nav') ?>


<?= $this->section('menu') ?>
<li class="menu-title">Dashboard</li>
<li>
    <a href="<?= base_url('auth/dashboard') ?>" class="waves-effect">
        <i class="icon-accelerator"></i> <span> Dashboard </span>
    </a>
</li>

<li class="menu-title">Postingan</li>
<li>
    <a href="<?= base_url('auth/galeri') ?>" class="waves-effect">
        <i class="mdi mdi-folder-image"></i> <span> Galeri </span>
    </a>
</li>
<li>
    <a href="<?= base_url('auth/berita') ?>" class="waves-effect">
        <i class="mdi mdi-newspaper"></i> <span> Berita </span>
    </a>
</li>
<li>
    <a href="<?= base_url('auth/pengumuman') ?>" class="waves-effect">
        <i class="mdi mdi-bullhorn-outline"></i> <span> Pengumuman </span>
    </a>
</li>

<li class="menu-title">Statis Page</li>
<li>
    <a href="<?= base_url('auth/profil/') ?>" class="waves-effect">
        <i class="mdi mdi-face-profile"></i> <span> Profil </span>
    </a>
</li>
<li>
    <a href="<?= base_url('auth/inovasi/') ?>" class="waves-effect">
        <i class="mdi mdi-all-inclusive"></i> <span> Inovasi Layanan </span>
    </a>
</li>
<li>
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-server"></i> <span> Layanan <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/layanan/kategori') ?>">Kategori</a></li>
        <li><a href="<?= base_url('auth/layanan') ?>">Daftar Layanan</a></li>
    </ul>
</li>
<li>
    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-information-variant"></i> <span> Media & Informasi <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
    <ul class="submenu">
        <li><a href="<?= base_url('auth/medfo/alur_adu') ?>">Alur Pengaduan Masy.</a></li>
        <li><a href="<?= base_url('auth/medfo/penghargaan') ?>">Penghargaan</a></li>
        <li><a href="<?= base_url('auth/medfo/ikm') ?>">Indeks Kepuasan Masy.</a></li>
    </ul>
</li>

<li class="menu-title">Tampilan Depan</li>
<li>
    <a href="<?= base_url('auth/link/') ?>" class="waves-effect">
        <i class="mdi mdi-web"></i> <span> Link Terkait </span>
    </a>
</li>
<li>
    <a href="<?= base_url('auth/informasi/') ?>" class="waves-effect">
        <i class="mdi mdi-card-bulleted"></i> <span> Data Informasi </span>
    </a>
</li>

<?= $this->endSection('menu') ?>
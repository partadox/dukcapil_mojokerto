<?=$this->extend('main')?>

<?=$this->section('isi')?>

<section class="page-wrapper edutim-course-single">
    <div class="container">
        <div class="course-single-header">
            <div class="single-course-details ">

                <!-- <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Kontak Dinas Kependudukan dan Pencatatan Sipil Kota Mojokerto</h4>
                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="bi bi-location-pointer"></i> Alamat Kantor
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($alamat) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="bi bi-phone"></i> No. Telepon
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($nomor_telepon) ?> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fa fa-globe"></i> Website
                        </div>
                        <div class="col col-lg-8">
                            : dispenduk.mojokertokota.go.id
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="bi bi-envelop"></i> Email
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($email) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fab fa-whatsapp"></i> WA Pelayanan KK, Pindah dan Akta
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($wa_akta) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fab fa-whatsapp"></i> WA Pelayanan KTP dan KIA
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($wa_ktp) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fab fa-whatsapp"></i> WA Pelayanan Konsolidasi dan Pengaduan
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($wa_pengaduan) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="bi bi-speaker-on"></i> Pengaduan
                        </div>
                        <div class="col col-lg-8">
                            : https://curhatningita.lapor.go.id/
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="bi bi-phone"></i> Pengaduan Kontak
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($wa_pengaduan) ?>
                        </div>
                    </div>

                </div> -->

                <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Kontak Dinas Kependudukan dan Pencatatan Sipil Kota Mojokerto</h4>
                    <div class="row text-center">
                        <p><i class="bi bi-location-pointer"></i> Alamat Kantor : <?=htmlentities($alamat) ?></p>
                    </div>
                    <div class="row text-center">
                        <p><i class="bi bi-phone"></i> No. Telepon : <?=htmlentities($nomor_telepon) ?> </p>
                    </div>

                    <div class="row text-center">
                        <p><i class="fa fa-globe"></i> Website : dispenduk.mojokertokota.go.id</p>
                    </div>

                    <div class="row text-center">
                        <p><i class="bi bi-envelop"></i> Email : <?=htmlentities($email) ?></p>
                    </div>

                    <div class="row text-center">
                        <p><i class="fab fa-whatsapp"></i> WA Pelayanan KK, Pindah dan Akta : <?=htmlentities($wa_akta) ?></p>
                    </div>

                    <div class="row text-center">
                        <p><i class="fab fa-whatsapp"></i> WA Pelayanan KTP dan KIA : <?=htmlentities($wa_ktp) ?></p>
                    </div>

                    <div class="row text-center">
                        <p><i class="fab fa-whatsapp"></i> WA Pelayanan Konsolidasi dan Pengaduan : <?=htmlentities($wa_pengaduan) ?></p>
                    </div>

                    <div class="row text-center">
                        <p><i class="bi bi-speaker-on"></i> Pengaduan : https://curhatningita.lapor.go.id/</p>
                    </div>

                    <div class="row text-center">
                        <p><i class="bi bi-phone"></i> Pengaduan Kontak : <?=htmlentities($wa_pengaduan) ?></p>
                    </div>

                </div>

                <!-- <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Sosial media</h4>

                    <div class="row">
                        <div class="col col-lg-2">
                            <i class="fab fa-instagram"></i> Instagram
                        </div>
                        <div class="col col-lg-8">
                            : <a href="<?=htmlentities($instagram) ?>" target="_blank">@dispenduk_kotamoker</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-2">
                            <i class="fab fa-facebook"></i> Facebook
                        </div>
                        <div class="col col-lg-8">
                            : <a href="<?=htmlentities($facebook) ?>" target="_blank">Dispenduk Kota Mojokerto</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-2">
                            <i class="fab fa-youtube"></i> Youtube
                        </div>
                        <div class="col col-lg-8">
                            : <a href="<?=htmlentities($youtube) ?>" target="_blank">Dukcapil Kota Mojokerto </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-2">
                            <i class="fab fa-twitter"></i> Twitter
                        </div>
                        <div class="col col-lg-8">
                            : <a href="<?=htmlentities($twitter) ?>" target="_blank">@dukcapil_kotaMR</a>
                        </div>
                    </div>

                </div> -->

                <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Sosial media</h4>

                    <div class="row text-center">
                        <a href="<?=htmlentities($instagram) ?>" target="_blank"><i class="fab fa-instagram"></i> Instagram : @dispenduk_kotamoker</a> 
                    </div>

                    <div class="row text-center">
                        <a href="<?=htmlentities($facebook) ?>" target="_blank"><i class="fab fa-facebook"></i> Facebook : Dispenduk Kota Mojokerto</a>
                    </div>

                    <div class="row">
                        <a href="<?=htmlentities($youtube) ?>" target="_blank"><i class="fab fa-youtube"></i> Youtube : Dukcapil Kota Mojokerto</a>
                    </div>

                    <div class="row">
                        <a href="<?=htmlentities($twitter) ?>" target="_blank"><i class="fab fa-twitter"></i> Twitter : @dukcapil_kotaMR</a>
                    </div>

                </div>

                <!-- <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Jam Pelayanan</h4>
                        <p>Jam Pelayanan Tatap Muka Dinas Kependudukan dan Catatan Sipil Kota Mojokerto</p>
                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fa fa-calendar"></i> Senin - Kamis
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($jam_senin_kamis) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fa fa-calendar"></i> Jum'at
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($jam_jumat) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col col-lg-4">
                            <i class="fa fa-calendar"></i> Sabtu - Minggu
                        </div>
                        <div class="col col-lg-8">
                            : <?=htmlentities($jam_sabtu_minggu) ?>
                        </div>
                    </div>

                </div> -->

                <div style="background-color: #d9d9d9;" class="course-widget course-info">
                    <h4 class="course-title"> Jam Pelayanan</h4>
                        <p>Jam Pelayanan Tatap Muka Dinas Kependudukan dan Catatan Sipil Kota Mojokerto</p>
                    <div class="row text-center">
                        <a><i class="fa fa-calendar"></i> Senin - Kamis : <?=htmlentities($jam_senin_kamis) ?></a>
                    </div>

                    <div class="row">
                        <a><i class="fa fa-calendar"></i> Jum'at : <?=htmlentities($jam_jumat) ?></a>
                    </div>

                    <div class="row">
                        <a><i class="fa fa-calendar"></i> Sabtu - Minggu : <?=htmlentities($jam_sabtu_minggu) ?></a>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

<?=$this->endSection('isi') ?>
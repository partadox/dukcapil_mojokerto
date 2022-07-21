<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Data</a></li>
        <li class="breadcrumb-item active">Informasi</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<!-- <p class="mt-1 mb-2">Catatan :<br>
    <i class="mdi mdi-information"></i> Informasi. <br>
</p> -->

<?= form_open('informasi/update', ['class' => 'formupdate']) ?>
<?= csrf_field() ?>

<input class="btn btn-warning mb-2 mt-2" type="submit" value="Update" ></input>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Data Informasi Jumlah Kependudukan Kota Mojokerto</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Jumlah Penduduk Berdasar Jenis Kelamin <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-users"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jp_jenkel" name="jp_jenkel" value="<?= $jp_jenkel ?>">
                </div>
                <div class="invalid-feedback error_jp_jenkel"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Jumlah Penduduk Wajib KTP berdasarkan Jenis Kelamin <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-users"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jp_wajib_ktp_jenkel" name="jp_wajib_ktp_jenkel" value="<?= $jp_wajib_ktp_jenkel ?>">
                </div>
                <div class="invalid-feedback error_jp_wajib_ktp_jenkel"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Jumlah Kepemilikan Kartu Keluarga (KK) <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-users"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jp_kepemilikan_kk" name="jp_kepemilikan_kk" value="<?= $jp_kepemilikan_kk ?>">
                </div>
                <div class="invalid-feedback error_jp_kepemilikan_kk"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Data Informasi Kontak</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Nomor Telepon <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-phone"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $nomor_telepon ?>">
                </div>
                <div class="invalid-feedback error_nomor_telepon"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Email <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-mail-bulk"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>">
                </div>
                <div class="invalid-feedback error_email"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Alamat <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-address-card"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $alamat ?>">
                </div>
                <div class="invalid-feedback error_alamat"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Data Informasi Jam Pelayanan</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Senin - Kamis <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-clock"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jam_senin_kamis" name="jam_senin_kamis" value="<?= $jam_senin_kamis ?>">
                </div>
                <div class="invalid-feedback error_jam_senin_kamis"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Jumat <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-clock"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jam_jumat" name="jam_jumat" value="<?= $jam_jumat ?>">
                </div>
                <div class="invalid-feedback error_jam_jumat"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Sabtu - Minggu <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-clock"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="jam_sabtu_minggu" name="jam_sabtu_minggu" value="<?= $jam_sabtu_minggu ?>">
                </div>
                <div class="invalid-feedback error_jam_sabtu_minggu"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Data Informasi Kontak Whatsapp (WA) Pelayanan</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Pelayanan KK, Pindah Dan Akta <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-whatsapp"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="wa_akta" name="wa_akta" value="<?= $wa_akta ?>">
                </div>
                <div class="invalid-feedback error_wa_akta"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Pelayanan KTP Dan KIA <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-whatsapp"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="wa_ktp" name="wa_ktp" value="<?= $wa_ktp ?>">
                </div>
                <div class="invalid-feedback error_wa_ktp"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Pelayanan Konsolidasi Dan Pengaduan <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-whatsapp"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="wa_pengaduan" name="wa_pengaduan" value="<?= $wa_pengaduan ?>">
                </div>
                <div class="invalid-feedback error_wa_pengaduan"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Data Informasi Sosial Media</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Facebook <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-facebook"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $facebook ?>">
                </div>
                <div class="invalid-feedback error_facebook"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Twitter <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-twitter"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="twitter" name="twitter" value="<?= $twitter ?>">
                </div>
                <div class="invalid-feedback error_twitter"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Instagram <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-instagram"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $instagram ?>">
                </div>
                <div class="invalid-feedback error_instagram"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Youtube <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fab fa-youtube"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="youtube" name="youtube" value="<?= $youtube ?>">
                </div>
                <div class="invalid-feedback error_youtube"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- <div style="position: absolute; right: 0;" class="row">
    
</div> -->


<?= form_close() ?>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('.formupdate').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    nomor_telepon: $('input#nomor_telepon').val(),
                    email: $('input#email').val(),
                    alamat: $('input#alamat').val(),
                    facebook: $('input#facebook').val(),
                    twitter: $('input#twitter').val(),
                    instagram: $('input#instagram').val(),
                    youtube: $('input#youtube').val(),
                    jam_senin_kamis: $('input#jam_senin_kamis').val(),
                    jam_jumat: $('input#jam_jumat').val(),
                    jam_sabtu_minggu: $('input#jam_sabtu_minggu').val(),
                    wa_akta: $('input#wa_akta').val(),
                    wa_ktp: $('input#wa_ktp').val(),
                    wa_pengaduan: $('input#wa_pengaduan').val(),
                    jp_jenkel: $('input#jp_jenkel').val(),
                    jp_wajib_ktp_jenkel: $('input#jp_wajib_ktp_jenkel').val(),
                    jp_kepemilikan_kk: $('input#jp_kepemilikan_kk').val(),
                },
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disable');
                    $('.btnsimpan').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable', 'disable');
                    $('.btnsimpan').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {

                        if (response.error.nomor_telepon) {
                            $('#nomor_telepon').addClass('is-invalid');
                            $('.error_nomor_telepon').html(response.error.nomor_telepon);
                        } else {
                            $('#nomor_telepon').removeClass('is-invalid');
                            $('.error_nomor_telepon').html('');
                        }

                        if (response.error.email) {
                            $('#email').addClass('is-invalid');
                            $('.error_email').html(response.error.email);
                        } else {
                            $('#email').removeClass('is-invalid');
                            $('.error_email').html('');
                        }

                        if (response.error.alamat) {
                            $('#alamat').addClass('is-invalid');
                            $('.error_alamat').html(response.error.alamat);
                        } else {
                            $('#alamat').removeClass('is-invalid');
                            $('.error_alamat').html('');
                        }

                        if (response.error.facebook) {
                            $('#facebook').addClass('is-invalid');
                            $('.error_facebook').html(response.error.facebook);
                        } else {
                            $('#facebook').removeClass('is-invalid');
                            $('.error_facebook').html('');
                        }
                        
                        if (response.error.twitter) {
                            $('#twitter').addClass('is-invalid');
                            $('.error_twitter').html(response.error.twitter);
                        } else {
                            $('#twitter').removeClass('is-invalid');
                            $('.error_twitter').html('');
                        }

                        if (response.error.instagram) {
                            $('#instagram').addClass('is-invalid');
                            $('.error_instagram').html(response.error.instagram);
                        } else {
                            $('#instagram').removeClass('is-invalid');
                            $('.error_instagram').html('');
                        }

                        if (response.error.youtube) {
                            $('#youtube').addClass('is-invalid');
                            $('.error_youtube').html(response.error.youtube);
                        } else {
                            $('#youtube').removeClass('is-invalid');
                            $('.error_youtube').html('');
                        }

                        if (response.error.jam_senin_kamis) {
                            $('#jam_senin_kamis').addClass('is-invalid');
                            $('.error_jam_senin_kamis').html(response.error.jam_senin_kamis);
                        } else {
                            $('#jam_senin_kamis').removeClass('is-invalid');
                            $('.error_jam_senin_kamis').html('');
                        }

                        if (response.error.jam_jumat) {
                            $('#jam_jumat').addClass('is-invalid');
                            $('.error_jam_jumat').html(response.error.jam_jumat);
                        } else {
                            $('#jam_jumat').removeClass('is-invalid');
                            $('.error_jam_jumat').html('');
                        }

                        if (response.error.jam_sabtu_minggu) {
                            $('#jam_sabtu_minggu').addClass('is-invalid');
                            $('.error_jam_sabtu_minggu').html(response.error.jam_sabtu_minggu);
                        } else {
                            $('#jam_sabtu_minggu').removeClass('is-invalid');
                            $('.error_jam_sabtu_minggu').html('');
                        }

                        if (response.error.wa_akta) {
                            $('#wa_akta').addClass('is-invalid');
                            $('.error_wa_akta').html(response.error.wa_akta);
                        } else {
                            $('#wa_akta').removeClass('is-invalid');
                            $('.error_wa_akta').html('');
                        }

                        if (response.error.wa_ktp) {
                            $('#wa_ktp').addClass('is-invalid');
                            $('.error_wa_ktp').html(response.error.wa_ktp);
                        } else {
                            $('#wa_ktp').removeClass('is-invalid');
                            $('.error_wa_ktp').html('');
                        }

                        if (response.error.wa_pengaduan) {
                            $('#wa_pengaduan').addClass('is-invalid');
                            $('.error_wa_pengaduan').html(response.error.wa_pengaduan);
                        } else {
                            $('#wa_pengaduan').removeClass('is-invalid');
                            $('.error_wa_pengaduan').html('');
                        }

                        if (response.error.jp_jenkel) {
                            $('#jp_jenkel').addClass('is-invalid');
                            $('.error_jp_jenkel').html(response.error.jp_jenkel);
                        } else {
                            $('#jp_jenkel').removeClass('is-invalid');
                            $('.error_jp_jenkel').html('');
                        }

                        if (response.error.jp_wajib_ktp_jenkel) {
                            $('#jp_wajib_ktp_jenkel').addClass('is-invalid');
                            $('.error_jp_wajib_ktp_jenkel').html(response.error.jp_wajib_ktp_jenkel);
                        } else {
                            $('#jp_wajib_ktp_jenkel').removeClass('is-invalid');
                            $('.error_jp_wajib_ktp_jenkel').html('');
                        }

                        if (response.error.jp_kepemilikan_kk) {
                            $('#jp_kepemilikan_kk').addClass('is-invalid');
                            $('.error_jp_kepemilikan_kk').html(response.error.jp_kepemilikan_kk);
                        } else {
                            $('#jp_kepemilikan_kk').removeClass('is-invalid');
                            $('.error_jp_kepemilikan_kk').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Data Informasi Berhasil Diupdate!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                                window.location = response.sukses.link;
                        });
                    }
                }
            });
        })
    });
</script>

<?= $this->endSection('isi') ?>
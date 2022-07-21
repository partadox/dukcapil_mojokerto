<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Statis Page</a></li>
        <li class="breadcrumb-item active">Profil</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<!-- <p class="mt-1 mb-2">Catatan :<br>
    <i class="mdi mdi-information"></i> Informasi. <br>
</p> -->

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Sambutan Kepala Dinas</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('profil/update_sambutan', ['class' => 'updateprofil']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Nama Pemberi Sambutan <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-users"></i> </div>
                    </div>
                    <input type="inputan" class="form-control" id="sambutan_nama" name="sambutan_nama" value="<?= $sambutan_nama ?>">
                </div>
                <div class="invalid-feedback error_sambutan_nama"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Jabatan Pemberi Sambutan <code>*</code> </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <div class="input-group-text"> <i class="fa fa-hashtag"></i> </div>
                    </div>
                    <input type="text" class="form-control" id="sambutan_jabatan" name="sambutan_jabatan" value="<?= $sambutan_jabatan ?>">
                </div>
                <div class="invalid-feedback error_sambutan_jabatan"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Foto Pemberi Sambutan <code>*</code> </label>
                <h6>
                    <button type="button" onclick="foto()" class="btn btn-primary btn-sm"><i class="fa fa-images"></i> FOTO</button>
                </h6>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Isi Sambutan <code>*</code> </label>
                <textarea style="height: 150px;" type="text" class="form-control" id="sambutan_isi" name="sambutan_isi"><?= $sambutan_isi ?></textarea>
                <div class="invalid-feedback error_sambutan_isi"></div>
                </div>
            </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <input class="btn btn-warning mr-4" type="submit" value="Update Sambutan" ></input>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Visi dan Misi</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('profil/update_visi_misi', ['class' => 'updatevisimisi']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Visi <code>*</code> </label>
                <textarea style="height: 150px;" type="text" class="form-control" id="visi" name="visi"><?= $visi ?></textarea>
                <div class="invalid-feedback error_visi"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Misi <code>*</code> </label>
                <textarea style="height: 150px;" type="text" class="form-control" id="misi" name="misi"><?= $misi ?></textarea>
                <div class="invalid-feedback error_misi"></div>
                </div>
            </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <input class="btn btn-warning mr-4" type="submit" value="Update Visi & Misi" ></input>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Struktur Organisasi</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('profil/update_struktur_organisasi', ['class' => 'formupload_struktur_organisasi']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <center>
                <img class="img-thumbnail" width="70%" src="<?= site_url('/img/profil/' . $struktur_organisasi) ?>" alt="Sampul Berita">
            </center>

            <div class="form-group">
                    <input type="hidden" value="<?= $struktur_organisasi ?>" name="struktur_organisasi_lama">
                    <label for="" class="form-label">Upload</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="struktur_organisasi" name="struktur_organisasi" accept=".jpg,.jpeg,.png">
                        <div class="invalid-feedback error_struktur_organisasi">

                        </div>
                    </div>
                </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <button type="submit" class="btn btn-warning mr-4 btnupload_struktur"> Update Struktur Organisasi</button>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Tugas Pokok Dan Fungsi
 </h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('profil/update_tupoksi_deskripsi', ['class' => 'updatetupoksi']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Deskripsi Tupoksi<code>*</code> </label>
                <textarea type="text" class="form-control" id="tupoksi_deskripsi" name="tupoksi_deskripsi"> <?= $tupoksi_deskripsi ?></textarea>
                <div class="invalid-feedback error_tupoksi_deskripsi"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">PDF Peraturan :  <?= $tupoksi_pdf ?><code>*</code> </label>
                <h6>
                    <button type="button" onclick="pdf()" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf"></i> Upload PDF</button>
                </h6>
                </div>
            </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <input class="btn btn-warning mr-4" type="submit" value="Update Tupoksi" ></input>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Kualitas Mutu
 </h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('profil/update_kualitas_deskripsi', ['class' => 'updatekualitas']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Deskripsi Kualitas Mutu<code>*</code> </label>
                <textarea type="text" class="form-control" id="kualitas_deskripsi" name="kualitas_deskripsi"> <?= $kualitas_deskripsi ?></textarea>
                <div class="invalid-feedback error_kualitas_deskripsi"></div>
                </div>
            </div>

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">PDF :  <?= $kualitas_pdf ?><code>*</code> </label>
                <h6>
                    <button type="button" onclick="pdf2()" class="btn btn-primary btn-sm"><i class="fa fa-file-pdf"></i> Upload PDF</button>
                </h6>
                </div>
            </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <input class="btn btn-warning mr-4" type="submit" value="Update Kualitas Mutu" ></input>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>


<div class="viewmodal">
</div>

<div class="viewmodalpdf">
</div>

<div class="viewmodalpdf2">
</div>



<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });

        $('textarea#sambutan_isi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        $('textarea#visi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        $('textarea#misi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        $('textarea#tupoksi_deskripsi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        $('textarea#kualitas_deskripsi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        
        $('.updateprofil').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    sambutan_nama: $('input#sambutan_nama').val(),
                    sambutan_jabatan: $('input#sambutan_jabatan').val(),
                    sambutan_isi: $('textarea#sambutan_isi').val(),
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

                        if (response.error.sambutan_nama) {
                            $('#sambutan_nama').addClass('is-invalid');
                            $('.error_sambutan_nama').html(response.error.sambutan_nama);
                        } else {
                            $('#sambutan_nama').removeClass('is-invalid');
                            $('.error_sambutan_nama').html('');
                        }

                        if (response.error.sambutan_jabatan) {
                            $('#sambutan_jabatan').addClass('is-invalid');
                            $('.error_sambutan_jabatan').html(response.error.sambutan_jabatan);
                        } else {
                            $('#sambutan_jabatan').removeClass('is-invalid');
                            $('.error_sambutan_jabatan').html('');
                        }

                        if (response.error.sambutan_isi) {
                            $('#sambutan_isi').addClass('is-invalid');
                            $('.error_sambutan_isi').html(response.error.sambutan_isi);
                        } else {
                            $('#sambutan_isi').removeClass('is-invalid');
                            $('.error_sambutan_isi').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Sambutan Berhasil Diupdate!",
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

        $('.updatevisimisi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    visi: $('textarea#visi').val(),
                    misi: $('textarea#misi').val(),
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

                        if (response.error.visi) {
                            $('#visi').addClass('is-invalid');
                            $('.error_visi').html(response.error.visi);
                        } else {
                            $('#visi').removeClass('is-invalid');
                            $('.error_visi').html('');
                        }

                        if (response.error.misi) {
                            $('#misi').addClass('is-invalid');
                            $('.error_misi').html(response.error.misi);
                        } else {
                            $('#misi').removeClass('is-invalid');
                            $('.error_misi').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Visi / Misi Berhasil Diupdate!",
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

        $('.btnupload_struktur').click(function(e) {
            e.preventDefault();
            let form = $('.formupload_struktur_organisasi')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: '<?= site_url('profil/struktur_organisasi_upload') ?>',
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnupload').attr('disable', 'disable');
                    $('.btnupload').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <i>Loading...</i>');
                },
                complete: function() {
                    $('.btnupload').removeAttr('disable', 'disable');
                    $('.btnupload').html('<i class="fa fa-share-square"></i>  Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.struktur_organisasi) {
                            $('#struktur_organisasi').addClass('is-invalid');
                            $('.error_struktur_organisasi').html(response.error.struktur_organisasi);
                        }
                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                                window.location = response.sukses.link;
                        });
                    }

                }
            });

        });

        $('.updatetupoksi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    tupoksi_deskripsi: $('textarea#tupoksi_deskripsi').val(),
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

                        if (response.error.tupoksi_deskripsi) {
                            $('#tupoksi_deskripsi').addClass('is-invalid');
                            $('.error_tupoksi_deskripsi').html(response.error.tupoksi_deskripsi);
                        } else {
                            $('#tupoksi_deskripsi').removeClass('is-invalid');
                            $('.error_tupoksi_deskripsi').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Tupoksi Berhasil Diupdate!",
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

        $('.updatekualitas').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    kualitas_deskripsi: $('textarea#kualitas_deskripsi').val(),
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

                        if (response.error.kualitas_deskripsi) {
                            $('#kualitas_deskripsi').addClass('is-invalid');
                            $('.error_kualitas_deskripsi').html(response.error.kualitas_deskripsi);
                        } else {
                            $('#kualitas_deskripsi').removeClass('is-invalid');
                            $('.error_kualitas_deskripsi').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Kualitas Mutu Berhasil Diupdate!",
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

    function foto() {
            $.ajax({
                type: "post",
                url: "<?= site_url('Profil/sambutan_formfoto') ?>",
                data: {
                    
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#modalupload').modal('show');
                    }
                }
            });
    }

    function pdf() {
            $.ajax({
                type: "post",
                url: "<?= site_url('Profil/tupoksi_formpdf') ?>",
                data: {
                    
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodalpdf').html(response.sukses).show();
                        $('#modaluploadpdf').modal('show');
                    }
                }
            });
        }
    
    function pdf2() {
        $.ajax({
            type: "post",
            url: "<?= site_url('Profil/kualitas_formpdf') ?>",
            data: {
                
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalpdf2').html(response.sukses).show();
                    $('#modaluploadpdf2').modal('show');
                }
            }
        });
    }
</script>

<?= $this->endSection('isi') ?>
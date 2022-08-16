<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Statis Page</a></li>
        <li class="breadcrumb-item active">Zona Integritas</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<!-- <p class="mt-1 mb-2">Catatan :<br>
    <i class="mdi mdi-information"></i> Informasi. <br>
</p> -->

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Deskripsi Zona Integritas</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('zi/update_deskripsi', ['class' => 'update']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <label class="form-label">Deskripsi <code>*</code> </label>
                <textarea style="height: 150px;" type="text" class="form-control" id="zona_integritas" name="zona_integritas"><?= $zona_integritas ?></textarea>
                <div class="invalid-feedback error_zona_integritas"></div>
                </div>
            </div>
             
            <div style="position: absolute; right: 0;" class="row">
                <input class="btn btn-warning mr-4" type="submit" value="Update Deskripsi" ></input>
            </div>

            <br>
            
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">File</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <a>
                <button type="button" class="btn btn-primary tambahfile mb-2"><i class=" fa fa-plus-circle"></i> Tambah File</button>
            </a>

            <div class="viewdata">
            </div>

            <div class="viewmodal"></div>
            
        </div>
    </div>
</div>

<script>
    function listfile() {
        $.ajax({
            url: "<?= site_url('zi/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listfile();

        $('.tambahfile').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('zi/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaluploadpdf').modal('show');
                }
            });
        });

        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });

        $('textarea#zona_integritas').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });

        
        $('.update').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    zona_integritas: $('textarea#zona_integritas').val(),
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

                        if (response.error.zona_integritas) {
                            $('#zona_integritas').addClass('is-invalid');
                            $('.error_zona_integritas').html(response.error.zona_integritas);
                        } else {
                            $('#zona_integritas').removeClass('is-invalid');
                            $('.error_zona_integritas').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Deskripsi Zona Integritas Diupdate!",
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
<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Statis Page</a></li>
        <li class="breadcrumb-item active">Indeks Kepuasan Masyarakat</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<!-- <p class="mt-1 mb-2">Catatan :<br>
    <i class="mdi mdi-information"></i> Informasi. <br>
</p> -->

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Indeks Kepuasan Masyarakat</h6>
        <div class="card-options">
            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
        </div>
    </div>
    <div class="card-body">
        <?= form_open('medfo/update_ikm', ['class' => 'updateikm']) ?>
        <?= csrf_field() ?>
        <div class="container-fluid">

            <div class="form-group">
                <div class="mb-3">
                <textarea style="height: 150px;" type="text" class="form-control" id="ikm" name="ikm"><?= $ikm ?></textarea>
                <div class="invalid-feedback error_ikm"></div>
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





<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });

        $('textarea#ikm').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        
        $('.updateikm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    ikm: $('textarea#ikm').val(),
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

                    } else {
                        Swal.fire({
                            title: "Alur Pengaduan Masyarakat Berhasil Diupdate!",
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
<!-- Modal -->
<div class="modal fade" id="modaluploadpdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formupload']) ?>
            <?= csrf_field(); ?>
            <br>
            <div class="modal-body">
                <!-- <p class="mt-1 mb-2">Catatan :<br>
                    <i class="mdi mdi-information"></i> Disarankan foto memiliki ukuran persegi (ukuran panjang = ukuran lebar). <br>
                </p> -->
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Nama Data Paparan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="zi_nama" name="zi_nama">
                        <div class="invalid-feedback error_zi_nama">

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Upload</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="zi_file" name="zi_file" accept=".pdf">
                        <div class="invalid-feedback error_zi_file">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btnupload').click(function(e) {
            e.preventDefault();
            let form = $('.formupload')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: '<?= site_url('zi/zi_upload') ?>',
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

                        if (response.error.zi_file) {
                            $('#zi_file').addClass('is-invalid');
                            $('.error_zi_file').html(response.error.zi_file);
                        } else {
                            $('#zi_file').removeClass('is-invalid');
                            $('.error_zi_file').html('');
                        }

                        if (response.error.zi_nama) {
                            $('#zi_nama').addClass('is-invalid');
                            $('.error_zi_nama').html(response.error.zi_nama);
                        } else {
                            $('#zi_nama').removeClass('is-invalid');
                            $('.error_zi_nama').html('');
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
                        $('#modaluploadpdf').modal('hide');
                    }

                }
            });

        });
    });
</script>
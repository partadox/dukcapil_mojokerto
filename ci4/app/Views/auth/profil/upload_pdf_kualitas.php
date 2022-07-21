<!-- Modal -->
<div class="modal fade" id="modaluploadpdf2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('', ['class' => 'formupload2']) ?>
            <?= csrf_field(); ?>
            <br>
            <div class="modal-body">
                <!-- <p class="mt-1 mb-2">Catatan :<br>
                    <i class="mdi mdi-information"></i> Disarankan foto memiliki ukuran persegi (ukuran panjang = ukuran lebar). <br>
                </p> -->
                <div class="form-group row">
                    <input type="hidden" value="<?= $kualitas_pdf ?>" name="kualitas_pdf_lama">
                    <label for="" class="col-sm-2 col-form-label">Upload</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="kualitas_pdf" name="kualitas_pdf" accept=".pdf">
                        <div class="invalid-feedback error_kualitas_pdf">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnupload2"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.btnupload2').click(function(e) {
            e.preventDefault();
            let form = $('.formupload2')[0];
            let data = new FormData(form);

            $.ajax({
                type: "post",
                url: '<?= site_url('profil/kualitas_upload') ?>',
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
                        if (response.error.kualitas_pdf) {
                            $('#kualitas_pdf').addClass('is-invalid');
                            $('.error_kualitas_pdf').html(response.error.kualitas_pdf);
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
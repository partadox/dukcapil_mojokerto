<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('inovasi/update', ['class' => 'forminovasi']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="inovasi_id" value="<?= $inovasi_id ?>" name="inovasi_id" readonly>
                    <label>Judul inovasi</label>
                    <input type="text" class="form-control" id="inovasi_judul" value="<?= $inovasi_judul ?>" name="inovasi_judul">
                    <div class="invalid-feedback error_inovasi_judul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <textarea type="text" class="form-control" id="inovasi_isi" name="inovasi_isi"> <?= $inovasi_isi ?></textarea>
                    <div class="invalid-feedback error_inovasi_isi">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan"><i class="fa fa-share-square"></i> Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            theme: "bootstrap4"
        });
        $('textarea#inovasi_isi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.forminovasi').submit(function(e) {
            let title = $('input#inovasi_judul').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    inovasi_id: $('input#inovasi_id').val(),
                    inovasi_judul: $('input#inovasi_judul').val(),
                    inovasi_isi: $('textarea#inovasi_isi').val(),
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
                        if (response.error.inovasi_judul) {
                            $('#inovasi_judul').addClass('is-invalid');
                            $('.error_inovasi_judul').html(response.error.inovasi_judul);
                        } else {
                            $('#inovasi_judul').removeClass('is-invalid');
                            $('.error_inovasi_judul').html('');
                        }

                        if (response.error.inovasi_isi) {
                            $('#inovasi_isi').addClass('is-invalid');
                            $('.error_inovasi_isi').html(response.error.inovasi_isi);
                        } else {
                            $('#inovasi_isi').removeClass('is-invalid');
                            $('.error_inovasi_isi').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaledit').modal('hide');
                        listinovasi();
                    }
                }
            });
        })
    });
</script>
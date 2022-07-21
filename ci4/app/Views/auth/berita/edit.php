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
            <?= form_open('berita/update', ['class' => 'formberita']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="berita_id" value="<?= $berita_id ?>" name="berita_id" readonly>
                    <label>Judul Berita</label>
                    <input type="text" class="form-control" id="berita_judul" value="<?= $berita_judul ?>" name="berita_judul">
                    <div class="invalid-feedback error_berita_judul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <textarea type="text" class="form-control" id="berita_isi" name="berita_isi"> <?= $berita_isi ?></textarea>
                    <div class="invalid-feedback error_berita_isi">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sematkan Pada Highlight</label>
                    <select name="berita_pin" id="berita_pin" class="form-control">
                        <option value=0 <?php if ($berita_pin == 0) echo "selected"; ?>>NONAKTIF</option>
                        <option value=1 <?php if ($berita_pin == 1) echo "selected"; ?>>AKTIF</option>
                    </select>
                    <div class="invalid-feedback error_berita_pin">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="berita_status" id="berita_status" class="form-control">
                        <option value="PUBLISH" <?php if ($berita_status == 'PUBLISH') echo "selected"; ?>>PUBLISH</option>
                        <option value="PRIVATE" <?php if ($berita_status == 'PRIVATE') echo "selected"; ?>>PRIVATE</option>
                    </select>
                    <div class="invalid-feedback error_berita_status">
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
        $('textarea#berita_isi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formberita').submit(function(e) {
            let title = $('input#berita_judul').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    berita_id: $('input#berita_id').val(),
                    berita_judul: $('input#berita_judul').val(),
                    berita_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                    berita_isi: $('textarea#berita_isi').val(),
                    berita_pin: $('select#berita_pin').val(),
                    berita_status: $('select#berita_status').val(),
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
                        if (response.error.berita_judul) {
                            $('#berita_judul').addClass('is-invalid');
                            $('.error_berita_judul').html(response.error.berita_judul);
                        } else {
                            $('#berita_judul').removeClass('is-invalid');
                            $('.error_berita_judul').html('');
                        }

                        if (response.error.berita_isi) {
                            $('#berita_isi').addClass('is-invalid');
                            $('.error_berita_isi').html(response.error.berita_isi);
                        } else {
                            $('#berita_isi').removeClass('is-invalid');
                            $('.error_berita_isi').html('');
                        }

                        if (response.error.berita_pin) {
                            $('#berita_pin').addClass('is-invalid');
                            $('.error_berita_pin').html(response.error.berita_pin);
                        } else {
                            $('#berita_pin').removeClass('is-invalid');
                            $('.error_berita_pin').html('');
                        }

                        if (response.error.berita_status) {
                            $('#berita_status').addClass('is-invalid');
                            $('.error_berita_status').html(response.error.berita_status);
                        } else {
                            $('#berita_status').removeClass('is-invalid');
                            $('.error_berita_status').html('');
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
                        listberita();
                    }
                }
            });
        })
    });
</script>
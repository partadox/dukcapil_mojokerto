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
            <?= form_open('medfo/update_penghargaan', ['class' => 'formpenghargaan']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="penghargaan_id" value="<?= $penghargaan_id ?>" name="penghargaan_id" readonly>
                    <label>Nama penghargaan</label>
                    <input type="text" class="form-control" id="penghargaan_nama" value="<?= $penghargaan_nama ?>" name="penghargaan_nama">
                    <div class="invalid-feedback error_penghargaan_nama">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea type="text" class="form-control" id="penghargaan_deskripsi" name="penghargaan_deskripsi"> <?= $penghargaan_deskripsi ?></textarea>
                    <div class="invalid-feedback error_penghargaan_deskripsi">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sematkan Pada Highlight</label>
                    <select name="penghargaan_pin" id="penghargaan_pin" class="form-control">
                        <option value=0 <?php if ($penghargaan_pin == 0) echo "selected"; ?>>NONAKTIF</option>
                        <option value=1 <?php if ($penghargaan_pin == 1) echo "selected"; ?>>AKTIF</option>
                    </select>
                    <div class="invalid-feedback error_penghargaan_pin">
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
        $('textarea#penghargaan_deskripsi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formpenghargaan').submit(function(e) {
            let title = $('input#penghargaan_nama').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    penghargaan_id: $('input#penghargaan_id').val(),
                    penghargaan_nama: $('input#penghargaan_nama').val(),
                    penghargaan_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                    penghargaan_deskripsi: $('textarea#penghargaan_deskripsi').val(),
                    penghargaan_pin: $('select#penghargaan_pin').val(),
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
                        if (response.error.penghargaan_nama) {
                            $('#penghargaan_nama').addClass('is-invalid');
                            $('.error_penghargaan_nama').html(response.error.penghargaan_nama);
                        } else {
                            $('#penghargaan_nama').removeClass('is-invalid');
                            $('.error_penghargaan_nama').html('');
                        }

                        if (response.error.penghargaan_deskripsi) {
                            $('#penghargaan_deskripsi').addClass('is-invalid');
                            $('.error_penghargaan_deskripsi').html(response.error.penghargaan_deskripsi);
                        } else {
                            $('#penghargaan_deskripsi').removeClass('is-invalid');
                            $('.error_penghargaan_deskripsi').html('');
                        }

                        if (response.error.penghargaan_pin) {
                            $('#penghargaan_pin').addClass('is-invalid');
                            $('.error_penghargaan_pin').html(response.error.penghargaan_pin);
                        } else {
                            $('#penghargaan_pin').removeClass('is-invalid');
                            $('.error_penghargaan_pin').html('');
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
                        listpenghargaan();
                    }
                }
            });
        })
    });
</script>
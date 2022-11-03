<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('pengumuman/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Judul Pengumuman</label>
                    <input type="text" class="form-control" id="pengumuman_judul" name="pengumuman_judul">
                    <div class="invalid-feedback error_pengumuman_judul">
                    </div>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <p>Ketika upload gambar harap definisikan sizenya dengan cara klik gambar yang diupload kemudian pilih ukuruan 100%</p>
                    <textarea type="text" class="form-control" id="pengumuman_isi" name="pengumuman_isi"></textarea>
                    <div class="invalid-feedback error_pengumuman_isi">
                    </div>
                </div>

                <div class="form-group">
                    <label>Sematkan Pada Highlight</label>
                    <select name="pengumuman_pin" id="pengumuman_pin" class="form-control">
                        <option Disabled=true Selected=true>PILIH...</option>
                        <option value="0">NONAKTIF</option>
                        <option value="1">AKTIF</option>
                    </select>
                    <div class="invalid-feedback error_pengumuman_pin">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="pengumuman_status" id="pengumuman_status" class="form-control">
                        <option Disabled=true Selected=true>PILIH...</option>
                        <option value="PUBLISH">PUBLISH</option>
                        <option value="PRIVATE">PRIVATE</option>
                    </select>
                    <div class="invalid-feedback error_pengumuman_status">
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
        $('textarea#pengumuman_isi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formtambah').submit(function(e) {
            let title = $('input#pengumuman_judul').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    pengumuman_judul: $('input#pengumuman_judul').val(),
                    pengumuman_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                    pengumuman_isi: $('textarea#pengumuman_isi').val(),
                    pengumuman_pin: $('select#pengumuman_pin').val(),
                    pengumuman_status: $('select#pengumuman_status').val(),
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
                        if (response.error.pengumuman_judul) {
                            $('#pengumuman_judul').addClass('is-invalid');
                            $('.error_pengumuman_judul').html(response.error.pengumuman_judul);
                        } else {
                            $('#pengumuman_judul').removeClass('is-invalid');
                            $('.error_pengumuman_judul').html('');
                        }

                        if (response.error.pengumuman_isi) {
                            $('#pengumuman_isi').addClass('is-invalid');
                            $('.error_pengumuman_isi').html(response.error.pengumuman_isi);
                        } else {
                            $('#pengumuman_isi').removeClass('is-invalid');
                            $('.error_pengumuman_isi').html('');
                        }

                        if (response.error.pengumuman_pin) {
                            $('#pengumuman_pin').addClass('is-invalid');
                            $('.error_pengumuman_pin').html(response.error.pengumuman_pin);
                        } else {
                            $('#pengumuman_pin').removeClass('is-invalid');
                            $('.error_pengumuman_pin').html('');
                        }

                        if (response.error.pengumuman_status) {
                            $('#pengumuman_status').addClass('is-invalid');
                            $('.error_pengumuman_status').html(response.error.pengumuman_status);
                        } else {
                            $('#pengumuman_status').removeClass('is-invalid');
                            $('.error_pengumuman_status').html('');
                        }

                    } else {
                        Swal.fire({
                            title: "Berhasil!",
                            text: response.sukses,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('#modaltambah').modal('hide');
                        listpengumuman();
                    }
                }
            });
        })
    });
</script>
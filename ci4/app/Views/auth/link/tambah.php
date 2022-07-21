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
            <?= form_open('link/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Link Terkait</label>
                    <input type="text" class="form-control" id="link_nama" name="link_nama">
                    <div class="invalid-feedback error_link_nama">
                    </div>
                </div>

                <div class="form-group">
                    <label>URL Link Terkait (Contoh: https://namadomain.com)</label>
                    <input type="text" class="form-control" id="link_url" name="link_url">
                    <div class="invalid-feedback error_link_url">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="link_status" id="link_status" class="form-control">
                        <option Disabled=true Selected=true>PILIH...</option>
                        <option value="PUBLISH">PUBLISH</option>
                        <option value="PRIVATE">PRIVATE</option>
                    </select>
                    <div class="invalid-feedback error_link_status">
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
        $('.formtambah').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    link_nama: $('input#link_nama').val(),
                    link_url: $('input#link_url').val(),
                    link_pin: $('select#link_pin').val(),
                    link_status: $('select#link_status').val(),
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
                        if (response.error.link_nama) {
                            $('#link_nama').addClass('is-invalid');
                            $('.error_link_nama').html(response.error.link_nama);
                        } else {
                            $('#link_nama').removeClass('is-invalid');
                            $('.error_link_nama').html('');
                        }

                        if (response.error.link_url) {
                            $('#link_url').addClass('is-invalid');
                            $('.error_link_url').html(response.error.link_url);
                        } else {
                            $('#link_url').removeClass('is-invalid');
                            $('.error_link_url').html('');
                        }

                        if (response.error.link_status) {
                            $('#link_status').addClass('is-invalid');
                            $('.error_link_status').html(response.error.link_status);
                        } else {
                            $('#link_status').removeClass('is-invalid');
                            $('.error_link_status').html('');
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
                        listlink();
                    }
                }
            });
        })
    });
</script>
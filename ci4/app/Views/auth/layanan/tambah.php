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
            <?= form_open('layanan/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Kategori Layanan </label>
                    <select name="layanan_kategori" id="layanan_kategori" class="form-control">
                        <option value="" disabled selected>--PILIH--</option>
                        <?php foreach ($list_kategori as $key => $data) { ?>
                            <option value="<?= $data['LK_id'] ?>"><?= $data['LK_nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback error_layanan_kategori">
                    </div>
                </div>

                <div class="form-group">
                    <label>Subkategori Layanan </label>
                    <input type="text" class="form-control" id="layanan_subkategori" name="layanan_subkategori">
                    <div class="invalid-feedback error_layanan_subkategori">
                    </div>
                </div>

                <div class="form-group">
                    <label>Deskripsi Terkait Layanan</label>
                    <textarea type="text" class="form-control" id="layanan_deskripsi" name="layanan_deskripsi"></textarea>
                    <div class="invalid-feedback error_layanan_deskripsi">
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
        $('textarea#layanan_deskripsi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formtambah').submit(function(e) {
            let title = $('input#layanan_subkategori').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    layanan_subkategori: $('input#layanan_subkategori').val(),
                    layanan_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                    layanan_deskripsi: $('textarea#layanan_deskripsi').val(),
                    layanan_kategori: $('select#layanan_kategori').val(),
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
                        if (response.error.layanan_kategori) {
                            $('#layanan_kategori').addClass('is-invalid');
                            $('.error_layanan_kategori').html(response.error.layanan_kategori);
                        } else {
                            $('#layanan_kategori').removeClass('is-invalid');
                            $('.error_layanan_kategori').html('');
                        }

                        if (response.error.layanan_subkategori) {
                            $('#layanan_subkategori').addClass('is-invalid');
                            $('.error_layanan_subkategori').html(response.error.layanan_subkategori);
                        } else {
                            $('#layanan_subkategori').removeClass('is-invalid');
                            $('.error_layanan_subkategori').html('');
                        }

                        if (response.error.layanan_deskripsi) {
                            $('#layanan_deskripsi').addClass('is-invalid');
                            $('.error_layanan_deskripsi').html(response.error.layanan_deskripsi);
                        } else {
                            $('#layanan_deskripsi').removeClass('is-invalid');
                            $('.error_layanan_deskripsi').html('');
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
                        listlayanan();
                    }
                }
            });
        })
    });
</script>
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
            <?= form_open('gisa/simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Kategori & Sub-Kategori </label>
                    <select name="gisa_kategori" id="gisa_kategori" class="form-control">
                        <option value="" disabled selected>--PILIH--</option>
                        <?php foreach ($list_kategori as $key => $data) { ?>
                            <option value="<?= $data['GKS_id'] ?>"><?= $data['GK_nama'] ?> - <?= $data['GKS_nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback error_gisa_kategori">
                    </div>
                </div>

                <div class="form-group">
                    <label>Su-sub-kategori Gisa </label>
                    <input type="text" class="form-control" id="gisa_subkategori" name="gisa_subkategori">
                    <div class="invalid-feedback error_gisa_subkategori">
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
        $('textarea#gisa_deskripsi').summernote({
            height: 250,
            minHeight: null,
            maxHeight: null,
            focus: true
        });
        $('.formtambah').submit(function(e) {
            let title = $('input#gisa_subkategori').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    gisa_subkategori: $('input#gisa_subkategori').val(),
                    gisa_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
                    gisa_kategori: $('select#gisa_kategori').val(),
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
                        if (response.error.gisa_kategori) {
                            $('#gisa_kategori').addClass('is-invalid');
                            $('.error_gisa_kategori').html(response.error.gisa_kategori);
                        } else {
                            $('#gisa_kategori').removeClass('is-invalid');
                            $('.error_gisa_kategori').html('');
                        }

                        if (response.error.gisa_subkategori) {
                            $('#gisa_subkategori').addClass('is-invalid');
                            $('.error_gisa_subkategori').html(response.error.gisa_subkategori);
                        } else {
                            $('#gisa_subkategori').removeClass('is-invalid');
                            $('.error_gisa_subkategori').html('');
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
                        listgisa();
                    }
                }
            });
        })
    });
</script>
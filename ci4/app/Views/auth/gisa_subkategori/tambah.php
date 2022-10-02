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
            <?= form_open('gisa/subkategori_simpan', ['class' => 'formtambah']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">

                <div class="form-group">
                    <label>Kategori Gisa </label>
                    <select name="GKS_kategori_id" id="GKS_kategori_id" class="form-control">
                        <option value="" disabled selected>--PILIH--</option>
                        <?php foreach ($list_kategori as $key => $data) { ?>
                            <option value="<?= $data['GK_id'] ?>"><?= $data['GK_nama'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback error_GKS_kategori_id">
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Sub-Kategori Gisa</label>
                    <input type="text" class="form-control" id="GKS_nama" name="GKS_nama">
                    <div class="invalid-feedback error_GKS_nama">
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
            let title = $('input#GKS_nama').val()
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: {
                    GKS_kategori_id: $('select#GKS_kategori_id').val(),
                    GKS_nama: $('input#GKS_nama').val(),
                    GKS_slug: title.replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, ''),
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
                        if (response.error.GKS_kategori_id) {
                            $('#GKS_kategori_id').addClass('is-invalid');
                            $('.error_GKS_kategori_id').html(response.error.GKS_kategori_id);
                        } else {
                            $('#GKS_kategori_id').removeClass('is-invalid');
                            $('.error_GKS_kategori_id').html('');
                        }

                        if (response.error.GKS_nama) {
                            $('#GKS_nama').addClass('is-invalid');
                            $('.error_GKS_nama').html(response.error.GKS_nama);
                        } else {
                            $('#GKS_nama').removeClass('is-invalid');
                            $('.error_GKS_nama').html('');
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
                        listGK();
                    }
                }
            });
        })
    });
</script>
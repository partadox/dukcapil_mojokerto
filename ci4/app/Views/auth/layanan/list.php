<?= form_open('layanan/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listlayanan" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="5%">
                <input type="checkbox" id="centangSemua">
            </th>
            <th width="5%">#</th>
            <th width="15%">Kategori Layanan</th>
            <th width="15%">Subkategori</th>
            <th width="10%">Tindakan</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td>
                    <input type="checkbox" name="layanan_id[]" class="centanglayananid" value="<?= $data['layanan_id'] ?>">
                </td>
                <td><?= $nomor ?></td>
                <td><h6><b><?= esc($data['LK_nama']) ?></b></h6> </td>
                <td><h6><b><?= esc($data['layanan_subkategori']) ?></b> </h6> </td>
                <td>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['layanan_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['layanan_id'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
<?= form_close() ?>
<script>
    $(document).ready(function() {
        $('#listlayanan').DataTable();

        // $('textarea#layanan_isi').summernote({
        //     height: 250,
        //     minHeight: null,
        //     maxHeight: null,
        //     focus: true
        // });

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centanglayananid').prop('checked', true);
            } else {
                $('.centanglayananid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centanglayananid:checked');
            if (jmldata.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops!',
                    text: 'Silahkan pilih data!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    title: 'Hapus data',
                    text: `Apakah anda yakin ingin menghapus sebanyak ${jmldata.length} data?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Tetap Hapus'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Data Berhasil Dihapus!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                listlayanan();
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(layanan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('layanan/formedit') ?>",
            data: {
                layanan_id: layanan_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaledit').modal('show');
                }
            }
        });
    }

    function hapus(layanan_id) {
        Swal.fire({
            title: 'Hapus data?',
            text: `Apakah anda yakin menghapus data?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= site_url('layanan/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        layanan_id: layanan_id
                    },
                    success: function(response) {
                        if (response.sukses) {
                            Swal.fire({
                                title: "Berhasil!",
                                text: response.sukses,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            listlayanan();
                        }
                    }
                });
            }
        })
    }
</script>
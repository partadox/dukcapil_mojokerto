<?= form_open('link/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listlink" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="2%">
                <input type="checkbox" id="centangSemua">
            </th>
            <th width="2%">#</th>
            <th width="15%">Nama Link Terkait</th>
            <th width="15%">Status</th>
            <th width="15%">URL</th>
            <th width="15%">Gambar</th>
            <th width="15%">Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td>
                    <input type="checkbox" name="link_id[]" class="centanglinkid" value="<?= $data['link_id'] ?>">
                </td>
                <td><?= $nomor ?></td>
                <td><?= esc($data['link_nama']) ?></td>
                <td>
                    <?php if ($data['link_status'] == 'PUBLISH') { ?>
                        <h6>
                            <span class="badge badge-success"><?= $data['link_status'] ?></span>
                        </h6>
                    <?php } else { ?>
                        <h6>
                            <span class="badge badge-danger"><?= $data['link_status'] ?></span>
                        </h6>
                    <?php } ?>

                </td>
                <td><?= esc($data['link_url']) ?></td>
                <td class="text-center">
                    <img onclick="gambar('<?= $data['link_id'] ?>')" src="<?= base_url('img/link/thumb/' . 'thumb_' . $data['link_gambar']) ?>" width="120px" class="img-thumbnail">
                </td>
                
                <td>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['link_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['link_id'] ?>')">
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
        $('#listlink').DataTable();

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centanglinkid').prop('checked', true);
            } else {
                $('.centanglinkid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centanglinkid:checked');
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
                                listlink();
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(link_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('link/formedit') ?>",
            data: {
                link_id: link_id
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

    function hapus(link_id) {
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
                    url: "<?= site_url('link/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        link_id: link_id
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
                            listlink();
                        }
                    }
                });
            }
        })
    }

    function gambar(link_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('link/formupload') ?>",
            data: {
                link_id: link_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalupload').modal('show');
                }
            }
        });
    }
</script>
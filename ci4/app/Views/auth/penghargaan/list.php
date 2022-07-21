<hr>
<table id="listpenghargaan" class="table table-bordered table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="15%">Nama Penghargaan</th>
            <th width="5%">Sematkan</th>
            <th width="15%">Gambar</th>
            <th width="15%">Deskripsi</th>
            <th width="8%">Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td><?= $nomor ?></td>
                <td><?= esc($data['penghargaan_nama']) ?></td>
                <td>
                    <?php if ($data['penghargaan_pin'] == 0) { ?>
                        <h6>
                            <span class="badge badge-danger">NONAKTIF</span>
                        </h6>
                    <?php } else { ?>
                        <h6>
                            <span class="badge badge-success">AKTIF</span>
                        </h6>
                    <?php } ?>

                </td>
                <td class="text-center">
                    <img onclick="gambar('<?= $data['penghargaan_id'] ?>')" src="<?= base_url('img/penghargaan/thumb/' . 'thumb_' . $data['penghargaan_gambar']) ?>" width="120px" class="img-thumbnail">
                </td>
                <td><?= esc($data['penghargaan_deskripsi']) ?></td>
                <td>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['penghargaan_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['penghargaan_id'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#listpenghargaan').DataTable();

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangpenghargaanid:checked');
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
                                listpenghargaan();
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(penghargaan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('medfo/formedit_penghargaan') ?>",
            data: {
                penghargaan_id: penghargaan_id
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

    function hapus(penghargaan_id) {
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
                    url: "<?= site_url('medfo/hapus_penghargaan') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        penghargaan_id: penghargaan_id
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
                            listpenghargaan();
                        }
                    }
                });
            }
        })
    }

    function gambar(penghargaan_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('medfo/formupload_penghargaan') ?>",
            data: {
                penghargaan_id: penghargaan_id
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
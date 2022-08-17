<hr>
<table id="listgisa" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">Kategori Gisa</th>
            <th width="15%">Subkategori</th>
            <th width="15%">File Upload</th>
            <th width="10%">Tindakan</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td><?= $nomor ?></td>
                <td><h6><b><?= esc($data['GK_nama']) ?></b></h6> </td>
                <td><h6><b><?= esc($data['gisa_subkategori']) ?></b> </h6> </td>
                <td> 
                        <?php if($data['gisa_file'] == NULL) { ?>
                            <p>-</p>
                        <?php } ?>
                        <?php if($data['gisa_file'] != NULL) { ?>
                            <?= esc($data['gisa_file']) ?>
                        <?php } ?>
                </td>
                <td>
                    <h6>
                        <button type="button" onclick="file(<?= $data['gisa_id'] ?>)" class="btn btn-primary "><i class="fa fa-file"></i> FILE</button>
                    </h6>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['gisa_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['gisa_id'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#listgisa').DataTable();
    });

    function edit(gisa_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('gisa/formedit') ?>",
            data: {
                gisa_id: gisa_id
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

    function file(gisa_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('gisa/formupload') ?>",
            data: {
                gisa_id: gisa_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodalup').html(response.sukses).show();
                    $('#modaluploadpdf').modal('show');
                }
            }
        });
    }

    function hapus(gisa_id) {
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
                    url: "<?= site_url('gisa/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        gisa_id: gisa_id
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
                            listgisa();
                        }
                    }
                });
            }
        })
    }
</script>
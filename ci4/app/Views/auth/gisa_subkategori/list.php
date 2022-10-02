

<hr>
<table id="listGKS" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="5%">#</th>
            <th width="15%">Kategori Gisa</th>
            <th width="15%">Sub-Kategori Gisa</th>
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
                <td><h6><?= esc($data['GKS_nama']) ?></h6> </td>
                <td>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['GKS_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['GKS_id'] ?>')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>


<script>

    $(document).ready(function() {
        $('#listGKS').DataTable();

        // $('textarea#GK_isi').summernote({
        //     height: 250,
        //     minHeight: null,
        //     maxHeight: null,
        //     focus: true
        // });
    });

    function edit(GKS_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('gisa/subkategori_formedit') ?>",
            data: {
                GKS_id: GKS_id
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

    function hapus(GKS_id) {
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
                    url: "<?= site_url('gisa/subkategori_hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        GKS_id: GKS_id
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
                            listGK();
                        }
                    }
                });
            }
        })
    }
</script>
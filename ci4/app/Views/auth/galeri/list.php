<?= form_open('galeri/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listgallery" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>
                <input type="checkbox" id="centangSemua">
            </th>
            <th>#</th>
            <th>Nama Galeri</th>
            <th>Dibuat</th>
            <th>Terakhir Diedit</th>
            <th>Sampul</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td>
                    <input type="checkbox" name="galeri_id[]" class="centangGalleryid" value="<?= $data['galeri_id'] ?>">
                </td>
                <td><?= $nomor ?></td>
                <td><?= esc($data['galeri_nama']) ?></td>
                <td>
                    Tgl : <?= longdate_indo($data['galeri_create_dt']) ?> <br>
                    Waktu : <?= esc($data['galeri_create_tm']) ?> WIB <br>
                    Oleh : <?= esc($data['galeri_creator']) ?>
                </td>
                <td>
                    Tgl : <?= longdate_indo($data['galeri_modified_dt']) ?> <br>
                    Waktu : <?= esc($data['galeri_modified_tm']) ?> WIB <br>
                    Oleh : <?= esc($data['galeri_modified_author']) ?>
                </td>
                <td class="text-center">
                    <img onclick="gambar('<?= $data['galeri_id'] ?>')" src="<?= base_url('img/sampul/thumb/' . 'thumb_' . $data['galeri_sampul']) ?>" width="120px" class="img-thumbnail">
                </td>
                <td>
                    <h6>
                        <button type="button" onclick="foto(<?= $data['galeri_id'] ?>)" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> FOTO</button>
                    </h6>
                    <button type="button" class="btn btn-warning btn-sm" onclick="edit('<?= $data['galeri_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="hapus('<?= $data['galeri_id'] ?>')">
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
        $('#listgallery').DataTable();

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangGalleryid').prop('checked', true);
            } else {
                $('.centangGalleryid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangGalleryid:checked');
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
                    title: `Apakah anda yakin ingin menghapus ${jmldata.length} galeri?`,
                    text: 'Semua foto yang ada didalam galeri akan terhapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Tetap Hapus!'
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
                                    text: response.sukses,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                listgallery();
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(galeri_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('galeri/formedit') ?>",
            data: {
                galeri_id: galeri_id
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

    function hapus(galeri_id) {
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
                    url: "<?= site_url('galeri/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        galeri_id: galeri_id
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
                            listgallery();
                        }
                    }
                });
            }
        })
    }

    function gambar(galeri_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('galeri/formupload') ?>",
            data: {
                galeri_id: galeri_id
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

    function foto(galeri_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('galeri/formfoto') ?>",
            data: {
                galeri_id: galeri_id
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modalfoto').modal('show');
                }
            }
        });
    }
</script>
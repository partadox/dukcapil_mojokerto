<?= form_open('berita/hapusall', ['class' => 'formhapus']) ?>

<button type="submit" class="btn btn-danger">
    <i class="fa fa-trash"></i> Hapus yang diceklist
</button>

<hr>
<table id="listberita" class="table table-striped dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th width="2%">
                <input type="checkbox" id="centangSemua">
            </th>
            <th width="2%">#</th>
            <th width="15%">Judul Berita</th>
            <th width="5%">Sematkan</th>
            <th width="15%">Dibuat</th>
            <th width="15%">Terakhir Diedit</th>
            <th width="15%">Sampul</th>
            <th width="3%">Status</th>
            <th width="8%">Aksi</th>
        </tr>
    </thead>


    <tbody>
        <?php $nomor = 0;
        foreach ($list as $data) :
            $nomor++; ?>
            <tr>
                <td>
                    <input type="checkbox" name="berita_id[]" class="centangBeritaid" value="<?= $data['berita_id'] ?>">
                </td>
                <td><?= $nomor ?></td>
                <td><?= esc($data['berita_judul']) ?></td>
                <td>
                    <?php if ($data['berita_pin'] == 0) { ?>
                        <h6>
                            <span class="badge badge-danger">NONAKTIF</span>
                        </h6>
                    <?php } else { ?>
                        <h6>
                            <span class="badge badge-success">AKTIF</span>
                        </h6>
                    <?php } ?>

                </td>
                <td>
                    Tgl : <?= longdate_indo($data['berita_create_dt']) ?> <br>
                    Waktu : <?= esc($data['berita_create_tm']) ?> WIB <br>
                    Oleh : <?= esc($data['berita_creator']) ?>
                </td>
                <td>
                    Tgl : <?= longdate_indo($data['berita_modified_dt']) ?> <br>
                    Waktu : <?= esc($data['berita_modified_tm']) ?> WIB <br>
                    Oleh : <?= esc($data['berita_modified_author']) ?>
                </td>
                <td class="text-center">
                    <img onclick="gambar('<?= $data['berita_id'] ?>')" src="<?= base_url('img/berita/thumb/' . 'thumb_' . $data['berita_sampul']) ?>" width="120px" class="img-thumbnail">
                </td>
                <td>
                    <?php if ($data['berita_status'] == 'PUBLISH') { ?>
                        <h6>
                            <span class="badge badge-success"><?= $data['berita_status'] ?></span>
                        </h6>
                    <?php } else { ?>
                        <h6>
                            <span class="badge badge-danger"><?= $data['berita_status'] ?></span>
                        </h6>
                    <?php } ?>

                </td>
                <td>
                    <button type="button" class="btn btn-primary mb-2" onclick="edit('<?= $data['berita_id'] ?>')">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-danger mb-2" onclick="hapus('<?= $data['berita_id'] ?>')">
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
        $('#listberita').DataTable();

        $('#centangSemua').click(function(e) {
            if ($(this).is(':checked')) {
                $('.centangBeritaid').prop('checked', true);
            } else {
                $('.centangBeritaid').prop('checked', false);
            }
        });

        $('.formhapus').submit(function(e) {
            e.preventDefault();
            let jmldata = $('.centangBeritaid:checked');
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
                                listberita();
                            }
                        });
                    }
                })
            }
        });
    });

    function edit(berita_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('berita/formedit') ?>",
            data: {
                berita_id: berita_id
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

    function hapus(berita_id) {
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
                    url: "<?= site_url('berita/hapus') ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        berita_id: berita_id
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
                            listberita();
                        }
                    }
                });
            }
        })
    }

    function gambar(berita_id) {
        $.ajax({
            type: "post",
            url: "<?= site_url('berita/formupload') ?>",
            data: {
                berita_id: berita_id
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
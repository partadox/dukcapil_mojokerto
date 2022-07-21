<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Galeri</a></li>
        <li class="breadcrumb-item active">List Galeri</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<p class="mt-1">Catatan :<br>
    <i class="mdi mdi-information"></i> Klik <i class="fa fa-eye"></i> <b>FOTO</b> untuk menambah dan menghapus foto dalam galeri. <br>
    <i class="mdi mdi-information"></i> Klik gambar pada kolom <b>Sampul</b> untuk merubah sampul Galeri. <br>
    <i class="mdi mdi-information"></i> Jika ingin menghapus galeri pastikan Galeri dalam keadaan kosong (Tidak ada foto di dalamnya). <br>
</p>

<a>
    <button type="button" class="btn btn-primary tambahgallery mb-2"><i class=" fa fa-plus-circle"></i> Tambah Galeri</button>
</a>

<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listgallery() {
        $.ajax({
            url: "<?= site_url('galeri/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listgallery();
        $('.tambahgallery').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('galeri/formtambah') ?>",
                dataType: "json",
                success: function(response) {
                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                }
            });
        });
    });
</script>
<?= $this->endSection('isi') ?>
<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Inovasi Layanan</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a>
    <button type="button" class="btn btn-primary tambahinovasi mb-2"><i class=" fa fa-plus-circle"></i> Tambah Inovasi Layanan</button>
</a>

<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listinovasi() {
        $.ajax({
            url: "<?= site_url('inovasi/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listinovasi();
        $('.tambahinovasi').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('inovasi/formtambah') ?>",
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
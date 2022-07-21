<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Penghargaan</a></li>
        <li class="breadcrumb-item active">List Penghargaan</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a>
    <button type="button" class="btn btn-primary tambahpenghargaan mb-2"><i class=" fa fa-plus-circle"></i> Tambah Penghargaan</button>
</a>

<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listpenghargaan() {
        $.ajax({
            url: "<?= site_url('medfo/getdata_penghargaan') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listpenghargaan();
        $('.tambahpenghargaan').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('medfo/formtambah_penghargaan') ?>",
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
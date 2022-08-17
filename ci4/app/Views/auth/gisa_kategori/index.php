<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);"> Kategori Gisa</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a>
    <button type="button" class="btn btn-primary tambahLK mb-2"><i class=" fa fa-plus-circle"></i> Tambah Kategori Gisa</button>
</a>

<div class="viewdata">
</div>

<div class="viewmodal">
</div>


<script>
    function listGK() {
        $.ajax({
            url: "<?= site_url('gisa/kategori_getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listGK();
        $('.tambahLK').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('gisa/kategori_formtambah') ?>",
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
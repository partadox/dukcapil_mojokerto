<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title"><?= $title ?></h4>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-right">
        <li class="breadcrumb-item"><a href="javascript:void(0);"> Gisa</a></li>
        <li class="breadcrumb-item active">List</li>
    </ol>
</div>
<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>

<a>
    <button type="button" class="btn btn-primary tambahgisa mb-2"><i class=" fa fa-plus-circle"></i> Tambah File Lapak Gisa</button>
</a>

<div class="viewdata">
</div>

<div class="viewmodal">
</div>

<div class="viewmodalup">
</div>


<script>
    function listgisa() {
        $.ajax({
            url: "<?= site_url('gisa/getdata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            }
        });
    }

    $(document).ready(function() {
        listgisa();
        $('.tambahgisa').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('gisa/formtambah') ?>",
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
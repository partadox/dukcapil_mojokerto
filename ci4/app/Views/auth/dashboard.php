<?= $this->extend('layout/script') ?>

<?= $this->section('judul') ?>
<div class="col-sm-6">
    <h4 class="page-title">Dashboard</h4>
</div>

<?= $this->endSection('judul') ?>

<?= $this->section('isi') ?>
<div class="alert alert-primary alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> <i class="mdi mdi-account-multiple-outline"></i>
    <?php if (session()->get('level') == 1) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai author.
    <?php } ?>
    <?php if (session()->get('level') == 2) { ?>
        <strong>Selamat datang!</strong> Anda login sebagai admin.
    <?php } ?>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Konten</h6>
        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
    </div>
    <div class="card-body">
        <div class="row">
            
        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-image-album bg-primary text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Galeri</h5>
                    </div>
                    <h3 class="mt-4"><?= $galeri ?></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-newspaper bg-primary text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Berita</h5>
                    </div>
                    <h3 class="mt-4"><?= $berita ?></h3>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-4">
            <div class="card shadow-sm">
                <div class="card-heading p-4">
                    <div class="mini-stat-icon float-right">
                        <i class="mdi mdi-bullhorn-outline bg-primary text-white"></i>
                    </div>
                    <div>
                        <h5 class="font-16">Jumlah Pengumuman</h5>
                    </div>
                    <h3 class="mt-4"><?= $pengumuman ?></h3>
                </div>
            </div>
        </div>
            
        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Pengunjung Website</h6>
        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
    </div>
    <div class="card-body">
        <div class="row">
            
          <div class="col-sm-6 col-xl-3">
              <div class="card shadow-sm">
                  <div class="card-heading p-4">
                      <div class="mini-stat-icon float-right">
                          <i class="mdi mdi-account bg-primary text-white"></i>
                      </div>
                      <div>
                          <h5 class="font-16">Hari Ini</h5>
                      </div>
                      <h3 class="mt-4"><?= $visitor_hariini ?></h3>
                  </div>
              </div>
          </div>

          <div class="col-sm-6 col-xl-3">
              <div class="card shadow-sm">
                  <div class="card-heading p-4">
                      <div class="mini-stat-icon float-right">
                          <i class="mdi mdi-account bg-primary text-white"></i>
                      </div>
                      <div>
                          <h5 class="font-16">Bulan Ini</h5>
                      </div>
                      <h3 class="mt-4"><?= $visitor_bulanini ?></h3>
                  </div>
              </div>
          </div>

          <div class="col-sm-6 col-xl-3">
              <div class="card shadow-sm">
                  <div class="card-heading p-4">
                      <div class="mini-stat-icon float-right">
                          <i class="mdi mdi-account bg-primary text-white"></i>
                      </div>
                      <div>
                          <h5 class="font-16">Tahun Ini</h5>
                      </div>
                      <h3 class="mt-4"><?= $visitor_tahunini ?></h3>
                  </div>
              </div>
          </div>

          <div class="col-sm-6 col-xl-3">
              <div class="card shadow-sm">
                  <div class="card-heading p-4">
                      <div class="mini-stat-icon float-right">
                          <i class="mdi mdi-account bg-primary text-white"></i>
                      </div>
                      <div>
                          <h5 class="font-16">Total</h5>
                      </div>
                      <h3 class="mt-4"><?= $visitor_total ?></h3>
                  </div>
              </div>
          </div>
            
        </div>
    </div>
</div>

<div class="card shadow-lg">
    <div class="card-header pb-0">
        <h6 class="card-title mb-2">Grafik Pengunjung Website</h6>
        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div id="chartVisitor"></div>
            </div>
            
        </div>
    </div>
</div>

<!-- Hightcharts JS-->
<script src="<?= base_url() ?>/assets/js/highcharts.js"></script>

<script>
    Highcharts.setOptions({
    colors: ['#4b703a']
});
Highcharts.chart('chartVisitor', {
  chart: {
    type: 'area'
  },
  title: {
    text: 'Grafik Jumlah Pengunjung Website'
  },
  xAxis: {
    categories: <?= $d1 ?>,
    tickmarkPlacement: 'on',
    title: {
      enabled: false
    }
  },
  yAxis: {
    title: {
      text: 'Jumlah'
    },
    labels: {
      formatter: function () {
        return this.value ;
      }
    }
  },
  tooltip: {
    split: true,
    valueSuffix: ''
  },
  plotOptions: {
    area: {
      stacking: 'normal',
      lineColor: '#6c936d',
      lineWidth: 1,
      marker: {
        lineWidth: 1,
        lineColor: '#6c936d'
      }
    }
  },
  series: [{
    name: 'Pengunjung',
    data: <?= $d2 ?>
  }]
});
</script>

<?= $this->endSection('isi') ?>
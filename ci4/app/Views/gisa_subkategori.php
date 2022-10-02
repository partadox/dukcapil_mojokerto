<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h4><a style="color:white;" href="<?= base_url('home/gisa_kategori/') ?>"> Lapak Gisa Kategori: <?= $GK_nama ?></a> </h4>
          </div>
      </div>
    </div>
  </div>
</section>

<section class="category-section3 mt-4">
    <div class="container">
        <div class="row no-gutters">
            <div class="course-categories">

            <table class="table table-striped table-bordered dt-responsive " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
              <thead>
                  <tr>
                      <th width="2%">No</th>
                      <th width="15%">Sub-Kategori Gisa</th>
                  </tr>
              </thead>
              <tbody>
                <?php $nomor = 0;
                foreach ($gisa as $data) :
                    $nomor++; ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td> <a href="<?= base_url('home/gisa_sub_subkategori/' . $GK_nama . '/' . $data['GKS_slug']) ?>"><?= esc($data['GKS_nama']) ?></a> </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
            </table>


            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
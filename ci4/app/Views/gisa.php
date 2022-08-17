<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1><?= $LK_nama ?></h1>
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
                      <th width="15%">Kategori</th>
                      <th width="5%">Tindakan</th>
                  </tr>
              </thead>
              <tbody>
                <?php $nomor = 0;
                foreach ($gisa as $data) :
                    $nomor++; ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td> <a href=""><?= esc($data['GK_nama']) ?></a> </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
            </table>

                <?php
                foreach ($gisa as $data_gisa) :?>
                    <div class="category-item category-bg-3 mb-3">
                      <a href="<?= base_url('home/gisa/'. $data_gisa['gisa_slug']) ?>">
                        <div class="category-icon">
                            <i class="bi bi-file"></i>
                        </div>
                        <h3 style="color:#eee;"><?= esc($data_gisa['gisa_subkategori']) ?></h3>
                      </a>
                    </div>

                <?php endforeach; ?>

                

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
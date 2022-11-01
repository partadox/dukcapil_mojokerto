<?= $this->extend('main') ?>

<?= $this->section('isi') ?>

<section class="page-header">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
          <div class="page-header-content">
            <h1 style="font-size:3.5vw;">Daftar Kategori Unduhan Lapak Gisa</h1>
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
                      <th width="15%">Kategori Unduhan Lapak Gisa</th>
                  </tr>
              </thead>
              <tbody>
                <?php $nomor = 0;
                foreach ($gisa_kategori as $data) :
                    $nomor++; ?>
                    <tr>
                        <td><?= $nomor ?></td>
                        <td> <a href="<?= base_url('home/gisa_subkategori/'. $data['GK_slug']) ?>"><?= esc($data['GK_nama']) ?></a> </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
            </table>


                

            </div>
        </div>
    </div>
</section>

<?= $this->endSection('isi') ?>
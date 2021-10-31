<?= $this->extend('App\Modules\Admin\Views\Layout\layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Edit Unit Kerja</h2>
  </div>
  <?php if (session()->getFlashData('error') != NULL) : ?>
    <div class="alert alert-danger" role="alert">
      <?php
      $errors = session()->getFlashData('error');
      // var_dump($errors);
      // var_dump($error);
      foreach ($errors as $error) {
        echo "<li>$error</li>";
      }
      ?>
    </div>
  <?php endif; ?>

  <form enctype="multipart/form-data" method="POST" action="<?= base_url('/admin/unit/edit') . '/' . $unit['id_unitkerja'] ?>">
    <?= csrf_field() ?>
    <div class="form-group">
      <input type="hidden" name="dokumenLama" value="<?= $unit['dokumen']; ?>">
      <label for="nama">Nama Unit</label>
      <input type="text" name="nama_unitkerja" value="<?= $unit['nama_unitkerja'] ?>" class="form-control" id="nama" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="dokumen">Dokumen</label>
      <input type="file" name="dokumen" class="form-control" id="dokumen">
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
</div>


<?= $this->endSection('content') ?>
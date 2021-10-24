<?= $this->extend('Layout/layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Daftar Unit Kerja</h2>
    <a href="<?= base_url('/admin/unit/tambah') ?>">
      <button class="btn btn-primary">Tambah</button>
    </a>
  </div>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">ID Unit</th>
        <th scope="col">Nama Unit</th>
        <th scope="col">Dokumen</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($unit as $row) : ?>
        <tr>
          <th scope="row"><?= $row['id_unitkerja'] ?></th>
          <td><?= $row['nama_unitkerja'] ?></td>
          <td><a href="<?= base_url('uploads/' . $row['dokumen']) ?>">Download</a></td>
          <td>
            <a href="<?= base_url('/admin/unit/delete') . '/' . $row['id_unitkerja'] ?>">
              <button class="btn btn-danger">Hapus</button>
            </a>
            <a href="<?= base_url('/admin/unit/ubah') . '/' . $row['id_unitkerja'] ?>">
              <button class="btn btn-warning">Edit</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    <?= $pager->links('unit', 'pagination'); ?>
  </div>
</div>


<?= $this->endSection('content') ?>
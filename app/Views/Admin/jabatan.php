<?= $this->extend('Layout/layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Daftar Jabatan</h2>
    <a href="<?= base_url('/admin/jabatan/tambah') ?>">
      <button class="btn btn-primary">Tambah</button>
    </a>
  </div>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">ID Jabatan</th>
        <th scope="col">Nama Jabatan</th>
        <th scope="col">Nama Unit</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jabatan as $row) : ?>
        <tr>
          <th scope="row"><?= $row['id_jabatan'] ?></th>
          <td><?= $row['nama_jabatan'] ?></td>
          <td><?= $row['nama_unitkerja'] ?></td>
          <td>
            <a href="<?= base_url('/admin/jabatan/delete') . '/' . $row['id_jabatan'] ?>">
              <button class="btn btn-danger">Hapus</button>
            </a>
            <a href="<?= base_url('/admin/jabatan/ubah') . '/' . $row['id_jabatan'] ?>">
              <button class="btn btn-warning">Edit</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    <?= $pager->links('jabatan', 'pagination'); ?>
  </div>

</div>


<?= $this->endSection('content') ?>
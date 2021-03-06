<?= $this->extend('App\Modules\Admin\Views\Layout\layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
  <div class="d-flex justify-content-between">
    <h2>Daftar Pegawai</h2>
    <a href="<?= base_url('/admin/pegawai/tambah') ?>">
      <button class="btn btn-primary">Tambah</button>
    </a>
  </div>
  <div class="">
    <a href="<?= base_url('/admin/pegawai/cetakPDF') ?>" class="btn btn-danger mb-2">PDF</a>
    <a href="<?= base_url('/admin/pegawai/cetakExcel') ?>" class="btn btn-success mb-2">Excel</a>
    <a href="<?= base_url('/admin/pegawai/cetakWord') ?>" class="btn btn-primary mb-2">Word</a>
  </div>

  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">NIP</th>
        <th scope="col">Nama</th>
        <th scope="col">Unit Kerja</th>
        <th scope="col">Jabatan</th>
        <th scope="col">Foto</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pegawai as $row) : ?>
        <tr>
          <th scope="row"><?= $row['nip'] ?></th>
          <td><?= $row['nama_pegawai'] ?></td>
          <td><?= $row['nama_unitkerja'] ?></td>
          <td><?= $row['nama_jabatan'] ?></td>
          <td><img src="<?= base_url(); ?>/uploads/<?= $row['foto']; ?>" width="100px"></td>
          <td><a href="<?= base_url('/admin/pegawai/delete') . '/' . $row['nip'] ?>">
              <button class="btn btn-danger">Hapus</button>
            </a>
            <a href="<?= base_url('/admin/pegawai/ubah') . '/' . $row['nip'] ?>">
              <button class="btn btn-warning">Edit</button>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
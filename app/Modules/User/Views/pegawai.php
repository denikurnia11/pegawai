<?= $this->extend('App\Modules\User\Views\Layout\layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">NIP</th>
                <th scope="col">Nama</th>
                <th scope="col">Unit Kerja</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Foto</th>

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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?= $pager->links('pegawai', 'pagination'); ?>
    </div>
</div>

<?= $this->endSection() ?>
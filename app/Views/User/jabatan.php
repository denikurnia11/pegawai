<?= $this->extend('Layout/layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID Jabatan</th>
                <th scope="col">Nama Jabatan</th>
                <th scope="col">Nama Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jabatan as $row) : ?>
                <tr>
                    <th scope="row"><?= $row['id_jabatan'] ?></th>
                    <td><?= $row['nama_jabatan'] ?></td>
                    <td><?= $row['nama_unitkerja'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?= $pager->links('jabatan', 'pagination'); ?>
    </div>

</div>


<?= $this->endSection('content') ?>
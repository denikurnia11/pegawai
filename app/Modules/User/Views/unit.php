<?= $this->extend('App\Modules\User\Views\Layout\layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID Unit</th>
                <th scope="col">Nama Unit</th>
                <th scope="col">Dokumen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($unit as $row) : ?>
                <tr>
                    <th scope="row"><?= $row['id_unitkerja'] ?></th>
                    <td><?= $row['nama_unitkerja'] ?></td>
                    <td><a href="<?= base_url('uploads/' . $row['dokumen']) ?>">Download</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>


<?= $this->endSection() ?>
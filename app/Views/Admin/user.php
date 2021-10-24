<?= $this->extend('Layout/layout') ?>


<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h2>Daftar User</h2>
        <a href="<?= base_url('/admin/user/tambah') ?>">
            <button class="btn btn-primary">Tambah</button>
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Password</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($user as $row) : ?>
                <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['password'] ?></td>
                    <td><a href="<?= base_url('/admin/user/delete') . '/' . $row['id_user'] ?>">
                            <button class="btn btn-danger">Hapus</button>
                        </a>
                        <a href="<?= base_url('/admin/user/ubah') . '/' . $row['id_user'] ?>">
                            <button class="btn btn-warning">Edit</button>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <?= $pager->links('user', 'pagination'); ?>
    </div>
</div>

<?= $this->endSection('content') ?>
<?= $this->extend('Layout/layout') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h2>Edit User</h2>
    </div>

    <form enctype="multipart/form-data" method="POST" action="<?= base_url('/admin/user/edit/' . $user['id_user']) ?>">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" value="<?= $user['nama']; ?>">
            <div class="invalid-feedback">
                <?= $validasi->getError('nama'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control <?= ($validasi->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" value="<?= $user['email']; ?>">
            <div class="invalid-feedback">
                <?= $validasi->getError('email'); ?>
            </div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password">
            <div class="invalid-feedback">
                <?= $validasi->getError('password'); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role" required>
                <option value="">Pilih role</option>
                <option <?= ($user['role'] == 'user' ? 'selected' : ''); ?> value="user">User</option>
                <option <?= ($user['role'] == 'admin' ? 'selected' : ''); ?> value="admin">Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>


<?= $this->endSection('content') ?>
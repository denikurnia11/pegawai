<?= $this->extend('App\Modules\Auth\Views\Layout\layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-7 shadow rounded" style="background-color: #CCF2F4; height:600px; padding:20px">
            <h2 class="text-center mb-5">Form Registrasi</h2>
            <form method="POST" action="<?= base_url('/auth/registrasi/create') ?>" class="formAuth">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="nama" class="form-control" id="nama" name="nama" placeholder="Your name" value="<?= old('nama'); ?>" required>

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@gmail.com" name="email" value="<?= old('email'); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" required>

                </div>
                <div id="emailHelp" class="form-text text-center">Already have an account? <a href="<?= base_url('/auth/login') ?>">Login</a> </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
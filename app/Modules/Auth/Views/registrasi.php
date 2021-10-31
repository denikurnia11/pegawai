<?= $this->extend('App\Modules\Auth\Views\Layout\layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-7 shadow rounded" style="background-color: #CCF2F4; height:600px; padding:20px">
            <h2 class="text-center mb-5">Form Registrasi</h2>
            <form method="POST" action="<?= base_url('/auth/registrasi/create') ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="nama" class="form-control <?= ($validasi->hasError('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Your name" value="<?= old('nama'); ?>">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('nama'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control <?= ($validasi->hasError('email')) ? 'is-invalid' : ''; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@gmail.com" name="email" value="<?= old('email'); ?>">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('email'); ?>
                    </div>
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control <?= ($validasi->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password">
                    <div class="invalid-feedback">
                        <?= $validasi->getError('password'); ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control <?= (session()->getFlashdata('pesan')) ? 'is-invalid' : ''; ?>" id="cpassword" name="cpassword">
                    <div class="invalid-feedback">
                        <?= session()->getFlashdata('pesan'); ?>
                    </div>
                </div>
                <div id="emailHelp" class="form-text text-center">Already have an account? <a href="<?= base_url('/auth/login') ?>">Login</a> </div>
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
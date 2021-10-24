<?= $this->extend('Layout/layout') ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-7 shadow rounded" style="background-color: #CCF2F4; height:450px; padding:20px">
            <h2 class="text-center mb-5">Form Login</h2>
            <!-- FlashData -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success text-start d-flex justify-content-between align-items-center" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?= base_url('/auth/login/cek') ?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="email@gmail.com" name="email">
                    <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div id="emailHelp" class="form-text text-center"><a href="<?= base_url('/auth/registrasi') ?>">Don't have an account?.</a> </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
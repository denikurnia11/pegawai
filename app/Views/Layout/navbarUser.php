<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Manajemen Pegawai</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <!-- <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a> -->
                <a class="nav-link" href="<?= base_url('/user/pegawai') ?>">Pegawai</a>
                <a class="nav-link" href="<?= base_url('/user/jabatan') ?>">Jabatan</a>
                <a class="nav-link" href="<?= base_url('/user/unit') ?>">Unit Kerja</a>
                <a class="nav-link text-danger" href="<?= base_url('/auth/login/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</nav>
<?= $this->extend('layout/login') ?>

<?= $this->section('content') ?>
<h3 class="mb-3 font-weight-bold text-center">Register</h3>
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-secondary">Nama</label>
                <input class="form-control" type="name" placeholder="Masukkan Nama" />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-secondary">Email</label>
                <input class="form-control" type="email" placeholder="Masukkan Email" />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="text-secondary">Tempat</label>
                        <input class="form-control" type="name" placeholder="Masukkan Tempat" />
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="text-secondary">Tanggal Lahir</label>
                        <input class="form-control" type="date" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-secondary">Username</label>
                <input class="form-control" type="email" placeholder="Masukkan Username" />
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <input type="radio" id="laki-laki" name="jenis_kelamin" value="laki-laki">
                <label for="laki-laki" class="text-secondary">Laki - Laki</label>
            </div>
            <div class="form-group">
                <input type="radio" id="perempuan" name="jenis_kelamin" value="perempuan">
                <label for="perempuan" class="text-secondary">Perempuan</label>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label class="text-secondary">Password</label>
                </div>
                <input class="form-control" type="password" placeholder="Enter Password" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">
        Register
    </button>
    <div class="col-lg-12">
        <p class="mb-0 text-center">
            Do you have an account?
            <a href="/login">Login</a>
        </p>
    </div>
</form>
<?= $this->endSection() ?>
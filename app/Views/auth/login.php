<?= $this->extend('layout/login') ?>

<?= $this->section('content') ?>
<style>
    body::before {
        height: 100%;
    }
</style>
<h3 class="mb-3 font-weight-bold text-center">Login</h3>
<form action="<?= base_url('/login') ?>" method="post">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-secondary">Username</label>
                <input class="form-control" type="name" name="username" placeholder="Enter Username" />
            </div>
        </div>
        <div class="col-lg-12 mt-2">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label class="text-secondary">Password</label>
                </div>
                <input class="form-control" type="password" name="password" placeholder="Enter Password" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block mt-2">
        Log In
    </button>
    <div class="col-lg-12 mt-3">
        <p class="mb-0 text-center">
            Don't have an account?
            <a href="/register">Register</a>
        </p>
    </div>
</form>
<?= $this->endSection() ?>
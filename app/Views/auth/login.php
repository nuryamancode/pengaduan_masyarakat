<?= $this->extend('layout/login') ?>

<?= $this->section('content') ?>
<h3 class="mb-3 font-weight-bold text-center">Login</h3>
<form>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="text-secondary">Email</label>
                <input class="form-control" type="email" placeholder="Enter Email" />
            </div>
        </div>
        <div class="col-lg-12 mt-2">
            <div class="form-group">
                <div class="d-flex justify-content-between align-items-center">
                    <label class="text-secondary">Password</label>
                </div>
                <input class="form-control" type="password" placeholder="Enter Password" />
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
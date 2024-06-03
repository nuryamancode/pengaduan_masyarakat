<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Datum | CRM Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('admin/images/favicon.ico') ?>" />

    <link rel="stylesheet" href="<?= base_url('admin/css/backend-plugin.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('admin/css/backend.css?v=1.0.0') ?>" />
    <style>
        body {
            background-image: url("<?= base_url('admin/images/bg.jpg') ?>");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body class=" ">

    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="auth-logo">
                                    <img src="<?= base_url('admin/images/logopolres.png') ?>" class="img-fluid rounded-normal"
                                        alt="logo" />
                                </div>
                                <?= $this->renderSection('content') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="<?= base_url('admin/js/backend-bundle.min.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('admin/js/app.js') ?>"></script>
</body>

</html>
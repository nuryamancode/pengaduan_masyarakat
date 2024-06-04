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
            position: relative;
            margin: 0;
            height: 100vh;
            /* Ensure body covers the entire viewport */
            /* overflow: hidden; Prevent scrolling */
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-image: url("<?= base_url('admin/images/bg.jpg') ?>");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            filter: blur(8px);
            /* Adjust the blur level as needed */
            z-index: -1;
            /* Ensure it stays behind the content */
        }

        .content-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
            /* Adjust shadow as needed */
            z-index: -1;
            /* Ensure it stays behind the content */
        }
    </style>
</head>

<body class=" ">

    <div class="wrapper">
        <section class="login-content">
            <div class="container h-100 mt-3">
                <div class="row align-items-center justify-content-center h-100">
                    <div class="col-md-5">
                        <div class="card p-3">
                            <div class="card-body">
                                <div class="auth-logo">
                                    <img src="<?= base_url('admin/images/logopolres.png') ?>"
                                        class="img-fluid rounded-normal" alt="logo" />
                                </div>
                                <?php if (session()->getFlashdata('success')): ?>
                                    <p style="color: green;"><?php echo session()->getFlashdata('success'); ?></p>
                                <?php endif; ?>
                                <?php if (session()->getFlashdata('error')): ?>
                                    <p style="color: red;"><?php echo session()->getFlashdata('error'); ?></p>
                                <?php endif; ?>
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
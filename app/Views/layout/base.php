<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Datum | CRM Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('admin/images/favicon.ico') ?>" />

    <link rel="stylesheet" href="<?= base_url('admin/css/backend-plugin.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('admin/css/backend.css?v=1.0.0') ?>">
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <div class="iq-sidebar  sidebar-default  ">
            <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
                <a href="../backend/index.html" class="header-logo">
                    <img src="<?= base_url('admin/images/logopolres.png') ?>" class="img-fluid rounded-normal light-logo" alt="logo">
                    <img src="<?= base_url('admin/images/logopolres.png') ?>" class="img-fluid rounded-normal d-none sidebar-light-img"
                        alt="logo">
                    <span>Datum</span>
                </a>
                <div class="side-menu-bt-sidebar-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <?= $this->include('layout/components/sidebar') ?>
        </div>
        <?= $this->include('layout/components/navbar') ?>
        <div class="content-page">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->
   <?= $this->include('layout/components/footer') ?>
    <script src="<?= base_url('admin/js/backend-bundle.min.js') ?>"></script>
    <!-- Chart Custom JavaScript -->
    <script src="<?= base_url('admin/js/customizer.js') ?>"></script>

    <script src="<?= base_url('admin/js/sidebar.js') ?>"></script>

    <!-- Flextree Javascript-->
    <script src="<?= base_url('admin/js/flex-tree.min.js') ?>"></script>
    <script src="<?= base_url('admin/js/tree.js') ?>"></script>

    <!-- Table Treeview JavaScript -->
    <script src="<?= base_url('admin/js/table-treeview.js') ?>"></script>

    <!-- SweetAlert JavaScript -->
    <script src="<?= base_url('admin/js/sweetalert.js') ?>"></script>


    <!-- slider JavaScript -->
    <script src="<?= base_url('admin/js/slider.js') ?>"></script>

    <!-- app JavaScript -->
    <script src="<?= base_url('admin/js/app.js') ?>"></script>
</body>

</html>
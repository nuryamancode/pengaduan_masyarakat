<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />

    <title>Guarder</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.css') ?>" />

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet" />
    <!-- responsive style -->
    <link href="<?= base_url('assets/css/responsive.css') ?>" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <div class="hero_bg_box">
            <div class="img-box">
                <img src="<?= base_url('assets/images/hero.jpg') ?>" alt="" />
            </div>
        </div>

        <header class="header_section">
            <div class="header_top">
                <div class="container-fluid">
                    <div class="contact_link-container">
                        <a class="navbar-brand" href="index.html">
                            <span> Guarder </span>
                        </a>
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span> Hani </span>
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item text-warning" href="#">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="container">
                            <h1 class="text-center">
                                Pengaduan Masyarakat
                            </h1>
                            <p class="text-center">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod magna aliqua. Ut enim ad minim veniam
                            </p>
                            <div class="text-center">
                                <a href="#pengaduan" class="btn btn-warning text-center"> Pengaduan </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>

    <!-- about section -->

    <section class="about_section layout_padding" id="pengaduan">
        <div class="container">
            <h1 class="text-center">Tambah Pengaduan Anda Di bawah.</h1>
            <form action="">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Keterangan Pengaduan</label>
                    <textarea class="form-control" style="height: 200px;" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Tambahkan Foto <small>(opsional)</small></label>
                    <input type="file" class="form-control-file rounded" id="exampleFormControlFile1"  style="border: 1px solid #000;">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </section>

    <!-- end about section -->

    <!-- info section -->
    <section class="info_section">
        <div class="container">
            <h1 class="text-center"></h1>
        </div>
    </section>

    <!-- end info_section -->

    <!-- footer section -->
    <footer class="container-fluid footer_section">
        <p>
            &copy; <span id="currentYear"></span> All Rights Reserved. Design by
            <a href="https://html.design/">Free Html Templates</a> Distribution by
            <a href="https://themewagon.com">ThemeWagon</a>
        </p>
    </footer>
    <!-- footer section -->

    <script src="<?= base_url('assets/js/bootstrap.js') ?>"></script>
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/custom.js') ?>"></script>
</body>

</html>
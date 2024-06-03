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
                                <a href="#" class="btn btn-warning text-center" data-toggle="modal"
                                    data-target="#exampleModal"> Pengaduan </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>

    <!-- about section -->

    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 px-0">
                    <div class="img_container">
                        <div class="img-box">
                            <img src="<?= base_url('assets/images/about-img.jpg') ?>" alt="" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>Who Are We?</h2>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Dropdown link
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                            enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                            in reprehenderit in voluptate velit
                        </p>
                        <div class="btn-box">
                            <a href=""> Read More </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- end about section -->

    <!-- info section -->
    <section class="info_section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="info_logo">
                        <a class="navbar-brand" href="index.html">
                            <span> Guarder </span>
                        </a>
                        <p>
                            dolor sit amet, consectetur magna aliqua. Ut enim ad minim
                            veniam, quisdotempor incididunt r
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_links">
                        <h5>Useful Link</h5>
                        <ul>
                            <li>
                                <a href=""> dolor sit amet, consectetur </a>
                            </li>
                            <li>
                                <a href=""> magna aliqua. Ut enim ad </a>
                            </li>
                            <li>
                                <a href=""> minim veniam, </a>
                            </li>
                            <li>
                                <a href=""> quisdotempor incididunt r </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_info">
                        <h5>Contact Us</h5>
                    </div>
                    <div class="info_contact">
                        <a href="" class="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span> Lorem ipsum dolor sit amet, </span>
                        </a>
                        <a href="" class="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            <span> Call : +01 1234567890 </span>
                        </a>
                        <a href="" class="">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                            <span> demo@gmail.com </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="info_form">
                        <h5>Newsletter</h5>
                        <form action="#">
                            <input type="email" placeholder="Enter your email" />
                            <button>Subscribe</button>
                        </form>
                        <div class="social_box">
                            <a href="">
                                <i class="fa fa-facebook" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a href="">
                                <i class="fa fa-instagram" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
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
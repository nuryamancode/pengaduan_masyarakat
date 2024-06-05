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
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->

    <!-- fonts style -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,600,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
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
                            <span>
                                <?= $user['nama'] ?>
                            </span>
                        </a>
                        <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item text-warning" href="<?= base_url('logout') ?>">Logout</a>
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
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Tambah Pengaduan Anda Di bawah.</h1>
                    <form action="<?= base_url('/pengaduan') ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Keterangan Pengaduan</label>
                            <textarea class="form-control" name="deskripsi" style="height: 200px;"
                                id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Tambahkan Foto <small>(opsional)</small></label>
                            <input type="file" name="foto" class="form-control-file rounded"
                                id="exampleFormControlFile1" style="border: 1px solid #000;">

                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="mb-3">Data Pengaduan</h2>
                    <div class="form-group">
                        <label for="bulanFilter">Filter Bulan:</label>
                        <select id="bulanFilter" class="form-control">
                            <option value="">Semua Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <!-- Tambahkan opsi untuk bulan-bulan lainnya -->
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <table id="pengaduan_table" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Lorem ipsum dolor sit amet</td>
                                <td><img src="path/to/image.jpg" alt="Foto Pengaduan"></td>
                                <td><button class="btn btn-danger">Hapus</button></td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
    <script>
        $(document).ready(function () {
            $('#pengaduan_table').DataTable();
        });
    </script>
</body>

</html>
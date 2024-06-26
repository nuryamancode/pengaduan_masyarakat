<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">

<div class="row">
    <div class="col-md-12 mb-4 mt-1">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h4 class="font-weight-bold">Overview</h4>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6>Kelola User</h6>
            </div>
            <div class="card-body">
                <table id="data_latih_table" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tempat</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $key => $item) { ?>
                            <tr>
                                <td scope="row">
                                    <?= $key+1 ?>
                                </td>
                                <td class="no-wrap">
                                    <?= $item['nama'] ?>
                                </td>
                                <td>
                                    <?= $item['email'] ?>
                                </td>
                                <td>
                                    <?= $item['tempat'] ?>
                                </td>
                                <td class="text-center">
                                    <?php if (empty($item['tgl_lahir'])) { ?>
                                        -
                                    <?php } else {
                                        $tgl_lahir = $item['tgl_lahir'];
                                        $tanggal = date("d F Y", strtotime($tgl_lahir));
                                        $bulanInggris = array(
                                            'January' => 'Januari',
                                            'February' => 'Februari',
                                            'March' => 'Maret',
                                            'April' => 'April',
                                            'May' => 'Mei',
                                            'June' => 'Juni',
                                            'July' => 'Juli',
                                            'August' => 'Agustus',
                                            'September' => 'September',
                                            'October' => 'Oktober',
                                            'November' => 'November',
                                            'December' => 'Desember'
                                        );

                                        $tanggal = str_replace(array_keys($bulanInggris), array_values($bulanInggris), $tanggal);

                                        echo $tanggal;
                                    } ?>
                                </td>
                                <td>
                                    <?= $item['jenis_kelamin'] ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning mb-2" data-target="#edit<?= $item['id'] ?>"
                                        data-toggle="modal"><i class="bi bi-pencil-square"></i></button>
                                    <form action="<?= base_url('/kelola-user/delete/' . $item['id']) ?>" method="post">
                                        <button class="btn btn-danger" type="submit"><i class="bi bi-trash3-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($data as $items) { ?>
    <!-- Modal Edit -->
    <div class="modal fade" id="edit<?= $items['id'] ?>" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Edit Data User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('kelola-user/' . $items['id']) ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="name" name="nama" class="form-control" id="nama" value="<?= $items['nama'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?= $items['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="tempat">Tempat</label>
                            <input type="text" name="tempat" class="form-control" id="tempat"
                                value="<?= $items['tempat'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir"
                                value="<?= $items['tgl_lahir'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    id="laki-laki<?= $items['id'] ?>" value="laki-laki"
                                    <?= ($items['jenis_kelamin'] == 'laki-laki') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="laki-laki<?= $items['id'] ?>">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                    id="perempuan<?= $items['id'] ?>" value="perempuan"
                                    <?= ($items['jenis_kelamin'] == 'perempuan') ? 'checked' : '' ?>>
                                <label class="form-check-label" for="perempuan<?= $items['id'] ?>">Perempuan</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function () {
        $('#data_latih_table').DataTable();
    });
</script>
<?= $this->endSection() ?>
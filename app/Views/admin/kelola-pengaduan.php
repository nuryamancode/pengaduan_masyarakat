<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css">

<style>
    .nowrap {
        white-space: nowrap;
    }

    .img-thumbnail {
        max-width: 100px;
        height: auto;
    }
</style>

<div class="row">
    <div class="col-md-12 mb-4 mt-1">
        <div class="d-flex flex-wrap justify-content-between align-items-center">
            <h4 class="font-weight-bold">Overview</h4>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h6>Kelola Pengaduan</h6>
            </div>
            <div class="card-body">
                <table id="kelola_pengaduan" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pengadu</th>
                            <th scope="col">Keterangan Pengaduan</th>
                            <th scope="col">Nilai BM25</th>
                            <th scope="col">Klasifikasi Kasus</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        use App\Models\DataUji;
                        use App\Models\User;

                        if (!empty($data) && is_array($data)) {
                            foreach ($data as $key => $item) {
                                $userModel = new User();
                                $dataUjiModel = new DataUji();
                                $user = $userModel->find($item['id_user']) ?? [];
                                $data_uji = $dataUjiModel->where('id_pengaduan', $item['id'])->first() ?? [];
                                $foto = base_url('pengaduan-image/' . ($item['foto'] ?? 'default.jpg'));
                                ?>
                                <tr>
                                    <td scope="row"><?= $key + 1 ?></td>
                                    <td class="nowrap"><?= isset($user['nama']) ? $user['nama'] : 'Pengadu Tidak Diketahui' ?>
                                    </td>
                                    <td><?= $item['data_mentah'] ?></td>
                                    <td><?= $data_uji['nilai'] ?? 'N/A' ?></td>
                                    <td><?= $data_uji['kategori'] ?? 'Kategori Lainnya' ?></td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#lihatFoto<?= $item['id'] ?>"
                                            class="btn btn-primary" data-title="Foto Pengaduan">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                    </td>
                                    <td>
                                        <?php if ($item['status'] == 'Menunggu Konfirmasi') { ?>
                                            <form action="<?= base_url('/kelola-pengaduan/accept/' . $item['id']) ?>" method="post"
                                                class="d-inline terima-form">
                                                <button type="button" class="btn btn-success terima-btn mt-2">
                                                    <i class="bi bi-check2"></i>
                                                </button>
                                            </form>
                                            <form action="<?= base_url('/kelola-pengaduan/reject/' . $item['id']) ?>" method="post"
                                                class="d-inline tolak-form">
                                                <button type="button" class="btn btn-danger tolak-btn mt-2">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </form>
                                        <?php } ?>
                                        <form action="<?= base_url('/kelola-pengaduan/delete/' . $item['id']) ?>" method="post"
                                            class="d-inline delete-form">
                                            <button type="button"
                                                class="btn <?= ($item['status'] == 'Menunggu Konfirmasi') ? 'btn-secondary' : 'btn-danger' ?> delete-btn mt-2">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php foreach ($data as $items) { ?>
    <div class="modal fade" id="lihatFoto<?= $items['id'] ?>" tabindex="-1" aria-labelledby="lihatFotoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <h5 class="modal-title" id="lihatFotoLabel">Edit Data Latih</h5> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php 
                    if ($items['foto'] != null) {
                        ?>
                        <img src="<?= base_url('pengaduan-image/' . $items['foto']) ?>" alt="Foto Pengaduan"
                            width="100%">
                        <?php
                    } else {
                        echo "Tidak ada Foto";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#kelola_pengaduan').DataTable();

        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                title: '<?= session()->getFlashdata('message_type') === 'success' ? "Sukses!" : "Error!" ?>',
                text: '<?= session()->getFlashdata('message') ?>',
                icon: '<?= session()->getFlashdata('message_type') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>

        $('.delete-btn').on('click', function () {
            var form = $(this).closest('form');

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.terima-btn').on('click', function () {
            var form = $(this).closest('form');

            Swal.fire({
                title: 'Anda yakin?',
                text: "Pengaduan ini dapat diterima?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, terima!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.tolak-btn').on('click', function () {
            var form = $(this).closest('form');

            Swal.fire({
                title: 'Anda yakin?',
                text: "Pengaduan ini akan ditolak?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    });
</script>
<?= $this->endSection() ?>
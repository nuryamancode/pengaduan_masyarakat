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
                <h6>Data Latih</h6>
            </div>
            <div class="card-body">
                <div class="text-right mb-3">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahData"><i
                            class="bi bi-plus-circle-fill"></i></a>
                </div>
                <table id="data_latih_table" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Data Latih</th>
                            <th scope="col">Nilai</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $key => $item) { ?>
                            <tr>
                                <td scope="row"><?= $key + 1 ?></td>
                                <td class="no-wrap"><?= $item['data_mentah'] ?></td>
                                <td><?= $item['nilai'] ?></td>
                                <td><?= $item['kategori'] ?></td>
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#editData<?= $item['id'] ?>"
                                        data-id="<?= $item['id'] ?>" data-data_mentah="<?= $item['data_mentah'] ?>"
                                        data-nilai="<?= $item['nilai'] ?>" data-kategori="<?= $item['kategori'] ?>">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="<?= base_url('/data-latih/delete/' . $item['id']) ?>" method="post"
                                        class="d-inline delete-form">
                                        <button type="button" class="btn btn-danger delete-btn mt-2">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
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

<div class="modal fade" id="tambahData" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataLabel">Tambah Data Latih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/data-latih') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="deskripsi">Data Latih <small>(berikan kalimat atau teks)</small></label>
                        <textarea class="form-control" name="deskripsi" style="height: 100px; border: 1px solid #000;"
                            id="deskripsi" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="custom-select" name="kategori" id="kategori" style="border: 1px solid #000;">
                            <option selected>-- Pilih Kategori --</option>
                            <option value="Kekerasan">Kekerasan</option>
                            <option value="Penipuan">Penipuan</option>
                            <option value="Pencurian">Pencurian</option>
                        </select>
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

<?php foreach ($data as $items) { ?>
    <div class="modal fade" id="editData<?= $items['id'] ?>" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDataLabel">Edit Data Latih</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('/data-latih/update/' . $items['id']) ?>" method="post">
                    <input type="hidden" name="id" value="<?= $items['id'] ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deskripsi">Data Latih <small>(berikan kalimat atau teks)</small></label>
                            <textarea class="form-control" name="deskripsi" style="height: 100px; border: 1px solid #000;"
                                id="deskripsi" rows="3" required><?= $items['data_mentah'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit_kategori">Kategori</label>
                            <select class="custom-select" name="kategori" id="edit_kategori" style="border: 1px solid #000;">
                                <option value="" disabled>-- Pilih Kategori --</option>
                                <option value="Kekerasan" <?= $items['kategori'] === 'Kekerasan' ? 'selected' : '' ?>>Kekerasan</option>
                                <option value="Penipuan" <?= $items['kategori'] === 'Penipuan' ? 'selected' : '' ?>>Penipuan</option>
                                <option value="Pencurian" <?= $items['kategori'] === 'Pencurian' ? 'selected' : '' ?>>Pencurian</option>
                            </select>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#data_latih_table').DataTable();

        // SweetAlert for form submission based on session flash data
        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                title: '<?= session()->getFlashdata('message_type') === 'success' ? "Sukses!" : "Error!" ?>',
                text: '<?= session()->getFlashdata('message') ?>',
                icon: '<?= session()->getFlashdata('message_type') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>


        // SweetAlert for delete confirmation
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
    });
</script>

<?= $this->endSection() ?>
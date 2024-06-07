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
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahData"><i class="bi bi-plus-circle-fill"></i></a>
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
                        <?php
                        foreach ($data as $key => $item) { ?>
                            <tr>
                                <th scope="row">
                                    <?= $key + 1 ?>
                                </th>
                                <td class="no-wrap">
                                    <?= $item->data_mentah ?>
                                </td>
                                <td>
                                    <?= $item->nilai ?>
                                </td>
                                <td>
                                    <?= $item->kategori ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger">
                                    <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="btn btn-danger">
                                    <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php }
                        ?>
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
                        <label for="exampleFormControlTextarea1">Data Latih <small>(berikan kalimat atau
                                teks)</small></label>
                        <textarea class="form-control" name="deskripsi" style="height: 100px; border: 1px solid #000;"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Kategori</label>
                        <select class="custom-select" name="kategori" id="exampleFormControlTextarea1"
                            style="border: 1px solid #000;">
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
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataLabel">Tambah Data Latih</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/data-latih') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Data Latih <small>(berikan kalimat atau
                                teks)</small></label>
                        <textarea class="form-control" name="deskripsi" style="height: 100px; border: 1px solid #000;"
                            id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Kategori</label>
                        <select class="custom-select" name="kategori" id="exampleFormControlTextarea1"
                            style="border: 1px solid #000;">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#data_latih_table').DataTable();

        // Menambahkan sweet alert setelah formulir berhasil disubmit
        $('form').submit(function (event) {
            event.preventDefault(); // Mencegah formulir dikirim secara default
            
            var form = $(this);
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    // Tampilkan sweet alert setelah berhasil menambahkan data
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil ditambahkan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Muat ulang halaman setelah menekan OK
                        }
                    });
                },
                error: function (xhr, status, error) {
                    // Tampilkan sweet alert jika terjadi kesalahan
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menambahkan data.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>
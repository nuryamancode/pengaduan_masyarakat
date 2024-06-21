<?= $this->extend('layout/base-polisi') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css">
<style>
    .nowrap {
        white-space: nowrap;
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
                <h6>Kelola Tindakan</h6>
            </div>
            <div class="card-body">
                <table id="data_latih_table" class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pengadu</th>
                            <th scope="col">Nama Polisi</th>
                            <th scope="col">Keterangan Pengadu</th>
                            <th scope="col">Status Pengaduan</th>
                            <th scope="col">Keterangan Tindakan</th>
                            <th scope="col">Lampiran Tindakan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        use App\Models\PengaduanModel;
                        use App\Models\User;
                        foreach ($data as $key => $item) {
                            $pengaduan = new PengaduanModel();
                            $usermodel = new User();
                            $data_pengaduan = $pengaduan->find($item['id_pengaduan']);
                            $pengadu = $usermodel->find($data_pengaduan['id_user']);
                            $user = $usermodel->find($item['id_user']);
                            ?>
                            <tr>
                                <td scope="row"><?= $key + 1 ?></td>
                                <td class="nowrap">
                                    <?= isset($pengadu['nama']) ? $pengadu['nama'] : 'Pengadu tidak ditemukan' ?>
                                </td>
                                <td class="nowrap"><?= isset($user['nama']) ? $user['nama'] : 'Belum ada tindakan' ?>
                                <td><?= $data_pengaduan['data_mentah'] ?></td>
                                <td><?= $data_pengaduan['status'] ?></td>
                                <td><?= isset($item['keterangan']) ? $item['keterangan'] : 'Belum ada tindakan' ?>
                                <td>
                                    <?php if (isset($item['lampiran']) && !empty($item['lampiran'])): ?>
                                        <?php
                                        $fileExtension = pathinfo($item['lampiran'], PATHINFO_EXTENSION);
                                        $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                        $allowedDocumentExtensions = ['pdf', 'doc', 'docx'];
                                        if (in_array($fileExtension, $allowedImageExtensions)) {
                                            echo '<img src="' . base_url('lampiran-tindakan/' . $item['lampiran']) . '" width="100" height="100">';
                                        } elseif (in_array($fileExtension, $allowedDocumentExtensions)) {
                                            echo '<a href="' . site_url('download-file/' . $item['lampiran']) . '" class="btn btn-success">' . 'Download' . '</a>';
                                        } else {
                                            echo $item['lampiran'];
                                        }
                                        ?>
                                    <?php else: ?>
                                        Tidak ada lampiran
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($data_pengaduan['status'] == 'Sedang Ditinjau') { ?>
                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detail<?= $item['id'] ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    <?php } else { ?>
                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                            data-target="#detaile<?= $item['id'] ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    <?php } ?>
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
    <div class="modal fade" id="detail<?= $items['id'] ?>" tabindex="-1" aria-labelledby="tambahDataLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Aksi Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('tindakan/update/' . $items['id']) ?>" method="post"
                    enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" style="height: 100px; border: 1px solid #000;"
                                id="keterangan" rows="3" placeholder="Tambahkan keterangan" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Tambahkan Lampiran <small>(opsional)</small></label>
                            <input type="file" name="lampiran" class="form-control-file rounded"
                                id="exampleFormControlFile1" style="border: 1px solid #000;">
                        </div>
                        <div class="form-group">
                            <label for="tindakan">Tindakan</label>
                            <select class="custom-select" required name="tindakan" id="tindakan" style="border: 1px solid #000;">
                                <option value="" disabled selected>-- Pilih Tindakan --</option>
                                <option value="Tindak Langsung">Tindak Langsung
                                </option>
                                <option value="Tindakan Penyelidikan">Tindakan Penyelidikan
                                </option>
                                <option value="Lainnya">Lainnya
                                </option>
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


<?php foreach ($data as $items) {?>
    <div class="modal fade" id="detaile<?= $items['id'] ?>" tabindex="-1" aria-labelledby="tambahDataLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahDataLabel">Detail Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control" name="keterangan" style="height: 100px; border: 1px solid #000;"
                            id="keterangan" rows="3" readonly><?= $items['keterangan'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Status</label>
                        <input type="text" readonly class="form-control" id="keterangan"
                            value="<?= $data_pengaduan['status'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Lampiran : </label>
                        <span>
                            <?php if (isset($items['lampiran']) && !empty($items['lampiran'])): ?>
                                <?php
                                $fileExtension = pathinfo($items['lampiran'], PATHINFO_EXTENSION);
                                $allowedImageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                                $allowedDocumentExtensions = ['pdf', 'doc', 'docx'];
                                if (in_array($fileExtension, $allowedImageExtensions)) {
                                    echo '<img src="' . base_url('lampiran-tindakan/' . $items['lampiran']) . '" width="100" height="100">';
                                } elseif (in_array($fileExtension, $allowedDocumentExtensions)) {
                                    echo '<a href="' . site_url('download-file/' . $items['lampiran']) . '" class="btn btn-success">' . 'Download' . '</a>';
                                } else {
                                    echo $items['lampiran'];
                                }
                                ?>
                            <?php else: ?>
                                Tidak ada lampiran
                            <?php endif; ?>
                        </span>
                    </div>
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
        $('#data_latih_table').DataTable({
            "scrollX": true
        });

        <?php if (session()->getFlashdata('message')): ?>
            Swal.fire({
                title: '<?= session()->getFlashdata('message_type') === 'success' ? "Sukses!" : "Error!" ?>',
                text: '<?= session()->getFlashdata('message') ?>',
                icon: '<?= session()->getFlashdata('message_type') ?>',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>
<?= $this->endSection() ?>
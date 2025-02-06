<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>
<style>
    .nowrap {
        white-space: nowrap;
    }
</style>
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
                <h6>Data AKurasi</h6>
            </div>
            <div class="card-body">
                <table id="data_latih_table" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Akurasi</td>
                            <td><?= $data['accuracy'] ?></td>
                        </tr>
                        <tr>
                            <td>Presisi</td>
                            <td><?= $data['precision'] ?></td>
                        </tr>
                        <tr>
                            <td>Recall</td>
                            <td><?= $data['recall'] ?></td>
                        </tr>
                        <tr>
                            <td>F1 Score</td>
                            <td><?= $data['f1_score'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?= $this->endSection() ?>
<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="col-sm p-2">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Daftar <?= $subtitle ?> Pelanggan</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="tbl_antrian">
                <thead>
                    <tr>
                        <th width="100px">Nomor Antrian</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total Transaksi</th>
                        <th width="150px"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center text-bold fs-5">1</td>
                        <td>Addf</td>
                        <td><?= date('Y-m-d'); ?></td>
                        <td>Rp<? php; ?>,00</td>
                        <td>
                            <button class="btn btn-sm btn-flat p-0" data-bs-toggle="tooltip" data-bs-title="Melihat detail transaksi" onclick="window.location.href = '<?= base_url('antrian/') ?>'">
                                <div class=" font-weight-bold text-green h6"><i class="fas fa-angles-right fa-2x"></i>
                                </div>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
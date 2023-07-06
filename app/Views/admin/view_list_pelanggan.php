<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="col-sm p-2">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Daftar <?= $subtitle ?> Pelanggan</h3>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="tbl_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th width="150px">Nomor Antrian</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total Transaksi</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($transaksi as $value) { ?>
                        <?php if (!is_null($value['id_antrian'])) {
                            if ($value['status_antrian'] == "Selesai") { ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td class="text-bold fs-5"><i class="fa-solid fa-user-clock"></i>&emsp;<?= $value['no_antrian'] ?></td>
                                    <td><?php if (is_null($value['id_antrian'])) {
                                            echo '<i>Pelanggan Offline</i>';
                                        } else {
                                            echo (is_null($value['id_user']) ? '<i>Pelanggan Offline</i>' : $value['nama']);
                                        } ?></td>
                                    <td><?= date('Y-m-d H:i:s', strtotime($value['tanggal_transaksi'])); ?></td>
                                    <td id="uang<?= $no ?>">
                                        <script>
                                            setRupiah("#uang<?= $no ?>", "<?= $value['total_bayar'] ?>")
                                        </script>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-title="Melihat detail transaksi" onclick="window.location.href = '<?= base_url('antrian/detail_keranjang/' . $value['id_antrian']) ?>'">
                                            <i class="fas fa-th-list"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td class="text-bold fs-5"><i class="fa-solid fa-user-clock"></i>&emsp;-</td>
                                <td><?php if (is_null($value['id_antrian'])) {
                                        echo '<i>Pelanggan Offline</i>';
                                    } else {
                                        echo (is_null($value['id_user']) ? '<i>Pelanggan Offline</i>' : $value['nama']);
                                    } ?></td>
                                <td><?= date('Y-m-d', strtotime($value['tanggal_transaksi'])); ?></td>
                                <td id="uang<?= $no ?>">
                                    <script>
                                        setRupiah("#uang<?= $no ?>", "<?= $value['total_bayar'] ?>")
                                    </script>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-title="Melihat detail transaksi" onclick="window.location.href = '<?= base_url('beliitem/keranjang/' . $value['id_transaksi']) ?>'">
                                        <i class="fas fa-th-list"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function batal(id) {

    }
    $('#tbl_list').DataTable();
</script>

<?= $this->endSection() ?>
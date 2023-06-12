<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="col-sm p-2">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Daftar <?= $subtitle ?></h3>
            <!-- tombol aksi -->
            <div class="card-tools">
                <button class="btn btn-sm btn-warning" onclick="window.location.href='<?= base_url('antrian/tambah_antrian') ?>'">
                    <i class="fas fa-plus"></i> Antri Offline
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="tbl_antrian">
                <thead>
                    <tr>
                        <th width="70px">Nomor Antrian</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Status Antrian</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($antrian as $key => $value) { ?>
                        <tr>

                            <td class="text-center text-bold fs-5">
                                <?php if ($value['status_antrian'] != 'Selesai') : ?>
                                    <i class="fas fa-times text-danger" style="cursor: pointer;" onclick="konfirmasi('Apakah anda akan membatalkan antrian <?= $value['no_antrian'] ?>','<?= base_url('antrian/batal/' . $value['id_antrian']) ?>')"></i>
                                <?php endif ?>
                                <?= $value['no_antrian'] ?>
                            </td>
                            <td><?= (empty($value['nama'])) ? '<i>Pelanggan Offline</i>' : $value['nama'] ?></td>
                            <td><?= $value['tgl_antrian'] ?></td>
                            <td><?= $value['status_antrian'] ?></td>
                            <td class="text-center">
                                <?php if ($value['status_antrian'] == 'Menunggu') : ?>
                                    <form action="<?= base_url('antrian/ubah_status_antrian') ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="id_antrian" value="<?= $value['id_antrian'] ?>" class="d-none">
                                        <button type="submit" class="btn btn-sm btn-flat btn-success">Melayani</button>
                                    </form>
                                <?php endif ?>
                                <?php if ($value['status_antrian'] == 'Diproses') : ?>
                                    <button type="submit" class="btn btn-sm btn-flat btn-success" onclick="window.location.href = '<?= base_url('antrian/detail_keranjang') ?>/<?= $value['id_antrian'] ?>'">Selesai</button>
                                <?php endif ?>

                                <form class="d-inline" action="<?= base_url('antrian/detail_keranjang/' . $value['id_antrian']) ?>">
                                    <button class="btn btn-sm btn-flat btn-primary">
                                        <i class="fas fa-eye"></i>
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

<script>
    function batal(id) {

    }
    $('#tbl_antrian').DataTable();
</script>

<?= $this->endSection() ?>
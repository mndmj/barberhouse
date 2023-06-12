<?= $this->extend('template/t_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm-5 ms-auto">
        <div class="card card-dark">
            <h5 class="card-header">Data Antrian</h5>
            <div class="card-body">
                <table>
                    <tr>
                        <td>Nomor Antrian</td>
                        <td class="px-3">:</td>
                        <td><?= $antrian['no_antrian'] ?></td>
                    </tr>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td class="px-3">:</td>
                        <td><?= (!empty($antrian['nama'])) ? $antrian['nama'] : '<i>Pelanggan Offline</i>' ?></td>
                    </tr>
                    <tr>
                        <td>Nama Barbershop</td>
                        <td class="px-3">:</td>
                        <td><?= $bb['nama_bb'] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td class="px-3">:</td>
                        <td><?= date('d-m-Y') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5 me-auto">
        <div class="card card-dark">
            <h5 class="card-header">Daftar Menu</h5>
            <div class="card-body">
                <label>Daftar Menu</label>
                <form action="<?= base_url('antrian/tambah_keranjang') ?>" method="post" class="d-flex">
                    <select class="form-select mb-3" id="" name="pilih_menu" <?= ($antrian['status_antrian'] == 'Selesai') ? 'disabled readonly' : '' ?>>
                        <option selected>Pilih Menu</option>
                        <?php if ($antrian['status_antrian'] != 'Selesai') : ?>
                            <?php foreach ($menu as $value) { ?>
                                <option value="<?= $value['id_menu'] ?>"><?= $value['nama_menu'] ?></option>
                            <?php } ?>
                        <?php endif ?>
                    </select>
                    <div class="input-group ms-3" style="width: 200px;">
                        <input class="form-control" type="number" min="1" placeholder="Jumlah" name="jumlah_dt" <?= ($antrian['status_antrian'] == 'Selesai') ? 'disabled readonly' : '' ?>>
                        <button class="btn btn-primary <?= ($antrian['status_antrian'] == 'Selesai') ? 'disabled' : '' ?>" style="height:fit-content" <?= ($antrian['status_antrian'] == 'Selesai') ? 'disabled readonly' : '' ?>>
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-10 mx-auto">
        <div class="card card-dark">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5>Daftar Belanja Tambahan</h5>
                    </div>
                    <div class="col-6">
                        <div class="float-right bg-danger p-2 rounded">
                            <h6 class="m-0 p-0">Total Transaksi = Rp. <span id="totalBayar"></span></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm" id="keranjang">
                    <thead>
                        <tr>
                            <th width="70px">#</th>
                            <th>Nama Menu</th>
                            <th>Harga Menu</th>
                            <th>Jumlah</th>
                            <th>Sub-Total</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $total = 0;
                        foreach ($keranjang as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_menu'] ?></td>
                                <td><?= $value['harga_dt'] ?></td>
                                <td><?= $value['jumlah_dt'] ?></td>
                                <td><?= $value['harga_dt'] * $value['jumlah_dt'] ?></td>
                                <td>
                                    <?php if ($antrian['status_antrian'] != 'Selesai') : ?>
                                        <button class="btn btn-sm btn-flat btn-danger" onclick="window.location.href='<?= base_url('antrian/hapus_keranjang') ?>/<?= $value['id_dt'] ?>'">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php else : ?>
                                        -
                                    <?php endif ?>
                                </td>
                            </tr>
                            <?php
                            $total += $value['harga_dt'] * $value['jumlah_dt'];
                            ?>
                        <?php } ?>
                    </tbody>
                </table>
                <?php if ($antrian['status_antrian'] == 'Diproses') : ?>
                    <div class="d-flex">
                        <button class="col-sm-6 mt-3 mx-auto btn btn-primary" onclick="konfirmasi('Apakah Anda sudah yakin?','<?= base_url('antrian/selesai/' . $antrian['id_antrian']) ?>')">Selesai</button>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('#keranjang').DataTable({
        bPaginate: false,
        bInfo: false,
        bFilter: false
    });

    $(document).ready(function() {
        $("#totalBayar").html("<?= $total ?>")
    });
</script>

<?= $this->endSection(); ?>
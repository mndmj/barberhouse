<?= $this->extend('template/t_admin'); ?>
<?= $this->section('content'); ?>

<div class="row">
    <div class="col-sm-5 ms-auto">
        <div class="card card-dark">
            <h5 class="card-header">Data Antrian</h5>
            <div class="card-body pb-2">
                <table>
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td class="px-3">:</td>
                        <td><?= (!empty($antrian['nama'])) ? $antrian['nama'] : '<i>Pelanggan Offline</i>' ?></td>
                    </tr>
                    <tr>
                        <td>Nama Barbershop</td>
                        <td class="px-3">:</td>
                        <td><?= $dtBarber["nama_bb"] ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td class="px-3">:</td>
                        <td><?= ($isFinished) ? date("d-m-Y H:i:s", strtotime($dtTransaksi['tanggal_transaksi'])) : date('d-m-Y') ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5 me-auto">
        <div class="card card-dark">
            <h5 class="card-header">Daftar Menu</h5>
            <div class="card-body pb-0">
                <label>Daftar Menu</label>
                <?php if (!$isFinished) : ?>
                    <form action="<?= base_url('beliitem/additem') ?>" method="post" class="d-flex">
                    <?php else : ?>
                        <div class="d-flex">
                        <?php endif ?>
                        <select class="form-select mb-3" id="" name="pilih_menu" <?= ($isFinished) ? 'disabled' : '' ?>>
                            <option selected>Pilih Menu</option>
                            <?php if (!$isFinished) : ?>
                                <?php foreach ($dtMenu as $dt) : ?>
                                    <option value="<?= $dt['id_menu'] ?>"><?= $dt['nama_menu'] ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                        <div class="input-group ms-3" style="width: 200px;">
                            <input class="form-control <?= ($isFinished) ? 'disabled' : '' ?>" type="number" min="1" placeholder="Jumlah" name="jumlah_dt" <?= ($isFinished) ? 'disabled' : '' ?>>
                            <button class="btn btn-primary <?= ($isFinished) ? 'disabled' : '' ?>" style="height:fit-content" <?= ($isFinished) ? 'disabled' : '' ?>>
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <?php if (!$isFinished) : ?>
                    </form>
                <?php else : ?>
            </div>
        <?php endif ?>
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
                        <h5><?= $subtitle ?></h5>
                    </div>
                    <div class="col-6">
                        <div class="float-right bg-danger p-2 rounded">
                            <h6 class="m-0 p-0">Total Transaksi = Rp <span id="totalHarga"></span></h6>
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
                            <?php if (!$isFinished) : ?>
                                <th width="100px">Action</th>
                            <?php endif ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $totalHarga = 0;
                        foreach ($keranjang as $value) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama'] ?></td>
                                <td id="uang<?= $no ?>">
                                    <script>
                                        setRupiah("#uang<?= $no ?>", "<?= $value['harga'] ?>")
                                    </script>
                                </td>
                                <td><?= $value['jumlah_dt'] ?></td>
                                <td id="uang_sub<?= $no ?>">
                                    <script>
                                        setRupiah("#uang_sub<?= $no ?>", "<?= $value['jumlah_dt'] * $value['harga'] ?>")
                                    </script>
                                </td>
                                <?php if (!$isFinished) : ?>
                                    <td>
                                        <button class="btn btn-sm btn-flat btn-danger" onclick="window.location.href='<?= base_url('beliitem/deleteitem/' . $value['pilih_menu']) ?>'">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                <?php endif ?>
                            </tr>
                        <?php
                            $totalHarga += $value['jumlah_dt'] * $value['harga'];
                        endforeach
                        ?>
                    </tbody>
                </table>
                <?php if (!$isFinished) : ?>
                    <div class="d-flex mt-3">
                        <button class="col-sm-6 mt-3 mx-auto btn btn-primary <?= (!session('keranjangItem')) ? 'disabled' : '' ?>" onclick="window.location.href='<?= base_url('beliitem/finish/') ?>'" <?= (!session('keranjangItem')) ? 'disabled' : '' ?>>Selesai</button>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script>
    $('#keranjang').DataTable({});
    $('#keranjang_filter').empty();
    <?php if (!$isFinished) : ?>
        const dtMenu = <?= json_encode($dtMenu) ?>;
        let btn_add = $('<button class="btn btn-sm btn-danger"></button>');
        btn_add.html('Reset');
        btn_add.attr('onclick', 'window.location.href="<?= base_url('beliitem/reset') ?>"');
        $('#keranjang_filter').append(btn_add);
    <?php endif ?>
    $(document).ready(function() {
        $("#totalHarga").html('<?= $totalHarga ?>');
    });
</script>

<?= $this->endSection(); ?>
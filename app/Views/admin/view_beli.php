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
                        <td></td>
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
            <div class="card-body pb-0">
                <label>Daftar Menu</label>
                <form action="<?= base_url('beliitem/additem') ?>" method="post" class="d-flex">
                    <select class="form-select mb-3" id="" name="pilih_menu">
                        <option selected>Pilih Menu</option>
                        <?php foreach ($dtMenu as $dt) : ?>
                            <option value="<?= $dt['id_menu'] ?>"><?= $dt['nama_menu'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <div class="input-group ms-3" style="width: 200px;">
                        <input class="form-control" type="number" min="1" placeholder="Jumlah" name="jumlah_dt">
                        <button class="btn btn-primary" style="height:fit-content">
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
                            <th width="100px">Action</th>
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
                                <td>Rp <?= $value['harga'] ?></td>
                                <td><?= $value['jumlah_dt'] ?></td>
                                <td>Rp <?= $value['jumlah_dt'] * $value['harga'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-flat btn-danger" onclick="window.location.href='<?= base_url('beliitem/deleteitem/' . $value['pilih_menu']) ?>'">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                            $totalHarga += $value['jumlah_dt'] * $value['harga'];
                        endforeach
                        ?>
                    </tbody>
                </table>
                <div class="mt-3">
                    <button class="btn btn-primary <?= (!session('keranjangItem')) ? 'disabled' : '' ?>" onclick="window.location.href='<?= base_url('beliitem/finish/') ?>'" <?= (!session('keranjangItem')) ? 'disabled' : '' ?>>Selesai</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const dtMenu = <?= json_encode($dtMenu) ?>;
    $('#keranjang').DataTable({});
    $('#keranjang_filter').empty();
    let btn_add = $('<button class="btn btn-sm btn-danger"></button>');
    btn_add.html('Reset');
    btn_add.attr('onclick', 'window.location.href="<?= base_url('beliitem/reset') ?>"');
    $('#keranjang_filter').append(btn_add);
    $(document).ready(function() {
        $("#totalHarga").html('<?= $totalHarga ?>');
    });
</script>

<?= $this->endSection(); ?>
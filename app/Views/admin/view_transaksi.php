<?= $this->extend('template/t_admin'); ?>
<?= $this->section('content'); ?>


<div class="row">
    <div class="col-sm-12">
        <div class="card card-dark">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5>Daftar Belanja Tambahan</h5>
                    </div>
                    <div class="col-6">
                        <div class="float-right bg-danger p-2 rounded">
                            <h6 class="m-0 p-0">Total Transaksi = </h6>
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
                        foreach ($keranjang as $value) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $value['nama_menu'] ?></td>
                                <td><?= $value['harga_dt'] ?></td>
                                <td><?= $value['jumlah_dt'] ?></td>
                                <td><?= $value['harga_dt'] * $value['jumlah_dt'] ?></td>
                                <td>
                                    <button class="btn btn-sm btn-flat btn-danger" data-bs-toggle="modal" data-bs-target="#delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Add Menu</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"><label>Daftar Menu</label>
                <form action="<?= base_url('') ?>" method="post" class="d-flex">
                    <select class="form-select mb-3" id="" name="pilih_menu" style="width: 300px;">
                        <option selected>Pilih Menu</option>
                        <?php  ?>
                        <option value=""></option>
                        <?php  ?>
                    </select>
                    <div class="input-group ms-1" style="width: 200px;">
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

<script>
    $('#keranjang').DataTable();
    $(document).ready(function() {
        $('#keranjang_filter').empty();
        let btn_add = $('<button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add"></button>').append('<i class="fas fa-plus"></i> Add');
        $('#keranjang_filter').append(btn_add);
    });
</script>

<?= $this->endSection(); ?>
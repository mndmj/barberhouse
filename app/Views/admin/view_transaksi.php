<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="col-sm p-2">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title"><?= $subtitle ?> Pelanggan</h3>
            <div class="card-tools" data-bs-toggle="tooltip" data-bs-title="Tambah Item" onclick="window.location.href = '<?= base_url('beliitem/keranjang') ?>'">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    <i class="fas fa-cart-plus"></i>&emsp;Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="tbl_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Total Item</th>
                        <th>Total Beli</th>
                        <th width="150px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><?= date('Y-m-d'); ?></td>
                        <td>0</td>
                        <td>Rp,00</td>
                        <td>
                            <button class="btn btn-sm btn-info h6">
                                <i class="fas fa-cart-shopping"></i>
                            </button>
                        </td>
                    </tr>
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
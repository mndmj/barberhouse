<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="col-sm p-2">
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title">Daftar <?= $subtitle ?></h3>
            <!-- tombol aksi -->
            <div class="card-tools">
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                    <i class="fas fa-plus"></i> Add
                </button>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-sm" id="tbl_menu">
                <thead>
                    <tr>
                        <th width="70px">#</th>
                        <th>Nama Menu</th>
                        <th>Jenis Menu</th>
                        <th>Harga Menu</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($menu as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['nama_menu'] ?></td>
                            <td><?= $value['jenis_menu'] ?></td>
                            <td id="uang<?= $no ?>">
                                <script>
                                    setRupiah("#uang<?= $no ?>", "<?= $value['harga_menu'] ?>")
                                </script>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $value['id_menu'] ?>">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $value['id_menu'] ?>">
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
            <?= form_open('menu/insertData') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Menu</label>
                    <input name="nama_menu" class="form-control" placeholder="Nama Menu" required>
                </div>
                <div class="form-group">
                    <label>Jenis Menu</label>
                    <select class="form-select" name="jenis_menu" aria-label="Default select example">
                        <option value="Haircut">Haircut</option>
                        <option value="Haircare">Haircare</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga Menu</label>
                    <input name="harga_menu" class="form-control" placeholder="Harga Menu" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal Edit -->
<?php foreach ($menu as $key => $value) { ?>
    <div class="modal fade" id="edit<?= $value['id_menu'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit Menu</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?= form_open('menu/editData/' . $value['id_menu']) ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Menu</label>
                        <input name="nama_menu" value="<?= $value['nama_menu'] ?>" class="form-control" placeholder="Nama Menu" required>
                        <label>Jenis Menu</label>
                        <select class="form-select" name="jenis_menu" value="<?= $value['jenis_menu'] ?>" aria-label="Default select example">
                            <option value="Haircut">Haircut</option>
                            <option value="Haircare">Haircare</option>
                            <option value="Lain-lain">Lain-lain</option>
                        </select>
                        <label>Harga Menu</label>
                        <input name="harga_menu" value="<?= $value['harga_menu'] ?>" class="form-control" placeholder="Harga Menu" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning btn-sm">Ubah</button>
                </div>
                <?= form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<!-- Modal Delete -->
<?php foreach ($menu as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_menu'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title">Hapus Menu</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda ingin menghapus data <b><?= $value['nama_menu'] ?></b>?
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <a href="<?= base_url('menu/deleteData/' . $value['id_menu']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>

<script>
    $('#tbl_menu').DataTable();
</script>

<?= $this->endSection() ?>
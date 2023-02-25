<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <!-- ubah logo -->
    <div class="col-sm-4">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Logo</h3>
            </div>

            <div class="card-body">
                <?php echo form_open_multipart('admin/savebb') ?>
                <div class="text-center">
                    <img id="gambar_load" class="img-fluid pad" src="<?= base_url('assets/images/logo_bhouse_non_bg_cut.png') ?>" width="250px" height="250px">
                </div>
                <div class="form-group mt-2">
                    <label>Ganti Logo</label>
                    <input id="preview_gambar" name="logo" type="file" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi barbershop</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama barbershop</label>
                            <input name="nama_bb" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input name="telepon" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat_bb" value="" class="form-control">
                        </div>
                        <!-- <div class="form-group">
                            <label>Kecamatan</label>
                            <input name="kecamatan" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Kab/Kota</label>
                            <input name="kabupaten" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input name="provinsi" value="" class="form-control">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Waktu operasional</h3>
            </div>
            <div class="card-body pt-0">
                <div class="form-group">
                    <label>Jam Buka</label>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#jamModal">
                        <i class="fa-solid fa-pen-nib"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group float-end">
            <button type="submit" class="btn btn-flat btn-primary">
                <i class="fas fa-save pr-1"></i>
            </button>
        </div>
    </div>
</div>

<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="jamModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-olive">
                    <h4 class="modal-title">Edit waktu</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning btn-sm">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endsection() ?>
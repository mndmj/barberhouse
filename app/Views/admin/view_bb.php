<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div class="row">
    <!-- ubah logo -->
    <div class="col-sm-4">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Logo</h3>
            </div>

            <div class="card-body p-0">
                <?= form_open_multipart('bb/updateInfo') ?>
                <?php if ($dtBB['foto_bb'] == '') { ?>
                    <div class="text-center">
                        <img id="gambar_load" class="img-fluid pad" src="<?= base_url('assets/images/barber/default_bb.jpg') ?>">
                    </div>
                <?php } else { ?>
                    <div class="text-center p-3">
                        <img id="gambar_load" class="img-fluid pad" src="<?= base_url('assets/images/barber/' . $dtBB['foto_bb']) ?>" width="300px">
                    </div>
                <?php } ?>
                <div class="form-group mt-2 mb-0">
                    <label for="foto" class="btn btn-warning btn-flat w-100 m-0 px-3 py-2">Ubah Logo</label>
                    <input id="foto" name="logo" type="file" class="form-control d-none" accept="image/*" onchange="bacaGambar(event)">
                </div>
                <?= form_close() ?>
            </div>
        </div>

        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Waktu operasional</h3>
                <button type="" class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#jamModal">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>
            <div class="card-body p-0">
                <div class="form-group row text-center m-0 p-0">
                    <div class="col-6 p-0 bg-green">
                        <label>Jam Buka</label>
                        <h4 class="text-bold">07.00</h4>
                    </div>

                    <div class="col-6 p-0 bg-red">
                        <label>Jam Tutup</label>
                        <h4 class="text-bold">19.00</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-8">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Informasi barbershop</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama barbershop</label>
                            <input name="nama_bb" value="<?= $dtBB['nama_bb'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" value="<?= $dtUser['email'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Telepon</label>
                            <input name="telepon" value="<?= $dtPemilik['telepon'] ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat_bb" value="<?= $dtBB['alamat_bb'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input name="latitude" value="<?= $dtBB['latitude'] ?>" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input name="longitude" value="<?= $dtBB['longitude'] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Tentang Barbershop</label>
                            <textarea name="ket_bb" class="form-control"><?= $dtBB['ket_bb'] ?></textarea>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="pe-1">Ubah Password</label>
                            <input type="checkbox" name="" id="" class="">
                            <input type="password" name="" value="" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 m-auto">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal-dialog modal-dialog-centered">
    <div class="modal fade" id="jamModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h4 class="modal-title">Edit waktu</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Jam buka</label>
                        <input type="time" name="jam_buka" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Jam tutup</label>
                        <input type="time" name="jam_buka" value="" class="form-control">
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

<script>
    function bacaGambar(input) {
        try {
            $('#gambar_load').attr('src', URL.createObjectURL(input.target.files[0]));
            // tampilPreview();
        } catch (error) {

        }
    }

    // function tampilPreview() {
    //     if ($('#foto').val() == '') {
    //         $('#gambar_load').addClass('d-none');
    //     } else {
    //         $('#gambar_load').removeClass('d-none');
    //     }
    // }

    // tampilPreview();

    $('#foto').change(function() {
        bacaGambar(this);
    });
</script>

<?= $this->endsection() ?>
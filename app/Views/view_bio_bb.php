<?= $this->extend('template/t_regis.php'); ?>
<?= $this->section('bio'); ?>
<div class="row g-0">
    <div class="col-6 d-flex position-relative">
        <div class="d-flex h-100 w-100 position-absolute rounded-depan" style="z-index: 10; background: rgba(0, 0, 0, 0.4);">
            <div class="m-auto px-5">
                <h2 class="mb-4">Halo, Pendatang Baru</h2>
                <p>Setelah membuat akun untuk melakukan login pada tahap sebelumnya, disini isikan kolom di samping ini dengan benar agar data yang masuk pada sistem adalah data nyata.</p>
            </div>
        </div>
        <div class="postion-absolute h-100 w-100 row g-0">
            <div class="col color-transparant rounded-depan"></div>
        </div>
    </div>

    <div class="col-6 card-body">
        <div class="p-5 text-dark">
            <h3 class="card-title text-bold mb-3 text-white">Registrasi Barbershop</h3>
            <form action="<?= base_url('register/savebb') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama_bb" class="form-label fw-bold text-white">Nama Barbershop</label><br>
                    <input type="text" class="form-control" name="nama_bb" id="nama_bb">
                </div>
                <div class="mb-3">
                    <label for="telepon_bb" class="form-label fw-bold text-white">Telp Barbershop</label><br>
                    <input type="text" class="form-control" name="telepon_bb" id="telepon_bb">
                </div>
                <div class="row">
                    <p class="fw-bold text-white">Titik Koordinat</p>
                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fw-bold text-white p-0 m-0">Foto Barbershop</label><br>
                    <small class="fst-italic fw-light">*Foto tampak depan</small>
                    <input class="form-control mt-1" type="file" name="foto_bb" id="foto" accept="image/*">
                </div>
                <div class="mb-3 gambar_load">
                    <!-- <label for="foto" class="form-label fw-bold">Preview</label><br> -->
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold text-white">Alamat</label>
                    <textarea class="form-control" name="alamat_bb" id="alamat_bb" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold text-white">Tentang Barbershop</label>
                    <textarea class="form-control" name="ket_bb" id="ket_bb" rows="3"></textarea>
                </div>
                <div class="d-grid gap-2 col mx-auto">
                    <button class="btn color-primary text-white btn-submit" type="submit">Simpan</button>
                    <a onclick="konfirmasi('Tidak ingin melanjutkan registrasi?','<?= base_url('register/cancel') ?>')" class="btn btn-danger center px-0">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
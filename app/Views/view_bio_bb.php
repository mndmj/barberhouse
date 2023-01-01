<?= $this->extend('template/t_regis.php'); ?>
<?= $this->section('bio'); ?>
<div class="row g-0">
    <div class="col-6 d-flex position-relative">
        <div class="d-flex h-100 w-100 position-absolute rounded-depan" style="z-index: 10; background: rgba(0, 0, 0, 0.4);">
            <div class="m-auto">
                <h3>Halo, Pendatang Baru</h3>
            </div>
        </div>
        <div class="postion-absolute h-100 w-100 row g-0">
            <div class="col-4 color-primary rounded-depan"></div>
            <div class="col-4 color-second"></div>
            <div class="col-4 color-third"></div>
        </div>
    </div>

    <div class="col-6 card-body">
        <div class="p-5 text-dark">
            <h3 class="card-title text-bold mb-3">Registrasi Barbershop</h3>

            <div class="mb-3">
                <input type="text" class="form-control" id="" placeholder="Nama Barbershop">
            </div>
            <div class="row">
                <p class="fw-bold">Titik Koordinat</p>
                <div class="col-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="" placeholder="Latitude">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="" placeholder="Longitude">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label fw-bold p-0 m-0">Foto Barbershop</label><br>
                <small class="fst-italic fw-light">*Foto tampak depan</small>
                <input class="form-control mt-1" type="file" id="foto" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label fw-bold">Preview</label><br>
                <img src="<?= base_url('assets/images/blank') ?>">
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label fw-bold">Alamat</label>
                <textarea class="form-control" id="alamat" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label fw-bold">Tentang Barbershop</label>
                <textarea class="form-control" id="alamat" rows="3"></textarea>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn color-primary text-white btn-submit" type="button">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
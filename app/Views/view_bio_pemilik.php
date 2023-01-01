<?= $this->extend('template/t_regis.php'); ?>
<?= $this->section('bio'); ?>
<div class="row g-0">
    <div class="col-6 d-flex position-relative">
        <div class="d-flex h-100 w-100 position-absolute" style="z-index: 10; background: rgba(0, 0, 0, 0.4);">
            <div class="m-auto">
                <h3>Halo, Pendatang Baru</h3>
            </div>
        </div>
        <div class="postion-absolute h-100 w-100 row g-0">
            <div class="col-4 color-primary rounded-start"></div>
            <div class="col-4 color-second"></div>
            <div class="col-4 color-third"></div>
        </div>
    </div>

    <div class="col-6 card-body">
        <div class="p-5 text-dark">
            <h3 class="card-title text-bold mb-3">Registrasi Biodata</h3>

            <form action="<?= base_url('register/savepemilik') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : '' ?>" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap">
                    <div id="nama_lengkapFeedback" class="invalid-feedback">
                        <small><?= $validation->getError('nama_lengkap') ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : '' ?>" name="telepon" id="telepon" placeholder="No.Telepon">
                    <div id="teleponFeedback" class="invalid-feedback">
                        <small><?= $validation->getError('telepon') ?></small>
                    </div>
                </div>
                <div class="mb-3">
                    <p class="fw-bold">Jenis Kelamin</p>
                    <div id="teleponFeedback" class="invalid-feedback">
                        <small><?= $validation->getError('jk') ?></small>
                    </div>
                    <div class="form-check form-check-inline <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                        <input class="form-check-input" type="radio" name="jk" value="Laki-laki" id="jk_laki">
                        <label class="form-check-label" for="jk_laki">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                        <input class="form-check-input" type="radio" name="jk" value="Perempuan" id="jk_perempuan">
                        <label class="form-check-label" for="jk_perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fw-bold">Foto</label>
                    <input class="form-control" type="file" name="foto" id="foto" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fw-bold">Preview</label><br>
                    <img src="<?= base_url('assets/images/blank.jpg') ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn color-primary text-white btn-submit" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
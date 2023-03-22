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
            <!-- <div class="col-4 color-primary rounded-depan"></div>
            <div class="col-4 color-second"></div>
            <div class="col-4 color-third"></div> -->
        </div>
    </div>

    <div class="col-6 card-body">
        <div class="p-5 text-dark">
            <h3 class="card-title text-bold mb-3 text-white">Registrasi Biodata</h3>

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
                    <p class="fw-bold text-white">Jenis Kelamin</p>
                    <div id="teleponFeedback" class="invalid-feedback">
                        <small><?= $validation->getError('jk') ?></small>
                    </div>
                    <div class="form-check form-check-inline <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                        <input class="form-check-input" type="radio" name="jk" value="Laki-laki" id="jk_laki">
                        <label class="form-check-label text-white" for="jk_laki">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline <?= ($validation->hasError('jk')) ? 'is-invalid' : '' ?>">
                        <input class="form-check-input" type="radio" name="jk" value="Perempuan" id="jk_perempuan">
                        <label class="form-check-label text-white" for="jk_perempuan">Perempuan</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fw-bold text-white">Foto</label>
                    <input class="form-control" type="file" name="foto" id="foto" accept="image/*" onchange="bacaGambar(event)" required>
                </div>
                <div class="mb-3">
                    <img src="" alt="" id="gambar_load" width="100px" height="100px" style="object-fit: contain;">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label fw-bold text-white">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
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
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
                            <input type="text" class="form-control disabled" name="latitude" id="txtlatitude" placeholder="Latitude" readonly>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <input type="text" class="form-control disabled" name="longitude" id="txtlongitude" placeholder="Longitude" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div id="map" style="height: 200px;"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label fw-bold text-white p-0 m-0">Foto Barbershop</label><br>
                    <small class="fst-italic text-danger">*Foto tampak depan</small>
                    <input class="form-control mt-1" type="file" name="foto_bb" id="foto" accept="image/*" onchange="bacaGambar(event)" required>
                </div>
                <div class="mb-3">
                    <img src="" alt="" id="gambar_load" width="100px" height="100px" style="object-fit: contain;">
                </div>
                <div class="mb-3">
                    <label for="alamat_bb" class="form-label fw-bold text-white">Alamat</label>
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

<!-- Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly" defer></script>
<script>
    let newLatLng = {
        lat: -7.594611098027863,
        lng: 110.93992829532729
    };

    function initMap() {
        const myLatLng = {
            lat: -7.594611098027863,
            lng: 110.93992829532729
        };

        <?php if (old('txtlatitude') && old('txtlongitude')) : ?>
            const newLocation = {
                lat: <?= old('txtlatitude') ?>,
                lng: <?= old('txtlongitude') ?>
            }
        <?php endif ?>

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 16,
            center: myLatLng,
        });

        <?php if (old('txtlatitude') && old('txtlongitude')) : ?>
            var infoWindow = new google.maps.InfoWindow({
                content: "Lokasi baru Barbershop Anda",
                position: newLocation,
            });
        <?php else : ?>
            var infoWindow = new google.maps.InfoWindow({
                content: "Pilih lokasi Barbershop baru",
                position: myLatLng,
            });
        <?php endif ?>

        new google.maps.Marker({
            position: myLatLng,
            map,
            title: 'Kabupaten Karanganyar',
        });

        infoWindow.open(map);
        // Configure the click listener.
        map.addListener("click", (mapsMouseEvent) => {
            // Close the current InfoWindow.
            infoWindow.close();
            // Create a new InfoWindow.
            infoWindow = new google.maps.InfoWindow({
                position: mapsMouseEvent.latLng,
            });
            infoWindow.setContent(
                JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
            );
            infoWindow.open(map);
            $("#txtlatitude").val(mapsMouseEvent.latLng.toJSON()['lat']);
            $("#txtlongitude").val(mapsMouseEvent.latLng.toJSON()['lng']);
            newLatLng.lat = mapsMouseEvent.latLng.toJSON()['lat'];
            newLatLng.lng = mapsMouseEvent.latLng.toJSON()['lng'];
        });
        $("#txtlatitude").val(myLatLng.lat);
        $("#txtlongitude").val(myLatLng.lng);
    }
    window.initMap = initMap;
</script>
<?= $this->endSection(); ?>
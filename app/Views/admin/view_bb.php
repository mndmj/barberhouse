<?= $this->extend('template/t_admin') ?>
<?= $this->section('content') ?>

<div id="formContainer">
    <div class="row" id="formContent">
        <!-- ubah logo -->
        <div class="col-sm-4">
            <div class="card card-dark">
                <div class="card-header">
                    <h3 class="card-title">Logo</h3>
                </div>

                <div class="card-body p-0">
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
                        <input id="foto" name="foto_bb" type="file" class="form-control d-none" accept="image/*" onchange="bacaGambar(event)">
                    </div>
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
                            <h4 class="text-bold"><?= date('H.i', strtotime($dtBB['jam_buka'])) ?> WIB</h4>
                        </div>

                        <div class="col-6 p-0 bg-red">
                            <label>Jam Tutup</label>
                            <h4 class="text-bold"><?= date('H.i', strtotime($dtBB['jam_tutup'])) ?> WIB</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card card-dark">
                <div class="card-header d-flex">
                    <h3 class="card-title">Informasi barbershop</h3>
                    <div class="ml-auto p-0">
                        <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
                        <label class="btn btn-outline-warning m-0 px-2 py-0" for="btn-check-outlined">Edit Data</label><br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama barbershop</label>
                                <input name="nama_bb" id="txtnama" value="<?= $dtBB['nama_bb'] ?>" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" id="txtemail" value="<?= $dtUser['email'] ?>" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Latitude</label>
                                <input name="latitude" id="txtlatitude" value="<?= $dtBB['latitude'] ?>" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input name="alamat_bb" id="txtalamat" value="<?= $dtBB['alamat_bb'] ?>" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Telepon</label>
                                <input name="telepon" id="txttelepon" value="<?= $dtBB['telepon_bb'] ?>" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label>Longitude</label>
                                <input name="longitude" id="txtlongitude" value="<?= $dtBB['longitude'] ?>" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tentang Barbershop</label>
                                <textarea name="ket_bb" id="txtket" class="form-control" rows="5" disabled><?= $dtBB['ket_bb'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card" id="cardChangeColor">
                                <div class="card-header">
                                    <div class="form-check form-switch text-bold">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchPW">
                                        <label class="form-check-label" for="switchPW">Klik untuk ubah username & password</label>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="form-group">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping"><i class="fa fa-tag"></i></span>
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $dtUser['username'] ?>" aria-label="Username" aria-describedby="addon-wrapping" placeholder="Username" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group flex-nowrap">
                                            <span class="input-group-text" id="addon-wrapping2"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" name="password" id="password" aria-label="Password" aria-describedby="addon-wrapping2" placeholder="Password" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6 m-auto">
                    <div class="form-group">
                        <button type="submit" id="btnSaveBB" class="btn btn-primary btn-block d-none">
                            Simpan Data
                        </button>
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
                                <input type="time" name="jam_tutup" value="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-warning btn-sm w-100" data-bs-dismiss="modal">Ubah</button>
                        </div>
                    </div>
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

    $("#btn-check-outlined").click(function() {
        $("#txtnama").removeAttr('disabled');
        $("#txtemail").removeAttr('disabled');
        $("#txttelepon").removeAttr('disabled');
        $("#txtalamat").removeAttr('disabled');
        $("#txtket").removeAttr('disabled');
        $("#btnSaveBB").removeClass('d-none');
        initMapsEdit();
    });

    $("#switchPW").click(function() {
        if (document.getElementById('switchPW').checked == true) {
            $("#username").removeAttr('disabled');
            $("#password").removeAttr('disabled');
            $("#cardChangeColor").addClass('card-dark');
        } else {
            $("#username").attr('disabled', '');
            $("#password").attr('disabled', '');
            $("#cardChangeColor").removeClass('card-dark');
        }
    });
</script>
<!-- Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6gqY4h363DppJBbXF1o8_4Y6t0hw3xVw&callback=initMap&v=weekly" defer></script>
<script>
    function initMap() {
        let myLatLng = {
            lat: <?= $dtBB['latitude'] ?>,
            lng: <?= $dtBB['longitude'] ?>
        };
        let map = new google.maps.Map(document.getElementById("map"), {
            zoom: 17,
            center: myLatLng,
        });
        new google.maps.Marker({
            position: myLatLng,
            map,
            title: "<?= $dtBB['nama_bb'] ?>",
        });
        $("#txtlatitude").val(myLatLng.lat);
        $("#txtlongitude").val(myLatLng.lng);
    }
    window.initMap = initMap;

    // var timepicker = new TimePicker('txtJam', {
    //     lang: 'en',
    //     theme: 'dark'
    // });
    // timepicker.on('change', function(evt) {
    //     var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    //     evt.element.value = value;
    // });
    let newLatLng = {
        lat: <?= $dtBB['latitude'] ?>,
        lng: <?= $dtBB['longitude'] ?>
    };

    function initMapsEdit() {
        const myLatLng = {
            lat: <?= $dtBB['latitude'] ?>,
            lng: <?= $dtBB['longitude'] ?>
        };

        <?php if (old('txtlatitude') && old('txtlongitude')) : ?>
            const newLocation = {
                lat: <?= old('txtlatitude') ?>,
                lng: <?= old('txtlongitude') ?>
            }
        <?php endif ?>

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 20,
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
            title: "<?= $dtBB['nama_bb'] ?>",
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

    $("#btnSaveBB").click(function() {
        (async () => {
            var {
                value: password
            } = await Swal.fire({
                title: 'Anda yakin ingin menyimpan informasi Barbershop baru?',
                input: 'password',
                confirmButtonText: 'Submit',
                confirmButtonColor: '#1C6758',
                inputLabel: 'Jika sudah yakin masukkan password Anda saat ini.',
                inputPlaceholder: 'Password',
                inputAttributes: {
                    autocapitalize: 'off',
                    autocorrect: 'off',
                    minlength: 8
                },
            });
            if (password) {
                let pw = $("<input type='hidden' name='passwordLama' value='" + password + "'>");
                let lat = $("<input type='hidden' name='latitude' value='" + newLatLng.lat + "'>");
                let lng = $("<input type='hidden' name='longitude' value='" + newLatLng.lng + "'>");
                var form = $("<form method='post' action='<?= base_url('bb/updateInfo') ?>' id='formEdit' enctype='multipart/form-data'></form>");
                // form.append();
                form.append(pw, lat, lng, $("#formContent"));
                $("#formContainer").append(form);
                form.submit();
            }
        })();
    });
</script>
<?= $this->endsection() ?>
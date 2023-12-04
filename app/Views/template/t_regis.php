<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barberhouse</title>

    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/logo bhouse.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?= base_url('assets/images/bg_biopemilik.jpg') ?>);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            color: #fff;
        }

        .card_sip {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            border: #fff 1px solid;
        }

        .rounded-depan {
            border-top-left-radius: 30px;
            border-bottom-left-radius: 30px;
        }

        .color-primary {
            background-color: #1C6758;
        }

        .color-second {
            background-color: #3D8361;
        }

        .color-third {
            background-color: #D6CDA4;
        }

        .color-transparant {
            background: rgba(255, 255, 255, 0.35);
        }

        .btn-submit:hover {
            background-color: #3D8361;
        }
    </style>

</head>

<body>
    <div class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card_sip m-3">
                        <?= $this->renderSection('bio'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        function bacaGambar(input) {
            // if (input.files && input.files[0]) {
            //     var reader = new FileReader();
            //     reader.onload = function(e) {
            //         $('#gambar_load').attr('src', e.target.result)
            //         // $('#gambar_load').html('<img class="w-100" src="' + e.target.result + '"></img>')
            //     }
            //     reader.readAsDataURL(input.files[0]);
            // }
            try {
                $('#gambar_load').attr('src', URL.createObjectURL(input.target.files[0]));
                tampilPreview();
            } catch (error) {

            }
        }

        function tampilPreview() {
            if ($('#foto').val() == '') {
                $('#gambar_load').addClass('d-none');
            } else {
                $('#gambar_load').removeClass('d-none');
            }
            // alert($('#foto').val());
        }

        tampilPreview();

        $('#foto').change(function() {
            bacaGambar(this);
        });
    </script>

    <?= $this->include('part/dialog_confirm'); ?>

</body>

</html>
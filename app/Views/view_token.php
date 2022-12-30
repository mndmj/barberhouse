<!DOCTYPE html>
<html lang="en">

<head>
    <title>Barberhouse</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700,900" rel="stylesheet">

    <!-- <link rel="stylesheet" href="assets/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/aos.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(218, 41%, 35%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(218, 41%, 45%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }
        </style>

        <div class="min-vh-100 min-vw-100 d-flex">
            <div class="container text-center text-lg-start d-flex">
                <div class="mx-5 my-auto">
                    <div class="row gx-lg-5 align-items-center mx-5">
                        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                            <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                                The best offer <br />
                                <span style="color: hsl(218, 81%, 75%)">for your business</span>
                            </h1>
                            <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                Temporibus, expedita iusto veniam atque, magni tempora mollitia
                                dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                                ab ipsum nisi dolorem modi. Quos?
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                            <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                            <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                            <div class="card bg-glass">
                                <div class="card-body px-4 py-5 px-md-5">
                                    <form method="post" action="<?= base_url('register/token') ?>">
                                        <div class="row">
                                            <label for="token" class="form-label">Token Validasi</label>
                                            <div class="input-group has-validation">
                                                <input type="text" class="form-control <?= ($validation->hasError('token') || session('peringatan')) ? 'is-invalid' : '' ?>" name="token" id="token" aria-describedby="inputGroupPrepend">
                                                <button type="submit" class="input-group-text" id="inputGroupPrepend">
                                                    <i class="fa-solid fa-right-to-bracket"></i>
                                                </button>
                                                <div id="tokenFeedback" class="invalid-feedback">
                                                    <small><?= (session('peringatan')) ? session('peringatan') : $validation->getError('token') ?></small>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Section: Design Block -->

    <!-- peringatan -->
    <script>
        window.setTimeout(
            function() {
                $(".peringatan").fadeTo(2000, 0).slideUp(500, function() {
                    $(this).remove;
                });
            }, 1500);
    </script>

    <script>
        <?php if (session('error_input')) { ?>
            $(document).ready(
                function() {
                    // tab_menu('register-tab', 'login-tab', 'login', 'register');
                    $('#token').click();
                }
            )
        <?php } ?>
    </script>

    <?= $this->include('part/notif.php'); ?>

</body>

</html>
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

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap" style="overflow-x:hidden ;">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>


        <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">

            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <div class="site-logo me-auto w-25"><a href="<?= base_url('') ?>">BarberHouse</a></div>

                    <div class="ms-auto">
                        <nav class="site-navigation position-relative text-right" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav mx-auto d-none d-lg-block  m-0 p-0">
                                <li><a href="#home-section" class="nav-link">Home</a></li>
                                <li><a href="#programs-section" class="nav-link">Programs</a></li>
                                <li><a href="#features-section" class="nav-link">Features</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu site-menu-dark js-clone-nav mr-auto d-none d-lg-block m-0 p-0">
                            <li class="cta"><a href="#register-section" class="nav-link"><span>Sign Up</span></a></li>
                        </ul>
                    </nav> -->
                </div>
            </div>

        </header>

        <div class="intro-section" id="home-section">

            <div class="slide-1" style="background-image: url('<?= base_url() ?>/assets/images/jumbo.jpg');" data-stellar-background-ratio="0.5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="row align-items-center">
                                <div class="col-lg-6 mb-4">
                                    <h1 data-aos="fade-up" data-aos-delay="100">Ayo, daftarkan barbershop mu disini !</h1>
                                    <p class="mb-4" data-aos="fade-up" data-aos-delay="200">Permudah pelanggan untuk menemukan lokasi dan menjangkau barbershop mu, buatlah mereka antri dengan nyaman.</p>
                                    <p data-aos="fade-up" data-aos-delay="300"><a href="#register-section" class="btn btn-success py-3 px-5 btn-pill">Register Now</a></p>
                                </div>

                                <div class="col-lg-6 ms-auto mb-lg-5" data-aos="fade-up" data-aos-delay="500">
                                    <div class="form-box border border-success">
                                        <div class="text-center">
                                            <img src="<?= base_url('assets/images/logo_bhouse_noBg.png') ?>" class="img-fluid pad mb-4">
                                        </div>
                                        <?php
                                        // $errors = session()->getFlashdata('errors');
                                        if (!empty($errors)) { ?>
                                            <div class="alert alert-danger peringatan" role="alert">
                                                <ul>
                                                    <?php foreach ($errors as $error) : ?>
                                                        <li><?= esc($error) ?></li>
                                                    <?php endforeach ?>
                                                </ul>
                                            </div>
                                        <?php } ?>

                                        <!-- notif berhasil -->
                                        <?php if (session()->getFlashdata('pesan')) {
                                            echo '<div class="alert alert-success" role="alert">';
                                            echo session()->getFlashdata('pesan');
                                            echo '</div>';
                                        } ?>

                                        <!-- start -->
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <div class="row w-100 m-0">
                                                <div class="col-6 p-0">
                                                    <li class="nav-item text-center" id="target" onclick="tab_menu('login-tab','register-tab','register','login')">
                                                        <a class="nav-link btn rounded-0 tab_menu_active" id="register-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
                                                    </li>
                                                </div>
                                                <div class="col-6 p-0">
                                                    <li class="nav-item text-center" id="base" onclick="tab_menu('register-tab','login-tab','login','register')">
                                                        <a class="nav-link btn rounded-0 tab_menu_non_active" id="login-tab" data-toggle="pill" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                                    </li>
                                                </div>
                                            </div>
                                        </ul>

                                        <div class="tab-content" id="pills-tabContent">

                                            <!-- sign-in -->
                                            <?= form_open('auth/cek_login') ?>
                                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="register-tab">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" name="username" id="username" placeholder="Username">
                                                    <div id="usernameFeedback" class="invalid-feedback">
                                                        <small><?= $validation->getError('username') ?></small>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="Password">
                                                    <div id="passwordFeedback" class="invalid-feedback">
                                                        <small><?= $validation->getError('password') ?></small>
                                                    </div>
                                                </div>
                                                <div class="form-group text-end">
                                                    <input type="submit" class="btn text-white px-5" style="background: #3D8361;" value="Login">
                                                </div>
                                            </div>
                                            <?= form_close() ?>

                                            <!-- sign-up -->
                                            <?= form_open('auth/register') ?>
                                            <div class="tab-pane fade d-none" id="register" role="tabpanel" aria-labelledby="login-tab">
                                                <div class="form">
                                                    <div class="form-group mb-3">
                                                        <input type="text" class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : '' ?>" name="nama_user" id="nama_user" placeholder="Nama Lengkap" value="<?= old('nama_user') ?>">
                                                        <div id="nama_userFeedback" class="invalid-feedback">
                                                            <small><?= $validation->getError('nama_user') ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <input type="text" class="form-control <?= ($validation->hasError('username_reg')) ? 'is-invalid' : '' ?>" name="username_reg" placeholder="Username" value="<?= old('username_reg') ?>">
                                                        <div id="usernameFeedback" class="invalid-feedback">
                                                            <small><?= $validation->getError('username_reg') ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" name="email" id="email" placeholder="Alamat Email" value="<?= old('email') ?>">
                                                        <div id="emailFeedback" class="invalid-feedback">
                                                            <small><?= $validation->getError('email') ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-4">
                                                        <input type="password" class="form-control <?= ($validation->hasError('password_reg')) ? 'is-invalid' : '' ?>" name="password_reg" placeholder="Password">
                                                        <div id="passwordFeedback" class="invalid-feedback">
                                                            <small><?= $validation->getError('password_reg') ?></small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group text-end">
                                                        <input type="submit" class="btn text-white px-5" style="background: #3D8361;" value="Sign-Up">
                                                    </div>
                                                </div>
                                            </div>
                                            <?= form_close() ?>

                                        </div>

                                        <!-- End -->
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section" id="programs-section">
            <div class="container">
                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-7 text-center" data-aos="fade-up" data-aos-delay="">
                        <h2 class="section-title">Our Programs</h2>
                    </div>
                </div>
                <div class="row mb-5 align-items-center">
                    <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="<?= base_url() ?>/assets/images/bb1.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-lg-4 ms-auto" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-black mb-4">We Are Excellent In Education</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem maxime nam porro possimus fugiat quo molestiae illo.</p>

                        <div class="d-flex align-items-center custom-icon-wrap mb-3">
                            <span class="custom-icon-inner me-3"><span class="icon icon-graduation-cap"></span></span>
                            <div>
                                <h3 class="m-0">22,931 Yearly Graduates</h3>
                            </div>
                        </div>

                        <div class="d-flex align-items-center custom-icon-wrap">
                            <span class="custom-icon-inner me-3"><span class="icon icon-university"></span></span>
                            <div>
                                <h3 class="m-0">150 Universities Worldwide</h3>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-5 align-items-center">
                    <div class="col-lg-7 mb-5 order-1 order-lg-2" data-aos="fade-up" data-aos-delay="100">
                        <img src="<?= base_url() ?>/assets/images/bb2.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-lg-4 me-auto order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-black mb-4">Strive for Excellent</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem maxime nam porro possimus fugiat quo molestiae illo.</p>

                        <div class="d-flex align-items-center custom-icon-wrap mb-3">
                            <span class="custom-icon-inner me-3"><span class="icon icon-graduation-cap"></span></span>
                            <div>
                                <h3 class="m-0">22,931 Yearly Graduates</h3>
                            </div>
                        </div>

                        <div class="d-flex align-items-center custom-icon-wrap">
                            <span class="custom-icon-inner me-3"><span class="icon icon-university"></span></span>
                            <div>
                                <h3 class="m-0">150 Universities Worldwide</h3>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-5 align-items-center">
                    <div class="col-lg-7 mb-5" data-aos="fade-up" data-aos-delay="100">
                        <img src="<?= base_url() ?>/assets/images/bb3.jpg" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-lg-4 ms-auto" data-aos="fade-up" data-aos-delay="200">
                        <h2 class="text-black mb-4">Education is life</h2>
                        <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem maxime nam porro possimus fugiat quo molestiae illo.</p>

                        <div class="d-flex align-items-center custom-icon-wrap mb-3">
                            <span class="custom-icon-inner me-3"><span class="icon icon-graduation-cap"></span></span>
                            <div>
                                <h3 class="m-0">22,931 Yearly Graduates</h3>
                            </div>
                        </div>

                        <div class="d-flex align-items-center custom-icon-wrap">
                            <span class="custom-icon-inner me-3"><span class="icon icon-university"></span></span>
                            <div>
                                <h3 class="m-0">150 Universities Worldwide</h3>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="site-section" id="features-section">
            <div class="container">

                <div class="row mb-5 justify-content-center">
                    <div class="col-lg-7 mb-5 text-center" data-aos="fade-up" data-aos-delay="">
                        <h2 class="section-title">Our Features</h2>
                        <p class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam repellat aut neque! Doloribus sunt non aut reiciendis, vel recusandae obcaecati hic dicta repudiandae in quas quibusdam ullam, illum sed veniam!</p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="teacher text-center">
                            <img src="<?= base_url() ?>/assets/images/person_1.jpg" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
                            <div class="py-2">
                                <h3 class="text-black">Benjamin Stone</h3>
                                <p class="position">Physics Teacher</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="teacher text-center">
                            <img src="<?= base_url() ?>/assets/images/person_2.jpg" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
                            <div class="py-2">
                                <h3 class="text-black">Katleen Stone</h3>
                                <p class="position">Physics Teacher</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="teacher text-center">
                            <img src="<?= base_url() ?>/assets/images/person_3.jpg" alt="Image" class="img-fluid w-50 rounded-circle mx-auto mb-4">
                            <div class="py-2">
                                <h3 class="text-black">Sadie White</h3>
                                <p class="position">Physics Teacher</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Porro eius suscipit delectus enim iusto tempora, adipisci at provident.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="site-section pb-0">

            <div class="future-blobs">
                <div class="blob_2">
                    <img src="<?= base_url() ?>/assets/images/blob_2.svg" alt="Image">
                </div>
                <div class="blob_1">
                    <img src="<?= base_url() ?>/assets/images/blob_1.svg" alt="Image">
                </div>
            </div>
            <div class="container">
                <div class="row mb-5 justify-content-center" data-aos="fade-up" data-aos-delay="">
                    <div class="col-lg-7 text-center">
                        <h2 class="section-title">Why Choose Us</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ms-auto align-self-start" data-aos="fade-up" data-aos-delay="100">

                        <div class="p-4 rounded bg-white why-choose-us-box">

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                                <div>
                                    <h3 class="m-0">22,931 Yearly Graduates</h3>
                                </div>
                            </div>

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                                <div>
                                    <h3 class="m-0">150 Universities Worldwide</h3>
                                </div>
                            </div>

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                                <div>
                                    <h3 class="m-0">Top Professionals in The World</h3>
                                </div>
                            </div>

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                                <div>
                                    <h3 class="m-0">Expand Your Knowledge</h3>
                                </div>
                            </div>

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light mb-3">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-graduation-cap"></span></span></div>
                                <div>
                                    <h3 class="m-0">Best Online Teaching Assistant Courses</h3>
                                </div>
                            </div>

                            <div class="d-flex align-items-center custom-icon-wrap custom-icon-light">
                                <div class="mr-3"><span class="custom-icon-inner"><span class="icon icon-university"></span></span></div>
                                <div>
                                    <h3 class="m-0">Best Features</h3>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-lg-7 align-self-end" data-aos="fade-left" data-aos-delay="200">
                        <img src="<?= base_url() ?>/assets/images/person_transparent.png" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer-section footer-about">
            <div class="container">
                <!-- <div class="d-flex justify-content-center"> -->
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-10">
                                <h3 class="text-white">About BarberHouse</h3>
                                <p class="text-justify">Aplikasi penyedia layanan kemudahan dalam pengolahan data antrian pelanggan barbershop dan penyedia layanan dalam kemudahan pencarian barbershop.</p>
                            </div>

                            <div class="col-md-2">
                                <h3 class="text-white">Links</h3>
                                <ul class="list-unstyled">
                                    <li><a href="#" class="text-white fw-bold">Home</a></li>
                                    <li><a href="#" class="text-white fw-bold">Programs</a></li>
                                    <li><a href="#" class="text-white fw-bold">Features</a></li>
                                    <li><a href="#" class="text-white fw-bold">Sign Up</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    </div> <!-- .site-wrap -->

    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-ui.js"></script>
    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.stellar.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.countdown.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.easing.1.3.js"></script>
    <script src="<?= base_url() ?>/assets/js/aos.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.fancybox.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery.sticky.js"></script>

    <script src="<?= base_url() ?>/assets/js/main.js"></script>



    <!-- peringatan -->
    <script>
        window.setTimeout(
            function() {
                $(".peringatan").fadeTo(2000, 0).slideUp(500, function() {
                    $(this).remove;
                });
            }, 1500);
    </script>

    <!-- home screen -->
    <script>
        function tab_menu(target, base, close, show) {
            document.getElementById(base).classList.remove('active');
            document.getElementById(base).classList.remove('tab_menu_non_active');
            document.getElementById(target).classList.remove('tab_menu_active');
            document.getElementById(base).classList.add('tab_menu_active');
            document.getElementById(target).classList.add('tab_menu_non_active');
            document.getElementById(close).classList.add('d-none');
            document.getElementById(show).classList.remove('d-none');
            document.getElementById(show).classList.add('show');
        }

        // data tdk hilang ketika load ulang regis
        <?php if (session('error_register')) { ?>
            $(document).ready(
                function() {
                    // tab_menu('register-tab', 'login-tab', 'login', 'register');
                    $('#base').click();
                }
            )
        <?php } ?>
    </script>

    <?= $this->include('part/notif.php'); ?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?>-<?= $subtitle ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
    <script src="<?= base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url('admin') ?>" class="nav-link">Home</a>
                </li>
            </ul>


            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>



        <aside class="main-sidebar sidebar-light-primary">

            <div class="sidebar">

                <div class="py-3 d-flex">
                    <h3 class="d-block text-bold">Barberhouse</h3>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= base_url('admin') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('bb') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-scissors"></i>
                                <p>Barbershop</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('menu') ?>" class="nav-link">
                                <i class="nav-icon fas fa-rectangle-list"></i>
                                <p>Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('antrian') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-people-arrows"></i>
                                <p>Antrian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('beliItem') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-spray-can-sparkles"></i>
                                <p>Beli Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('transaksi') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-sack-dollar"></i>
                                <p>Transaksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('laporan') ?>" class="nav-link">
                                <i class="nav-icon fa-solid fa-file"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>

        </aside>


        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm">
                            <h5 class="m-0 mb-3"><?= $subtitle ?></h5>

                            <?= $this->renderSection('content') ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>


    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        window.setTimeout(
            function() {
                $(".peringatan").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove;
                });
            }, 1500);

        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
    </script>

    <?= $this->include('part/notif.php'); ?>
    <?= $this->include('part/dialog_confirm.php'); ?>

</body>

</html>
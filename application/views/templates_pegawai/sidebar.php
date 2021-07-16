<body id="page-top">
    <link href="<?= base_url('assets/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->

    <script>
        var BASEURL = '<?= base_url() ?>';
    </script>
    <?php check_absen_harian() ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">

                <div class="sidebar-brand-text mx-3">App Penggajian</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link text-white">
                    <h2 class="my-0 text-center"><label id="hours"><?= date('H') ?></label>:<label id="minutes"><?= date('i') ?></label>:<label id="seconds"><?= date('s') ?></label></h2>
                </a>
            </li>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('pegawai/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item <?= @$_active ?>">
                <a class="nav-link" href="<?= base_url('pegawai/absensi/check_absen') ?>">
                    <i class="fas fa-user-check"></i> <span class="d-inline">
                        Absen
                        <?php if ($this->session->absen_warning == 'true') : ?>
                            <span class="float-right ml-auto notification p-0 badge badge-danger"><i class="fa fa-exclamation"></i></span>
                        <?php endif; ?>
                    </span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('pegawai/DataGaji') ?>">
                    <i class="fas fa-fw fa-money-check-alt"></i>
                    <span>Data Gaji</span></a>
            </li>



            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('pegawai/GantiPassword') ?>">
                    <i class="fas fa-fw fa-user-lock"></i>
                    <span>Ganti Password</span></a>
            </li>




            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('login/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h4 class="font-weight-bold">PT.KARYA PRIMA INDUSTRI</h4>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang <?php echo $this->session->userdata('nama_pegawai') ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/photo/') . $this->session->userdata('photo') ?>">
                            </a>

                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                    <div class=" container-fluid">
                        <a class="navbar-brand" href="#pablo"> Absensi </a>
                        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-bar burger-lines"></span>
                            <span class="navbar-toggler-bar burger-lines"></span>
                            <span class="navbar-toggler-bar burger-lines"></span>
                        </button>
                    </div>
                </nav>
                <!-- End Navbar -->
                <div class="content">
                    <div class="container-fluid">
                        <div id="alert">
                            <?php if (@$this->session->response) : ?>
                                <div class="alert alert-<?= $this->session->response['status'] == 'error' ? 'danger' : $this->session->response['status'] ?> alert-dismissable fade show" role="alert">
                                    <button class="close" aria-dismissable="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p><?= $this->session->response['message'] ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!--   Core JS Files   -->
                <script src="<?= base_url('assets/js/core/jquery.min.js') ?>" type="text/javascript"></script>
                <script src="<?= base_url('assets/js/core/popper.min.js') ?>" type="text/javascript"></script>
                <script src="<?= base_url('assets/js/core/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>

                <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
                <script src="<?= base_url('assets/js/plugins/bootstrap-switch.js') ?>"></script>
                <!--  Notifications Plugin    -->
                <script src="<?= base_url('assets/js/plugins/bootstrap-notify.js') ?>"></script>
                <!-- SweetAlert -->
                <script src="<?= base_url('assets/js/plugins/sweetalert.min.js') ?>"></script>

                <!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
                <script src="<?= base_url('assets/js/light-bootstrap-dashboard.js?v=2.0.1') ?>" type="text/javascript"></script>

                <!-- Main Js -->
                <script src="<?= base_url('assets/js/main.js') ?>"></script>

                <!-- Custom Script -->
                <script>
                    var hoursLabel = document.getElementById("hours");
                    var minutesLabel = document.getElementById("minutes");
                    var secondsLabel = document.getElementById("seconds");
                    setInterval(setTime, 1000);

                    function setTime() {
                        secondsLabel.innerHTML = pad(Math.floor(new Date().getSeconds()));
                        minutesLabel.innerHTML = pad(Math.floor(new Date().getMinutes()));
                        hoursLabel.innerHTML = pad(Math.floor(new Date().getHours()));
                    }

                    function pad(val) {
                        var valString = val + "";
                        if (valString.length < 2) {
                            return "0" + valString;
                        } else {
                            return valString;
                        }
                    }

                    <?php if (@$this->session->absen_needed) : ?>
                        var absenNeeded = '<?= json_encode($this->session->absen_needed) ?>';
                        <?php $this->session->sess_unset('absen_needed') ?>
                    <?php endif; ?>
                </script>
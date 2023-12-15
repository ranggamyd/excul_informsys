<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?> - SI Eskul</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/sb-admin-2.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/magnific-popup/magnific-popup.css">
    <link rel="shortcut icon" href="<?= base_url('assets') ?>/img/logo.png">

    <!-- Perpage CSS -->
    <?php if (isset($style['css'])) : ?>
        <link rel="stylesheet" href="<?= base_url('assets') ?>/css/<?= $style['css'] ?>">
    <?php endif ?>

    <script src="<?= base_url('assets') ?>/vendor/jquery/jquery.min.js"></script>
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
                <div class="sidebar-brand-icon">
                    <img src="<?= base_url('assets') ?>/img/logo.png" width="40">
                </div>
                <div class="sidebar-brand-text mx-3">SI Eskul</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="<?= base_url('dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Main Menu</div>
            <?php if ($this->session->userdata('role') == 'admin') : ?>
                <li class="nav-item <?= ($this->uri->segment(1) == 'guru') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('guru') ?>">
                        <i class="fa-fw fas fa-user-graduate"></i>
                        <span>Data Guru</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'siswa') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('siswa') ?>">
                        <i class="fa-fw fas fa-user-friends"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'eskul') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('eskul') ?>">
                        <i class="fa-fw fas fa-chart-line"></i>
                        <span>Data Ekstrakulikuler</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'pendaftar') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('pendaftar') ?>">
                        <i class="fa-fw fas fa-user-plus"></i>
                        <span>Data Pendaftar</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'jadwal') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('jadwal') ?>">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <span>Jadwal</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'prestasi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('prestasi') ?>">
                        <i class="fa-fw fas fa-medal"></i>
                        <span>Prestasi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'pengumuman') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('pengumuman') ?>">
                        <i class="fa-fw fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'absensi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('absensi') ?>">
                        <i class="fa-fw fas fa-fw fa-list"></i>
                        <span>Absensi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'nilai') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('nilai') ?>">
                        <i class="fa-fw fas fa-bookmark"></i>
                        <span>Nilai</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($this->session->userdata('role') == 'wakasek') : ?>
                <li class="nav-item <?= ($this->uri->segment(1) == 'prestasi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('prestasi') ?>">
                        <i class="fa-fw fas fa-medal"></i>
                        <span>Prestasi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'laporan') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('laporan') ?>">
                        <i class="fa-fw fas fa-bookmark"></i>
                        <span>Laporan</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($this->session->userdata('role') == 'pembina') : ?>
                <!-- <li class="nav-item <?= ($this->uri->segment(1) == 'guru') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('guru') ?>">
                        <i class="fa-fw fas fa-user-graduate"></i>
                        <span>Data Guru</span>
                    </a>
                </li> -->
                <li class="nav-item <?= ($this->uri->segment(1) == 'siswa') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('siswa') ?>">
                        <i class="fa-fw fas fa-user-friends"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'jadwal') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('jadwal') ?>">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <span>Jadwal</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'prestasi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('prestasi') ?>">
                        <i class="fa-fw fas fa-medal"></i>
                        <span>Prestasi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'pengumuman') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('pengumuman') ?>">
                        <i class="fa-fw fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'absensi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('absensi') ?>">
                        <i class="fa-fw fas fa-fw fa-list"></i>
                        <span>Absensi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'nilai') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('nilai') ?>">
                        <i class="fa-fw fas fa-bookmark"></i>
                        <span>Nilai</span>
                    </a>
                </li>
            <?php endif ?>

            <?php if ($this->session->userdata('login_as') == 'siswa') : ?>
                <li class="nav-item <?= ($this->uri->segment(1) == 'eskul') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('eskul') ?>">
                        <i class="fa-fw fas fa-chart-line"></i>
                        <span>Ekstrakulikuler</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'jadwal') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('jadwal') ?>">
                        <i class="fa-fw fas fa-calendar-alt"></i>
                        <span>Jadwal</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'prestasi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('prestasi') ?>">
                        <i class="fa-fw fas fa-medal"></i>
                        <span>Prestasi Siswa</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'pengumuman') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('pengumuman') ?>">
                        <i class="fa-fw fas fa-bullhorn"></i>
                        <span>Pengumuman</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'absensi') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('absensi') ?>">
                        <i class="fa-fw fas fa-fw fa-list"></i>
                        <span>Absensi</span>
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'nilai') ? 'active' : ''; ?>">
                    <a class="nav-link py-2" href="<?= base_url('nilai') ?>">
                        <i class="fa-fw fas fa-bookmark"></i>
                        <span>Nilai</span>
                    </a>
                </li>
            <?php endif ?>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">Account</div>
            <li class="nav-item <?= ($this->uri->segment(1) == 'users/detail/' . $this->session->userdata('id')) ? 'active' : ''; ?>">
                <a class="nav-link py-2" href="<?= base_url('users/detail/' . $this->session->userdata('id')) ?>">
                    <i class="fa-fw fas fa-users"></i>
                    <span>Profil Saya</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link py-2" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fa-fw fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <?php
                            $id_admin = $this->session->userdata('id_admin');
                            $id_siswa = $this->session->userdata('id_siswa');

                            if ($id_siswa) {
                                $this->db->join('tbl_siswa', 'tbl_siswa.id_siswa = users.id_siswa', 'left');
                            }
                            $user = $this->db->get_where('users', ['users.id' => $this->session->userdata('id')])->row();
                            ?>
                            <a class="nav-link py-2 dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user->username ?></span>
                                <img class="img-profile rounded-circle" src="<?= $id_admin ? base_url('assets/img/default.jpg') : base_url('assets/img/siswa/') . $user->foto ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="<?= base_url('user') ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil Saya
                                </a>
                                <a class="dropdown-item" href="<?= base_url('user/setting') ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Pengaturan Akun
                                </a>
                                <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Keluar
                                </a>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->
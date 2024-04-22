<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="<?= base_url('img/photos/logo_pos.png') ?>" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>Sistem Manajemen Karyawan</title>

    <link href="<?= base_url('css/app.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="wrapper">

        <?php
        // Periksa apakah user ID tersedia di sesi
        $userId = session('id_user') ?? null;

        if ($userId) {
            // Periksa apakah model user ada dan dapat digunakan
            if (class_exists('\App\Models\UserModel')) {
                $userModel = new \App\Models\UserModel();

                // Periksa apakah userRole dapat diambil dari model
                if (method_exists($userModel, 'getUserById')) {
                    $userRole = $userModel->getUserById($userId);
                } else {
                    $userRole['id_role'] = 0; // Jika method tidak ada, atur ke Guest
                }
            } else {
                $userRole['id_role'] = 0; // Jika model tidak ada, atur ke Guest
            }
        } else {
            $userRole['id_role'] = 0; // Jika user ID tidak tersedia di sesi, atur ke Guest
        }

        // Tentukan link aktif berdasarkan halaman yang sedang dibuka
        $currentPage = basename($_SERVER['REQUEST_URI']);

        // Tentukan link yang akan di-highlight sesuai dengan halaman yang sedang dibuka
        function isActive($page, $currentPage)
        {
            return ($page === $currentPage) ? 'active' : '';
        }
        ?>

        <!-- Sidebar Start -->
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
			<a class="sidebar-brand" style="display: flex; align-items: center; justify-content: center;" href="index.html">
				<img src="<?= base_url('img/photos/logo_sidebar.png') ?>" style="width: 30px; height: 30px; margin-right: 10px;">
				<span class="align-middle">SIMANKA POS</span>
			</a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Home
                    </li>

                    <li class="sidebar-item <?= isActive('dashboard', $currentPage) ?>">
                        <a class="sidebar-link" href="<?= base_url('/dashboard') ?>">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <?php if ($userRole['id_role'] == 1) : ?>
                        <li class="sidebar-header">
                            Submenu Admin
                        </li>

                        <li class="sidebar-item <?= isActive('user', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/user') ?>">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                            </a>
                        </li>

						<li class="sidebar-item <?= isActive('role', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/role') ?>">
                                <i class="align-middle" data-feather="users"></i> <span class="align-middle">Role</span>
                            </a>
                        </li>

						<li class="sidebar-item <?= isActive('objective', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/objective') ?>">
                                <i class="align-middle" data-feather="file"></i> <span class="align-middle">Objective</span>
                            </a>
                        </li>

						<li class="sidebar-item <?= isActive('key_result', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/key_result') ?>">
                                <i class="align-middle" data-feather="file"></i> <span class="align-middle">Key Result</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= isActive('rating_output', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/rating_output') ?>">
                                <i class="align-middle" data-feather="list"></i> <span class="align-middle">Rekap Laporan Pekerjaan</span>
                            </a>
                        </li>

                        <!-- Tambahkan item sidebar khusus admin di sini sesuai kebutuhan -->
                    <?php elseif ($userRole['id_role'] == 2) : ?>
                        <li class="sidebar-header">
                            Submenu Karyawan
                        </li>

                        <li class="sidebar-item <?= isActive('profile', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/karyawan/profil') ?>">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= isActive('nilai_pemeriksaan', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/karyawan/nilai_pemeriksaan') ?>">
                                <i class="align-middle" data-feather="list"></i> <span class="align-middle">Nilai Pemeriksaan</span>
                            </a>
                        </li>

                        <!-- Tambahkan item sidebar khusus pasien di sini sesuai kebutuhan -->
                    <?php else : ?>
                        <li class="sidebar-header">
                            Submenu Assigner
                        </li>

                        <li class="sidebar-item <?= isActive('profile', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/assign/profil') ?>">
                                <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-item <?= isActive('nilai_pemeriksaan', $currentPage) ?>">
                            <a class="sidebar-link" href="<?= base_url('/dashboard/assign/nilai_pemeriksaan') ?>">
                                <i class="align-middle" data-feather="list"></i> <span class="align-middle">Nilai Key Result</span>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">SIMANKA POS</strong>
                        <div class="mb-3 text-sm">
                            SIMANKA POS adalah Sistem Manajemen Karyawan untuk Melihat Kinerja Karyawan POS.
                        </div>
                        <div class="d-grid">
                            <a href="https://www.posindonesia.co.id/id" class="btn btn-primary">PT POS IND</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Sidebar End -->


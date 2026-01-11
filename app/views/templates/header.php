<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>

    <link href="<?= BASE_URL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASE_URL; ?>/css/datatables.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/sweetalert2.css">

    <link rel="stylesheet" href="<?= BASE_URL; ?>/css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">

    <style>
        .navbar-nav .nav-link.active {
            color: #ffc107 !important;
            font-weight: bold;
            border-bottom: 2px solid #ffc107;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg border-bottom border-warning sticky-top" style="background-color: #121212;">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?= BASE_URL ?>">
            <i class="fa-solid fa-kaaba text-warning fs-4"></i>
            <span><span class="text-warning">Sobat Gurun</span> TRAVEL</span>
        </a>

        <button class="navbar-toggler border-warning text-warning" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto align-items-center">

                <a class="nav-link <?= ($data['title'] == 'Home') ? 'active' : ''; ?>"
                   href="<?= BASE_URL; ?>">Home</a>

                <a class="nav-link <?= ($data['title'] == 'Daftar Paket') ? 'active' : ''; ?>"
                   href="<?= BASE_URL; ?>/paket">Paket Umroh</a>

                <?php if (isset($_SESSION['role'])) : ?>

                    <?php if ($_SESSION['role'] == 'admin') : ?>
                        <a class="nav-link <?= ($data['title'] == 'Kelola Transaksi') ? 'active' : ''; ?>"
                           href="<?= BASE_URL; ?>/admin/transaksi">
                           <i class="fa-solid fa-clipboard-check"></i> Validasi Transaksi
                        </a>

                    <?php elseif ($_SESSION['role'] == 'jamaah') : ?>
                        <a class="nav-link <?= ($data['title'] == 'Riwayat Transaksi Saya') ? 'active' : ''; ?>"
                           href="<?= BASE_URL; ?>/transaksi">
                           <i class="fa-solid fa-history"></i> Riwayat Pesanan
                        </a>
                    <?php endif; ?>

                    <div class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle btn btn-outline-warning px-3 text-warning border-warning rounded-pill"
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-circle me-1"></i>
                            <?= explode(' ', $_SESSION['nama_user'])[0]; ?> </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-warning mt-2" style="background: #1a1a1a;">
                            <li class="px-3 py-1 text-muted small">Login sebagai <?= ucfirst($_SESSION['role']); ?></li>
                            <li><hr class="dropdown-divider bg-secondary"></li>

                            <li>
                                <a class="dropdown-item text-light hover-warning" href="<?= BASE_URL; ?>/profil">
                                    <i class="fa-solid fa-id-card me-2 text-warning"></i> Profil Saya
                                </a>
                            </li>

                            <li><hr class="dropdown-divider bg-secondary"></li>

                            <li>
                                <a class="dropdown-item text-danger fw-bold" href="<?= BASE_URL; ?>/auth/logout"
                                   onclick="return confirm('Yakin ingin logout?');">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i> Log out
                                </a>
                            </li>
                        </ul>
                    </div>

                <?php else : ?>

                    <a class="btn btn-warning ms-lg-3 px-4 fw-bold rounded-pill shadow" href="<?= BASE_URL; ?>/auth">
                        <i class="fa-solid fa-sign-in-alt me-1"></i> Login
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>

<div class="main-content">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
</head>

<body>
<nav class="navbar navbar-expand-lg border-bottom border-warning">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>">
            <span class="text-warning">Sobat Gurun</span> TRAVEL
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-nav ms-auto align-items-center">
            <a class="nav-link <?= ($data['title'] == 'Home') ? 'text-warning border-bottom border-warning' : ''; ?>" 
                href="<?= BASE_URL; ?>">Home</a>
            
            <a class="nav-link <?= ($data['title'] == 'Paket Umroh') ? 'text-warning border-bottom border-warning' : ''; ?>" 
                href="<?= BASE_URL; ?>/paket">Paket Umroh</a>
                        
            <?php if (isset($_SESSION['role'])) : ?>
                <div class="nav-item dropdown ms-lg-3">
                    <a class="nav-link dropdown-toggle btn btn-outline-warning px-3 text-warning" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user-circle me-1"></i> <?= $_SESSION['nama']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-warning" style="background: #1a1a1a;">
                        <li>
                            <a class="dropdown-item" href="<?= BASE_URL; ?>/profil">
                                <i class="fa-solid fa-id-card me-2 text-warning"></i>Profil Saya
                            </a>
                        </li>
                        <li><hr class="dropdown-divider bg-secondary"></li>
                        <li>
                            <a class="dropdown-item text-danger fw-bold" href="<?= BASE_URL; ?>/auth/logout">
                                <i class="fa-solid fa-right-from-bracket me-2"></i>Log out
                            </a>
                        </li>
                    </ul>
                </div>
            <?php else : ?>
                <a class="nav-link btn btn-warning ms-lg-3 px-4 fw-bold" href="<?= BASE_URL; ?>/auth">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
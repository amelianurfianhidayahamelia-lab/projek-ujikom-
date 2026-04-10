<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Proteksi halaman: Jika parameter 'halaman' tidak ada, arahkan ke user
if (!isset($_GET['halaman']) || $_GET['halaman'] === '') {
    header('Location: dashboard.php?halaman=user');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perpustakaan - Amikom Style</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    
    <style>
        body { background-color: #f4f4f4; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .navbar-custom { background-color: #7b1fa2; color: white; }
        .sidebar { background: white; min-height: 100vh; border-right: 1px solid #ddd; padding-top: 10px; }
        .sidebar .nav-link { 
            color: #333; 
            font-size: 0.85rem; 
            padding: 12px 15px; 
            border-bottom: 1px solid #f1f1f1; 
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover { background-color: #f8f9fa; color: #7b1fa2; }
        .sidebar .nav-link i { width: 25px; color: #666; font-size: 1rem; }
        .active-menu { background-color: #f8f9fa; border-left: 4px solid #7b1fa2; font-weight: bold; }
        .submenu-container { background-color: #ffffff; }
        .submenu-container .nav-link { padding-left: 45px; border-bottom: none; font-size: 0.8rem; color: #666; }
        .badge-pinjam { background-color: #28a745; }
        .badge-target { background-color: #fd7e14; }
        .badge-kembali { background-color: #007bff; }
    </style>
</head>
<body>

<nav class="navbar navbar-custom py-2 shadow-sm">
    <div class="container-fluid d-flex justify-content-between">
        <span class="navbar-brand mb-0 h1 text-white" style="font-size: 1.1rem;">
            <img src="https://via.placeholder.com/30" class="me-2" alt="Logo"> PERPUSTAKAAN SEKOLAH
        </span>
        <a href="logout.php" class="btn btn-danger btn-sm px-3 shadow-sm">LOGOUT</a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-none d-md-block sidebar px-0 shadow-sm">
            <div class="nav flex-column">
                <a class="nav-link <?= $_GET['halaman'] == 'admin' ? 'active-menu' : '' ?>" href="dashboard.php?halaman=admin">
                    <i class="fas fa-home"></i> Tabel Admin 
                </a>
                <a class="nav-link <?= $_GET['halaman'] == 'user' ? 'active-menu' : '' ?>" href="dashboard.php?halaman=user">
                    <i class="bi bi-person-fill"></i> Anggota 
                </a>
                <a class="nav-link <?= $_GET['halaman'] == 'buku' ? 'active-menu' : '' ?>" href="dashboard.php?halaman=buku">
                    <i class="bi bi-book-fill"></i> Tabel Buku 
                </a>
                <a class="nav-link <?= $_GET['halaman'] == 'transaksi_peminjaman' ? 'active-menu' : '' ?>" href="dashboard.php?halaman=transaksi_peminjaman">
                    <i class="bi bi-bookmark-plus"></i> Transaksi
                </a>

                <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuPerpus">
                    <span><i class="fas fa-university"></i> Perpustakaan</span>
                </a>
              
            </div>
        </nav>

        <main class="col-md-9 col-lg-10 p-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active"><?= ucfirst($_GET['halaman']) ?></li>
                </ol>
            </nav>

            <?php
            // Logika pemanggilan halaman yang lebih rapi
            $halaman = $_GET['halaman'];

            switch ($halaman) {
                case 'admin':
                    include_once('admin.php');
                    break;
                case 'buku':
                    include_once('buku.php');
                    break;
                case 'user':
                    include_once('anggota.php');
                    break;
                case 'transaksi_peminjaman':
                    include_once('transaksi_admin.php');
                    break;
                default:
                    echo "<div class='alert alert-danger'>Halaman tidak ditemukan.</div>";
                    break;
            }
            ?>

            <footer class="text-center text-muted mt-5 py-3 border-top" style="font-size: 0.8rem;">
                Copyright &copy; 1994 - <?= date('Y'); ?> <strong>Universitas Amikom Yogyakarta</strong>
            </footer>
        </main>
    </div>
</div>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
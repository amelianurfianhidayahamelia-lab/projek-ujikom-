<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Customer - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet" />
    
    <style>
        :root {
            --primary-purple: #7b1fa2;
            --soft-purple: #f8eafc;
            --dark-purple: #4a148c;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Inter', 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
        }

        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Sidebar */
        .sidebar {
            background: white;
            min-height: calc(100vh - 56px);
            border-right: 1px solid #e0e0e0;
            padding: 20px 0;
        }

        .sidebar .nav-link {
            color: #555;
            padding: 12px 25px;
            margin: 4px 15px;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .sidebar .nav-link:hover {
            background-color: var(--soft-purple);
            color: var(--primary-purple);
        }

        .active-menu {
            background-color: var(--soft-purple) !important;
            color: var(--primary-purple) !important;
            font-weight: 600;
        }

        /* Content Cards */
        .stat-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .main-container {
            padding: 30px;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        footer {
            padding: 20px;
            color: #888;
            font-size: 0.85rem;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-book-half me-2"></i>
            <span class="fw-bold">PERPUSTAKAAN SEKOLAH</span>
        </a>
        <div class="ms-auto">
            <span class="text-white me-3 d-none d-sm-inline">Halo, <strong>User</strong></span>
            <a href="logout.php" class="btn btn-light btn-sm fw-bold px-3 text-danger">LOGOUT</a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block sidebar shadow-sm">
            <div class="position-sticky">
                <div class="nav flex-column">
                    <small class="text-muted px-4 mb-2 text-uppercase fw-bold" style="font-size: 0.7rem;">Menu Utama</small>
                    <a class="nav-link <?= ($page == 'dashboard') ? 'active-menu' : '' ?>" href="?page=dashboard">
    <i class="bi bi-grid-1x2-fill"></i> Dashboard
</a>

<a class="nav-link <?= ($page == 'transaksi') ? 'active-menu' : '' ?>" href="?page=transaksi">
    <i class="bi bi-bookmark-plus"></i> Peminjaman
</a>

<a class="nav-link  <?= ($page == 'Pengembalian') ? 'active-menu' : '' ?>" href="?page=Pengembalian">
    <i class="bi bi-arrow-left-right"></i> Pengembalian
</a>
                    <hr class="mx-3">
                    <small class="text-muted px-4 mb-2 text-uppercase fw-bold" style="font-size: 0.7rem;">Akun</small>
                    <a class="nav-link" href="#">
                        <i class="bi bi-person-circle"></i> Profil Saya
                    </a>
                </div>
            </div>
        </nav>

<main class="col-md-9 col-lg-10 main-container">
    <?php
    if ($page == 'dashboard') {
        include 'costumer_dashboard.php';
    } elseif ($page == 'transaksi') {
        include './transaksi_peminjaman.php';
    } elseif ($page == 'Pengembalian') {
        include 'pengembalian_dashboard.php';
    } else {
        echo "<h4>Halaman tidak ditemukan</h4>";
    }
    ?>
</main>
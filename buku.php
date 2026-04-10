<?php
include 'koneksi.php';

/* =====================
    TAMBAH / EDIT DATA
===================== */
if (isset($_POST['simpan'])) {
    // Mengamankan input dari karakter aneh (SQL Injection)
    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul_buku']);
    $pengarang = mysqli_real_escape_string($koneksi, $_POST['pengarang']);
    $penerbit  = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tahun     = mysqli_real_escape_string($koneksi, $_POST['tahun_terbit']);
    $jumlah    = mysqli_real_escape_string($koneksi, $_POST['jumlah_buku']);
    $rak       = mysqli_real_escape_string($koneksi, $_POST['lokasi_rak']);

    if ($_POST['mode'] == 'tambah') {
        mysqli_query($koneksi, "INSERT INTO crud_buku VALUES(
            '$judul','$pengarang','$penerbit','$tahun','$jumlah','$rak'
        )");
    } else {
        mysqli_query($koneksi, "UPDATE crud_buku SET
            pengarang='$pengarang',
            penerbit='$penerbit',
            tahun_terbit='$tahun',
            jumlah_buku='$jumlah',
            lokasi_rak='$rak'
            WHERE judul_buku='$judul'
        ");
    }

    header("Location: buku.php");
}

/* =====================
    HAPUS DATA
===================== */
if (isset($_GET['hapus'])) {
    $hapus_judul = mysqli_real_escape_string($koneksi, $_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM crud_buku WHERE judul_buku='$hapus_judul'");
    header("Location: buku.php");
}

/* =====================
    AMBIL DATA EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $edit_judul = mysqli_real_escape_string($koneksi, $_GET['edit']);
    $q = mysqli_query($koneksi, "SELECT * FROM crud_buku WHERE judul_buku='$edit_judul'");
    $edit = mysqli_fetch_assoc($q);
}

/* =====================
    LOGIKA PENCARIAN & DATA TABEL
===================== */
$keyword = "";
if (isset($_POST['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_POST['keyword']);
    $query = "SELECT * FROM crud_buku WHERE 
              judul_buku LIKE '%$keyword%' OR 
              pengarang LIKE '%$keyword%' OR 
              penerbit LIKE '%$keyword%' OR 
              lokasi_rak LIKE '%$keyword%'";
    $data = mysqli_query($koneksi, $query);
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM crud_buku");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CRUD Buku Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h4 class="mb-3 fw-bold">📚 CRUD Buku Perpustakaan</h4>

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white fw-bold">
            <?= $edit ? 'Edit Data Buku' : 'Tambah Buku Baru' ?>
        </div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="mode" value="<?= $edit ? 'edit' : 'tambah' ?>">

                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="small text-muted">Judul Buku</label>
                        <input type="text" name="judul_buku" class="form-control"
                               placeholder="Contoh: Belajar PHP"
                               value="<?= $edit['judul_buku'] ?? '' ?>"
                               <?= $edit ? 'readonly' : '' ?> required>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted">Pengarang</label>
                        <input type="text" name="pengarang" class="form-control"
                               placeholder="Nama Pengarang"
                               value="<?= $edit['pengarang'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="small text-muted">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control"
                               placeholder="Nama Penerbit"
                               value="<?= $edit['penerbit'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted">Tahun Terbit</label>
                        <input type="number" name="tahun_terbit" class="form-control"
                               placeholder="Tahun"
                               value="<?= $edit['tahun_terbit'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted">Jumlah Stok</label>
                        <input type="number" name="jumlah_buku" class="form-control"
                               placeholder="Jumlah"
                               value="<?= $edit['jumlah_buku'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="small text-muted">Lokasi Rak</label>
                        <input type="text" name="lokasi_rak" class="form-control"
                               placeholder="Kode Rak"
                               value="<?= $edit['lokasi_rak'] ?? '' ?>" required>
                    </div>
                    <div class="col-md-3 d-grid">
                        <label class="invisible">Aksi</label>
                        <button name="simpan" class="btn btn-success">
                            <?= $edit ? 'Update Data' : 'Simpan Buku' ?>
                        </button>
                    </div>
                </div>
                <?php if($edit): ?>
                    <div class="mt-2">
                        <a href="buku.php" class="btn btn-link btn-sm text-decoration-none text-secondary">Batal Edit</a>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0">Daftar Koleksi Buku</h5>
                </div>
                <div class="col-md-6">
                    <form method="post">
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" 
                                   placeholder="Cari judul, pengarang, atau rak..." 
                                   value="<?= htmlspecialchars($keyword) ?>">
                            <button class="btn btn-primary" type="submit" name="cari">Cari</button>
                            <?php if($keyword): ?>
                                <a href="buku.php" class="btn btn-outline-secondary">Reset</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" width="50">No</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th class="text-center">Tahun</th>
                            <th class="text-center">Stok</th>
                            <th>Rak</th>
                            <th class="text-center" width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $no = 1; 
                    if (mysqli_num_rows($data) > 0) {
                        while($b = mysqli_fetch_assoc($data)) { 
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="fw-bold"><?= htmlspecialchars($b['judul_buku']) ?></td>
                            <td><?= htmlspecialchars($b['pengarang']) ?></td>
                            <td class="text-center"><?= $b['tahun_terbit'] ?></td>
                            <td class="text-center">
                                <span class="badge rounded-pill <?= $b['jumlah_buku'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                                    <?= $b['jumlah_buku'] ?>
                                </span>
                            </td>
                            <td><span class="text-muted"><i class="bi bi-bookshelf"></i></span> <?= htmlspecialchars($b['lokasi_rak']) ?></td>
                            <td class="text-center">
                                <a href="?edit=<?= urlencode($b['judul_buku']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="?hapus=<?= urlencode($b['judul_buku']) ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                    <?php 
                        } 
                    } else {
                        echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Data tidak ditemukan atau tabel kosong.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

</body>
</html>
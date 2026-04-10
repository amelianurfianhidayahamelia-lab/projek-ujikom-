<?php
include 'koneksi.php';

/* =====================
   PROSES PINJAM
===================== */
if (isset($_GET['pinjam'])) {
    $judul = mysqli_real_escape_string($koneksi, $_GET['pinjam']);
    $nama = "User";

    $ambil = mysqli_query($koneksi, "SELECT * FROM crud_buku WHERE judul_buku='$judul'");
    if (!$ambil) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    $b = mysqli_fetch_assoc($ambil);

    if ($b && $b['jumlah_buku'] > 0) {

        mysqli_query($koneksi, "INSERT INTO transaksi 
        (nama, judul_buku, tgl_pinjam, status) 
        VALUES 
        ('$nama', '{$b['judul_buku']}', NOW(), 'sedang di pinjam')");

        mysqli_query($koneksi, "UPDATE crud_buku 
        SET jumlah_buku = jumlah_buku - 1 
        WHERE judul_buku='$judul'");

        echo "<script>alert('Buku berhasil dipinjam');window.location='dashboard.php?halaman=transaksi';</script>";
        exit;
    } else {
        echo "<script>alert('Stok habis!');</script>";
    }
}

/* =====================
   PENCARIAN
===================== */
$cari = $_GET['cari'] ?? '';

$query = "SELECT * FROM crud_buku 
          WHERE judul_buku LIKE '%$cari%' 
          OR pengarang LIKE '%$cari%'";

$buku = mysqli_query($koneksi, $query);

if (!$buku) {
    die("Query Error: " . mysqli_error($koneksi));
}
?>

<h3 class="fw-bold mb-4">📚 Cari & Pinjam Buku</h3>

<!-- ================= FORM CARI ================= -->
<form method="get" action="dashboard.php" class="mb-4">
    <input type="hidden" name="halaman" value="transaksi">

    <div class="input-group">
        <input type="text" name="cari" class="form-control"
               placeholder="Cari buku atau pengarang..."
               value="<?= htmlspecialchars($cari) ?>">
        <button class="btn btn-primary">Cari</button>
    </div>
</form>

<!-- ================= TABEL ================= -->
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Rak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

            <?php 
            $no = 1;
            if ($buku && mysqli_num_rows($buku) > 0):
                while ($b = mysqli_fetch_assoc($buku)):
            ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= htmlspecialchars($b['judul_buku']) ?></td>
                    <td><?= htmlspecialchars($b['pengarang']) ?></td>
                    <td><?= htmlspecialchars($b['penerbit']) ?></td>
                    <td class="text-center"><?= $b['tahun_terbit'] ?></td>

                    <td class="text-center">
                        <?php if ($b['jumlah_buku'] > 0): ?>
                            <span class="badge bg-success"><?= $b['jumlah_buku'] ?></span>
                        <?php else: ?>
                            <span class="badge bg-danger">Habis</span>
                        <?php endif; ?>
                    </td>

                    <td class="text-center"><?= $b['lokasi_rak'] ?></td>

                    <td class="text-center">
                        <?php if ($b['jumlah_buku'] > 0): ?>
                            <a href="dashboard.php?halaman=transaksi&pinjam=<?= urlencode($b['judul_buku']) ?>" 
                               class="btn btn-sm btn-primary"
                               onclick="return confirm('Pinjam buku ini?')">
                               Pinjam
                            </a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary" disabled>
                                Tidak tersedia
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endwhile; else: ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Data tidak ditemukan
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include 'koneksi.php';

/* =====================
    TAMBAH / EDIT DATA
===================== */
if (isset($_POST['simpan'])) {

    $nama           = $_POST['nama'];
    $kelas          = $_POST['kelas'];
    $nomor_anggota  = $_POST['nomor_anggota'];
    $jenis_kelamin  = $_POST['jenis_kelamin'];
    $tanggal_daftar = $_POST['tanggal_daftar'];

    if ($_POST['mode'] == 'tambah') {

        mysqli_query($koneksi,"INSERT INTO crud_anggota 
        (nama, kelas, nomor_anggota, jenis_kelamin, tanggal_daftar) 
        VALUES 
        ('$nama', '$kelas', '$nomor_anggota', '$jenis_kelamin', '$tanggal_daftar')");

    } else {

        mysqli_query($koneksi,"UPDATE crud_anggota SET
            nama            = '$nama',
            kelas           = '$kelas',
            jenis_kelamin   = '$jenis_kelamin',
            tanggal_daftar  = '$tanggal_daftar'
            WHERE nomor_anggota = '$nomor_anggota'
        ");
    }

    header("Location: dashboard.php?halaman=user");
    exit;
}

/* =====================
    HAPUS DATA
===================== */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi,"DELETE FROM crud_anggota WHERE nomor_anggota='$id'");
    header("Location: dashboard.php?halaman=user");
    exit;
}

/* =====================
    AMBIL DATA EDIT
===================== */
$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $q = mysqli_query($koneksi,"SELECT * FROM crud_anggota WHERE nomor_anggota='$id'");
    $edit = mysqli_fetch_assoc($q);
}

/* =====================
    DATA TABEL
===================== */
$data = mysqli_query($koneksi,"SELECT * FROM crud_anggota");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <h4 class="mb-3 fw-bold">👥 CRUD Anggota Perpustakaan</h4>

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="mode" value="<?= $edit ? 'edit' : 'tambah' ?>">

                <div class="row g-2">

                    <div class="col-md-3">
                        <label class="small text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control"
                               placeholder="Nama Anggota"
                               value="<?= $edit['nama'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted">Kelas</label>
                        <input type="text" name="kelas" class="form-control"
                               placeholder="Kelas"
                               value="<?= $edit['kelas'] ?? '' ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted">Nomor Anggota</label>
                        <input type="text" name="nomor_anggota" class="form-control"
                               placeholder="Nomor Anggota"
                               value="<?= $edit['nomor_anggota'] ?? '' ?>"
                               <?= $edit ? 'readonly' : '' ?> required>
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" <?= (isset($edit['jenis_kelamin']) && $edit['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= (isset($edit['jenis_kelamin']) && $edit['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="small text-muted">Tanggal Daftar</label>
                        <input type="date" name="tanggal_daftar" class="form-control"
                               value="<?= $edit['tanggal_daftar'] ?? date('Y-m-d') ?>" required>
                    </div>

                    <div class="col-md-12 d-grid mt-3">
                        <button name="simpan" class="btn btn-primary">
                            <?= $edit ? 'Update Data Anggota' : 'Daftarkan Anggota Baru' ?>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Nomor Anggota</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; while($a = mysqli_fetch_assoc($data)) { ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td class="text-center"><?= $a['kelas'] ?></td>
                        <td class="text-center"><?= $a['nomor_anggota'] ?></td>
                        <td class="text-center"><?= $a['jenis_kelamin'] ?></td>
                        <td class="text-center"><?= $a['tanggal_daftar'] ?></td>
                        <td class="text-center">
                            <a href="?halaman=user&edit=<?= $a['nomor_anggota'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="?halaman=user&hapus=<?= $a['nomor_anggota'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Hapus anggota ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>
<?php
include 'koneksi.php';

$id_buku = $_GET['id'];
$id_user = $_SESSION['id_user'];

// simpan peminjaman
mysqli_query($koneksi, "
    INSERT INTO peminjaman (id_buku, id_user, tanggal_pinjam, status)
    VALUES ('$id_buku','$id_user',CURDATE(),'dipinjam')
");

// kurangi stok
mysqli_query($koneksi, "
    UPDATE buku SET stok = stok - 1 WHERE id_buku='$id_buku'
");

echo "<script>
    alert('Buku berhasil dipinjam');
    window.location='dashboard.php?halaman=buku';
</script>";

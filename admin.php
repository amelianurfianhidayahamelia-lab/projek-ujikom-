<?php
include('koneksi.php');

$query = "SELECT * FROM admin";
$result = mysqli_query($koneksi, $query);
?>

<h2>Data User</h2>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pengguna</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4">No</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="px-4"><?= $no++; ?></td>
                            <td><strong><?= htmlspecialchars($row['username']); ?></strong></td>
                            <td><code><?= htmlspecialchars($row['password']); ?></code></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
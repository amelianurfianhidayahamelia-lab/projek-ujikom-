<?php
// ===================== login.php =====================
include 'koneksi.php';
session_start();

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $login_berhasil = false;

    // ================= CEK ADMIN =================
    $queryAdmin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");
    if ($queryAdmin && mysqli_num_rows($queryAdmin) > 0) {
        $data = mysqli_fetch_assoc($queryAdmin);

        $_SESSION['login']    = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = "admin";

        // Redirect ke dashboard admin
        header("Location: dashboard.php");
        exit;
    }

    // ================= CEK CUSTOMER =================
    $queryCust = mysqli_query($koneksi, "SELECT * FROM custumer WHERE username='$username' AND password='$password'");
    if ($queryCust && mysqli_num_rows($queryCust) > 0) {
        $data = mysqli_fetch_assoc($queryCust);

        $_SESSION['login']    = true;
        $_SESSION['id']       = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = "custumer";

        // Redirect ke dashboard customer
        header("Location: dashboard_costumer.php");
        exit;
    }

    // ================= JIKA TIDAK ADA =================
    echo "<script>alert('Username atau Password tidak ditemukan!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Peminjaman Buku</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body {
            height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex; justify-content: center; align-items: center;
        }
        .login-box {
            background: white; padding: 40px; width: 350px;
            border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease-in-out;
        }
        .login-box h2 { text-align: center; margin-bottom: 30px; color: #333; }
        .input-group { margin-bottom: 20px; }
        .input-group input {
            width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; outline: none;
            transition: 0.3s;
        }
        .input-group input:focus {
            border-color: #667eea; box-shadow: 0 0 8px rgba(102,126,234,0.3);
        }
        .btn-login {
            width: 100%; padding: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none; color: white; border-radius: 8px; cursor: pointer; font-size: 16px;
            transition: 0.3s;
        }
        .btn-login:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.2); }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media(max-width: 400px) { .login-box { width: 90%; padding: 25px; } }
    </style>

</head>
<body>

<div class="login-box">
    <h2>Login</h2>
    <form method="POST">
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit" name="login" class="btn-login">Masuk</button>
    </form>
</div>

</body>
</html>
<?php
include 'koneksi.php';

$successMessage = ""; // Variabel untuk menyimpan pesan sukses

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $passw = mysqli_real_escape_string($conn, $_POST['passw']);
    $passw = password_hash($passw, PASSWORD_DEFAULT);

    $check_email = $conn->prepare("SELECT email FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $check_email->store_result();

    if ($check_email->num_rows > 0) {
        $error = "Email sudah terdaftar! Gunakan email lain.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, passw) VALUES (?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sss", $name, $email, $passw);

            if ($stmt->execute()) {
                $successMessage = "Berhasil mendaftar akun, silakan login kembali.";
            } else {
                $error = "Gagal menambahkan data!";
            }

            $stmt->close();
        } else {
            $error = "Terjadi kesalahan pada query.";
        }
    }

    $check_email->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<style>
  .gradient-fullscreen {
    background: linear-gradient(to right,rgb(6, 38, 65),rgba(81, 13, 240, 0.39));
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
  }
</style>

<div class="gradient-fullscreen">
    <head>
    <title>Tambah Produk</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <?php if (!empty($successMessage)) : ?>
    <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 3000); // Redirect setelah 3 detik
    </script>
    <?php endif; ?>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="card shadow-lg p-4" style="width: 350px;">
    <h4 class="text-center mb-3">Tambah User</h4>

    <?php if (!empty($successMessage)) : ?>
        <div class="alert alert-success text-center" role="alert">
            <?= $successMessage; ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= $error; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="passw" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Tambah User</button>
    </form>
    <div class="text-center mt-3">
        <a href="index.php" class="btn btn-secondary w-100">Kembali ke Login</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
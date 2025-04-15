<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-img {
            width: 200px;
            height: auto;
            border-radius: 8px;
            border: 3px solid #0d6efd;
        }
    </style>
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Dashboard Pengguna</h2>

    <!-- Form input ID pengguna -->
    <form action="" method="get" class="mb-4 text-center">
        <div class="input-group justify-content-center w-50 mx-auto">
            <input type="number" name="id_pengguna" class="form-control" placeholder="Masukkan ID Pengguna" required>
            <button class="btn btn-primary" type="submit">Lihat Profil</button>
        </div>
    </form>

    <!-- Tombol kembali ke halaman upload -->
    <div class="text-center mb-4">
        <a href="upload_profil.php" class="btn btn-outline-secondary">Kembali ke Halaman Upload</a>
    </div>

    <?php
    if (isset($_GET['id_pengguna'])) {
        $id_pengguna = intval($_GET['id_pengguna']);

        $sql = "SELECT * FROM foto_profil WHERE id_pengguna = $id_pengguna ORDER BY uploaded_at DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo "<div class='text-center'>";
            echo "<h5>Foto Profil Pengguna ID: {$id_pengguna}</h5>";
            echo "<img src='{$data['lokasi_file']}' class='profile-img mt-3' alt='Foto Profil'>";
            echo "<p class='text-muted mt-2'><small>Diunggah: {$data['uploaded_at']}</small></p>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-warning text-center'>Foto profil belum tersedia untuk pengguna ID <strong>$id_pengguna</strong>.</div>";
        }
    }
    ?>
</div>

</body>
</html>
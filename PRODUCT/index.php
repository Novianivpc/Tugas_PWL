<?php
include 'config.php';
$result = $conn->query("SELECT * FROM product");
?>
<!DOCTYPE html>
<html>
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
  <title>CRUD Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2>Daftar Produk</h2>
    <a href="create.php" class="btn btn-primary">Tambah Produk</a>
    <table class="table table-bordered mt-5">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning">Edit</a>
              <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus produk?')">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
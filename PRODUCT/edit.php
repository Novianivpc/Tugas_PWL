<?php
include 'config.php';
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM product WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
  $harga = mysqli_real_escape_string($conn, $_POST['harga']);
  $stok = mysqli_real_escape_string($conn, $_POST['stok']);
  
  $query = "UPDATE product SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id=$id";
  if ($conn->query($query)) {
    header("Location: index.php");
  } else {
    echo "Gagal mengupdate produk: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html>
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
  <title>Edit Produk</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2>Edit Produk</h2>
    <form method="POST">
      <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" name="nama_produk" value="<?= $product['nama_produk'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" step="0.01" class="form-control" name="harga" value="<?= $product['harga'] ?>" required>
      </div>
      <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stok" value="<?= $product['stok'] ?>" required>
      </div>
      <button type="submit" class="btn btn-warning">Update</button>
    </form>
  </div>
</body>
</html>
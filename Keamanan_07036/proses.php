<?php
session_start();
require 'config.php';

// Validasi CSRF Token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token tidak valid!");
}

// Ambil dan filter input
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);

// Validasi data tidak kosong
if (empty($name) || empty($email) || empty($password)) {
    die("Semua field harus diisi!");
}

// Cek apakah email sudah ada
$check = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    die("Email sudah digunakan!");
}
$check->close();

// Hash password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Simpan ke database dengan prepared statement
$stmt = $mysqli->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    // Redirect ke halaman sukses
    header("Location: success.php");
    exit(); // pastikan program berhenti setelah redirect
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

$stmt->close();
$mysqli->close();
?>

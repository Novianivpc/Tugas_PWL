<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "secure_register";

$mysqli = new mysqli($host, $user, $pass, $dbname);

// Cek apakah ada error
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>
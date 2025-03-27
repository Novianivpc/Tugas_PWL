<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM product WHERE id=$id");
header("Location: index.php");
?>
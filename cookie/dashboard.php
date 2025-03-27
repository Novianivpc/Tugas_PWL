
<?php
session_start();

if (!isset($_SESSION["username"])) {
    if (isset($_COOKIE["username"])) {
        $_SESSION["username"] = $_COOKIE["username"];
    } else {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

<div class="card shadow-lg text-center p-4" style="width: 350px;">
    <h3 class="mb-3">Selamat Datang!</h3>
    <h5 class="text-primary">
        <?php echo htmlspecialchars($_SESSION["username"]); ?>
    </h5>
    
    <hr>
    
    <a href="logout.php" class="btn btn-danger w-100">Logout</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

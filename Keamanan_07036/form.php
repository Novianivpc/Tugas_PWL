<?php
session_start();
require 'config.php';
require 'csrf_token.php';

$message = ""; // Penting: didefinisikan di awal agar tidak undefined

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("CSRF token tidak valid!");
    }

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($name) || empty($email) || empty($password)) {
        $message = "Semua field harus diisi!";
    } else {
        $check = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $message = "Email sudah digunakan!";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $name, $email, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: success.php");
                exit();
            } else {
                $message = "Terjadi kesalahan: " . $stmt->error;
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #80deea);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .card-header {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #00acc1;
        }
        .btn-success {
            background-color: #00796b;
            border: none;
        }
        .btn-success:hover {
            background-color: #004d40;
        }
    </style>
    <script>
        function validateForm() {
            const name = document.forms["regForm"]["name"].value;
            const email = document.forms["regForm"]["email"].value;
            const password = document.forms["regForm"]["password"].value;

            if (name === "" || email === "" || password === "") {
                alert("Semua field harus diisi!");
                return false;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailPattern.test(email)) {
                alert("Email tidak valid!");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h4 class="mb-0">Form Pendaftaran</h4>
                    </div>
                    <div class="card-body px-4">
                        <?php if ($message) { echo '<div class="alert alert-danger">'.$message.'</div>'; } ?>
                        <form name="regForm" action="form.php" method="POST" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <button type="submit" class="btn btn-success w-100 mt-2">Daftar</button>
                        </form>
                    </div>
                    <div class="card-footer text-center text-muted small">
                        <p class="mb-0">Nama: Noviani Vinalia Putri Cahyani</p>
                        <p class="mb-0">NIM: A12.2023.07036</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

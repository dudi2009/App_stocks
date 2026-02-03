<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_stock");

$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    // Tanpa hashing untuk testing
    if ($user && $password == $user['password']) {
        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['lvl'] = $user['lvl'];

        echo "<script>
            window.location.href='index.php';
        </script>";
        exit;
    } else {
        $error = 'Username atau Password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #2b2b2b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: #3d3d3d;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .login-card h3 {
            color: white;
            margin-bottom: 30px;
        }
        .form-control {
            background-color: #4a4a4a;
            border: none;
            color: white;
        }
        .form-control:focus {
            background-color: #555;
            color: white;
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }
        .form-label {
            color: #ccc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="login-card">
                    <h3 class="text-center">🔐 Login</h3>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

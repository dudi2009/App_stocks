<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_stock");

$error = '';

if (isset($_POST['login'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    // Cari pelanggan berdasarkan nama dan no hp
    $pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE nama_pelanggan='$nama' AND no_hp='$no_hp'"));
    if ($pelanggan && $pelanggan['id_user']) {
        // Ambil user yang terkait
        $user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='{$pelanggan['id_user']}' AND lvl='user'"));
        if ($user) {
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['lvl'] = $user['lvl'];
            header('Location: login_user.php');
            exit;
        } else {
            $error = 'Akun user tidak ditemukan.';
        }
    } else {
        $error = 'Nama atau No HP salah!';
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
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-success w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

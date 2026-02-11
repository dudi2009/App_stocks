<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_stock");
$error = '';
if (isset($_POST['login'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $pelanggan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE nama_pelanggan='$nama' AND no_hp='$no_hp'"));
    if ($pelanggan) {
        $_SESSION['id_user'] = $pelanggan['id_pelanggan']; // gunakan id_pelanggan sebagai id_user
        $_SESSION['username'] = $pelanggan['nama_pelanggan'];
        $_SESSION['lvl'] = 'user';
        echo "<script>window.location.href='index.php';</script>";
        exit;
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
    <title>Login User</title>
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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        h3 {
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
                    <h3 class="text-center">🔐 Login User</h3><?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?><form method="POST">
                        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="nama" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">No HP</label><input type="text" name="no_hp" class="form-control" required></div>
                        <div class="mb-3 text-center"><span style="color:#ccc;">Jika anda admin/petugas, <a href='login_admin.php' class='text-info'>klik di sini</a></span></div><button type="submit" name="login" class="btn btn-success w-100">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
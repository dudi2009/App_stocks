<?php
if (!cekAkses(['admin', 'petugas'])) return;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']); // Tanpa hash
    $lvl = mysqli_real_escape_string($koneksi, $_POST['lvl']);

    // Validasi: petugas hanya bisa tambah user
    if (isPetugas() && $lvl != 'user') {
        echo "<script>
            Swal.fire('Error', 'Anda hanya bisa menambah user!', 'error').then(() => {
                window.location.href='?hal=manageUser';
            });
        </script>";
        return;
    }

    // Cek username sudah ada atau belum
    $cek = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            Swal.fire('Error', 'Username sudah digunakan!', 'error').then(() => {
                window.location.href='?hal=manageUser';
            });
        </script>";
        return;
    }

    mysqli_query($koneksi, "INSERT INTO user (username, password, lvl) VALUES ('$username', '$password', '$lvl')");

    echo "<script>
        Swal.fire('Berhasil', 'User berhasil ditambahkan!', 'success').then(() => {
            window.location.href='?hal=manageUser';
        });
    </script>";
}
?>

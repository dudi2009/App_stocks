<?php
if (!cekAkses(['admin', 'petugas'])) return;

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data user yang akan dihapus
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id'"));

if (!$user) {
    echo "<script>
        Swal.fire('Error', 'User tidak ditemukan!', 'error').then(() => {
            window.location.href='?hal=manageUser';
        });
    </script>";
    return;
}

// Validasi: petugas hanya bisa hapus user
if (isPetugas() && $user['lvl'] != 'user') {
    echo "<script>
        Swal.fire('Error', 'Anda tidak bisa menghapus user ini!', 'error').then(() => {
            window.location.href='?hal=manageUser';
        });
    </script>";
    return;
}

// Tidak bisa hapus diri sendiri
if ($id == $_SESSION['id_user']) {
    echo "<script>
        Swal.fire('Error', 'Tidak bisa menghapus akun sendiri!', 'error').then(() => {
            window.location.href='?hal=manageUser';
        });
    </script>";
    return;
}

mysqli_query($koneksi, "DELETE FROM user WHERE id_user='$id'");

echo "<script>
    Swal.fire('Berhasil', 'User berhasil dihapus!', 'success').then(() => {
        window.location.href='?hal=manageUser';
    });
</script>";
?>

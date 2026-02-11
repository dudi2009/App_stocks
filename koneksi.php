<?php
// koneksi.php
$koneksi = mysqli_connect('localhost', 'root', '', 'app_stock');
if (!$koneksi) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}
?>

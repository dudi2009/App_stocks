<?php
// transaksiDelete.php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['lvl']) || ($_SESSION['lvl'] != 'admin' && $_SESSION['lvl'] != 'petugas')) {
    header('Location: index.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: riwayatTransaksi.php');
    exit;
}

$id = intval($_GET['id']);

// Hapus detail transaksi dulu
mysqli_query($koneksi, "DELETE FROM detail_penjualan WHERE id_penjualan = '$id'");
// Hapus transaksi utama
mysqli_query($koneksi, "DELETE FROM penjualan WHERE id_penjualan = '$id'");

header('Location: riwayatTransaksi.php');
exit;
?>

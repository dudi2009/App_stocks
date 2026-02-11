<?php
// Cek apakah mode transaksi langsung (tanpa pelanggan) atau dengan pelanggan
if (isset($_GET['mode']) && $_GET['mode'] == 'langsung') {
    // Transaksi langsung tanpa pelanggan (untuk level user)
    $id_pelanggan = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : 'NULL';
    mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES ('$id_pelanggan')");
} else {
    // Transaksi dengan pelanggan
    $id_pelanggan = $_GET['id'] ?? $_GET['id_pelanggan'] ?? 0;
    mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES ('$id_pelanggan')");
}

$id_penjualan = mysqli_insert_id($koneksi);
echo "<script>window.location.href='?hal=transaksiBarang&id=$id_penjualan';</script>";
?>
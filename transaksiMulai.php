<?php
// Cek apakah mode transaksi langsung (tanpa pelanggan) atau dengan pelanggan
if (isset($_GET['mode']) && $_GET['mode'] == 'langsung') {
    // Transaksi langsung tanpa pelanggan (untuk level user)
    mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES (NULL)");
} else {
    // Transaksi dengan pelanggan
    $id_pelanggan = $_GET['id'] ?? $_GET['id_pelanggan'] ?? 0;
    mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES ('$id_pelanggan')");
}

$id_penjualan = mysqli_insert_id($koneksi);
echo "<script>window.location.href='?hal=transaksiBarang&id=$id_penjualan';</script>";
?>
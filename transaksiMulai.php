<?php
$id_pelanggan = $_GET['id_pelanggan'];

mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES ('$id_pelanggan')");

$id_penjualan = mysqli_insert_id($koneksi);
echo "<script>window.location.href='?hal=transaksiBarang&id=$id_penjualan';</script>";
?>
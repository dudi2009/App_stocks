<?php
$id_pelanggan = $_GET['id_pelanggan'];

mysqli_query($koneksi, "INSERT INTO penjualan (id_pelanggan) VALUES ('$id_pelanggan')");

$id_pelanggan = mysqli_insert_id($koneksi);
header("location:?hal=transaksiBarang&id=id=$id_pelanggan");
?>
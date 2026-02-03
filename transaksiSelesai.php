<?php

$id_penjualan =$_GET['id'];

$total = mysqli_fetch_assoc(mysqli_query($koneksi,"
SELECT SUM(subtotal) total
FROM detail_penjualan 
WHERE id_penjualan='$id_penjualan'
"));

mysqli_query($koneksi,"
UPDATE penjualan SET total='$total[total]'
WHERE id_penjualan='$id_penjualan'
");
?>

<h4>Tansaksi Selesai</h4>
<h5>Total Bayar : Rp <?= number_format($total['total']) ?></h5>

<a href="?hal=transaksi" class="btn btn-success">
    Transaksi Baru
</a>
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
<div class="container text-center my-5 align-middle">

    <h4 class="text-light">Tansaksi Selesai</h4>
    <h5 class="text-light">Total Bayar : Rp <?= number_format($total['total'] ?? 0) ?></h5>
    
    <a href="?hal=transaksi" class="btn btn-success">
        Transaksi Baru
    </a>
    
    
</div>
<div class="d-flex justify-content-center">
    <img src="https://i.pinimg.com/1200x/04/cc/b0/04ccb0a0d278052efc88ff4d141a1d4f.jpg" class="w-25">
</div>
<?php
$id_penjualan = $_GET['id_penjualan'] ?? $_GET['id'] ?? 0;

if(isset($_GET['aksi'])){
    $id_produk = $_GET['id_produk'];
    $aksi =$_GET['aksi'];

    $produk = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT harga, stok FROM produk WHERE id_produk = '$id_produk'"));

    $detail = mysqli_fetch_assoc(mysqli_query($koneksi,"
    SELECT * FROM detail_penjualan 
    WHERE id_penjualan='$id_penjualan'
    AND id_produk='$id_produk'
    "));

if($aksi=="tambah" && $produk['stok']>0){
    if($detail){
        $jumlah = $detail['jumlah'] + 1;
        $subtotal = $jumlah * $produk['harga'];
        mysqli_query($koneksi, "
        UPDATE detail_penjualan
        SET jumlah='$jumlah', subtotal='$subtotal'
        WHERE id_penjualan='$id_penjualan'
        AND id_produk='$id_produk'
        "
        );
    }else {
        mysqli_query($koneksi,"
        INSERT INTO detail_penjualan 
        (id_penjualan,id_produk,jumlah,harga,subtotal)
        VALUES
        ('$id_penjualan','$id_produk',1,'$produk[harga]','$produk[harga]')
        ");
    }
    mysqli_query($koneksi,"
    UPDATE produk SET stok = stok - 1
    WHERE id_produk='$id_produk'");
}
if($aksi=="kurang" && $detail){
    $jumlah = $detail['jumlah'] - 1;

    if($jumlah<=0){
        mysqli_query($koneksi,"
        DELETE FROM detail_penjualan 
        WHERE id_penjualan='$id_penjualan'
        AND id_produk='$id_produk'
        ");
    }else{
        $subtotal = $jumlah * $produk ['harga'];
        mysqli_query($koneksi,"
        UPDATE detail_penjualan 
        SET jumlah='$jumlah', subtotal='$subtotal'
        WHERE id_penjualan='$id_penjualan'
        AND id_produk='$id_produk'
        ");
    }

    mysqli_query($koneksi,"
    UPDATE produk SET stok = stok + 1
    WHERE id_produk='$id_produk'
    ");
}
header("Location:?hal=transaksiBarang&id=$id_penjualan");
exit;
}

?>

<div class="container">
<table class="table table-bordered text-center">
    <tr>
        <th>Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Beli</th>
    </tr>
    <?php 
    $produk = mysqli_query($koneksi,"SELECT * FROM produk");

    while($p=mysqli_fetch_assoc($produk)){
        $id = mysqli_fetch_assoc(mysqli_query($koneksi,"
        SELECT jumlah From detail_penjualan
        WHERE id_penjualan='$id_penjualan'
        AND id_produk='$p[id_produk]'"));
        $jumlah = $id['jumlah'] ?? 0;
    ?>
    <tr>
        <td><?= $p['nama_produk'] ?></td>
        <td>RP <?= number_format($p['harga']) ?></td>
        <td><?= $p['stok'] ?></td>
        <td>
            <a href="?hal=transaksiBarang&id=<?= $id_penjualan ?>&aksi=kurang&id_produk=<?= $p['id_produk'] ?>" class="btn btn-danger btn-sm">-</a>
            <b><?= $jumlah ?></b>
            <a href="?hal=transaksiBarang&id=<?= $id_penjualan ?>&aksi=tambah&id_produk=<?= $p['id_produk'] ?>" class="btn btn-success btn-sm">+</a>
        </td>
    </tr>
    <?php } ?>
</table>
</div>
<a href="?hal=transaksiSelesai&id=<?= $id_penjualan ?>" class="btn btn-primary">Selesai</a>
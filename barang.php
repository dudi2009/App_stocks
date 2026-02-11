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
    ?>
    <tr>
        <td><?= $p['nama_produk'] ?></td>
        <td>RP <?= number_format($p['harga']) ?></td>
        <td><?= $p['stok'] ?></td>
        <td>
            <a href="?hal=tansaksiBarang&id=<?= $id_penjualan ?>&aksi=kurang&id_produk=<?= $p['id_produk'] ?>" class="btn btn-danger btn-sm">-</a>
            <b><?= $jumlah ?></b>
            <a href="?ha;=tansaksiBarang&id=<?= $id_penjualan ?>&aksi=tambah&id_produk=<?= $p['id_produk'] ?>" class="btn btn-succes btn-sm">+</a>
        </td>
    </tr>
    <?php } ?>
</table>
<a href="?hal=transaksi_selesai&id=<?= $id_penjualan ?>" class="btn btn-primary">Selesai</a>
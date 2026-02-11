<?php
// Halaman untuk user melihat riwayat transaksi (view only)
$nama_pelanggan = $_SESSION['username'];
$level = $_SESSION['lvl'];
?>
<div class="container mt-4">
    <h3 class="text-light">📋 Riwayat Transaksi</h3>
    <table class="table table-dark table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <!-- Kolom Nama hanya untuk admin/petugas -->
                <?php if ($level != 'user'): ?>
                <th>Nama</th>
                <?php endif; ?>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($level == 'user') {
                $query = mysqli_query($koneksi, "
                    SELECT p.*, pel.nama_pelanggan 
                    FROM penjualan p 
                    LEFT JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
                    WHERE pel.nama_pelanggan = '$nama_pelanggan'
                    ORDER BY p.id_penjualan DESC
                ");
            } else {
                $query = mysqli_query($koneksi, "
                    SELECT p.*, pel.nama_pelanggan 
                    FROM penjualan p 
                    LEFT JOIN pelanggan pel ON p.id_pelanggan = pel.id_pelanggan
                    ORDER BY p.id_penjualan DESC
                ");
            }
            $no = 1;
            if (mysqli_num_rows($query) == 0) {
                echo "<tr><td colspan='5' class='text-center'>Belum ada transaksi</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($query)):
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>#<?= $row['id_penjualan'] ?></td>
                <!-- Kolom Nama hanya untuk admin/petugas -->
                <?php if ($level != 'user'): ?>
                <td><?= $row['nama_pelanggan'] ?? '-' ?></td>
                <?php endif; ?>
                <td><?= $row['tanggal'] ?? '-' ?></td>
                <td>Rp <?= number_format($row['total'] ?? 0) ?></td>
                <td>
                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?= $row['id_penjualan'] ?>">
                        Lihat Detail
                    </button>
                    <!-- <?php if ($level == 'admin' || $level == 'petugas'): ?>
                    <a href="transaksiDelete.php?id=<?= $row['id_penjualan'] ?>" class="btn btn-sm btn-danger ms-1" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                        Hapus
                    </a>
                    <?php endif; ?> -->
                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal<?= $row['id_penjualan'] ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content bg-dark text-light">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail Transaksi #<?= $row['id_penjualan'] ?></h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Pelanggan:</strong> <?= $row['nama_pelanggan'] ?? '-' ?></p>
                                    <p><strong>Total:</strong> Rp <?= number_format($row['total'] ?? 0) ?></p>
                                    <hr>
                                    <h6>Barang:</h6>
                                    <table class="table table-sm table-dark">
                                        <thead>
                                            <tr>
                                                <th>Produk</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $detail = mysqli_query($koneksi, "
                                                SELECT d.*, pr.nama_produk 
                                                FROM detail_penjualan d
                                                LEFT JOIN produk pr ON d.id_produk = pr.id_produk
                                                WHERE d.id_penjualan = '{$row['id_penjualan']}'
                                            ");
                                            while ($item = mysqli_fetch_assoc($detail)):
                                            ?>
                                            <tr>
                                                <td><?= $item['nama_produk'] ?? '-' ?></td>
                                                <td><?= $item['qty'] ?? 0 ?></td>
                                                <td>Rp <?= number_format($item['subtotal'] ?? 0) ?></td>
                                            </tr>
                                            <?php endwhile; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <?php 
                endwhile;
            }
            ?>
        </tbody>
    </table>
</div>

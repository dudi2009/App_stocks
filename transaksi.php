<?php 
// Cek jika user level biasa, langsung bisa transaksi tanpa cari pelanggan
?>

<div class="container w-50 my-5">
    <div class="card text-center" style="border:solid 1px black;color:white;">
        <div class="card-header" style="background-color: #272727;border:solid 1px black">
            Transaksi
        </div>
        <div class="card-body" style="background-color: #222222;">
            
            <?php if (isUser()): ?>
            <!-- Untuk level User: Transaksi Langsung tanpa pilih pelanggan -->
            <div class="mb-4">
                <h5 class="card-title my-3">Transaksi Langsung <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                    <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                    <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                </svg></h5>
                <p class="text-muted">Mulai transaksi tanpa memilih pelanggan</p>
                <a href="?hal=transaksiMulai&mode=langsung" class="btn btn-success btn-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5"/>
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg> Mulai Transaksi Sekarang
                </a>
            </div>
            <?php else: ?>
            <!-- Untuk Admin/Petugas: Cari Pelanggan -->
            <h5 class="card-title my-3">Cari Pelanggan <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg></h5>
           
            <form action="" method="post">
                <div class="d-flex gap-3">
                    <input type="text" name="nama" id="" class="form-control" placeholder="Cari nama pelanggan">
                    <button type="submit" name="cari" class="btn btn-primary w-25">Cari <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
  <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018"/>
  <path d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11"/>
</svg></button>
                </div>
            </form>
            <table class="table table-stripped table-dark">
                <?php
                if (isset($_POST['cari'])) {
                    $nama = $_POST['nama'];
                    $tampil = mysqli_query($koneksi, "SELECT nama_pelanggan, id_pelanggan FROM pelanggan WHERE nama_pelanggan LIKE '%$nama%'");
                    if (mysqli_num_rows($tampil) == 0) {
                        echo "<tr><td colspan='8' class='text-center'>belum ada data pelanggan.</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($tampil)) {
                ?>
                            <div class="gx-5 my-3 bg-info">
                            <tr>
                                <td class="text-start"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg><?= $row['nama_pelanggan'] ?></td>
                                <td class="d-flex justify-content-end">
                                    <a href="?hal=transaksiMulai&id=<?= $row['id_pelanggan'] ?>" class="btn btn-primary">lakukan Transaksi</a>
                                </td>
                            </tr>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="card-footer text-body-secondary text-light" style="background-color: #272727;border:solid 1px black;">
            <p class="text-light">Transaksi</p>
        </div>
    </div>
</div>
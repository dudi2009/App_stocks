<!-- <?php 
$id_penjualan = $_GET['id_pelanggan'];
?> -->

<div class="container w-50 my-5">
    <div class="card text-center" style="border:solid 1px black;color:white;">
        <div class="card-header" style="background-color: #272727;border:solid 1px black">
            Transaksi
        </div>
        <div class="card-body" style="background-color: #222222;">
            <h5 class="card-title my-3">Cari user     <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
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
        </div>
        <div class="card-footer text-body-secondary text-light" style="background-color: #272727;border:solid 1px black;">
            <p class="text-light">Transaksi</p>
        </div>
    </div>
</div>
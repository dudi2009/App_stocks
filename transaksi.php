<div class="container my-5">
    <div class="card text-center">
        <div class="card-header">
            Transaksi
        </div>
        <div class="card-body">
            <h5 class="card-title">Cari user</h5>
            <form action="" method="post">
                <input type="text" name="nama" id="" class="form-control">
                <button type="submit" name="cari" class="btn btn-primary">Cari</button>
            </form>
            <table class="table table-stripped">
            <?php 
            if(isset($_POST['cari'])){
                $nama = $_POST['nama'];
                $tampil = mysqli_query($koneksi,"SELECT nama_pelanggan FROM pelanggan WHERE nama_pelanggan LIKE '%$nama%'");
                if(mysqli_num_rows($tampil) == 0){
                    echo "";
                }
            }
            ?>
            </table>
        </div>
    </div>
</div>
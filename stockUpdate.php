<?php 
$id = $_GET['id_produk'];
$query = mysqli_query($koneksi,"SELECT * FROM produk WHERE id_produk ='$id'");
while ($row = mysqli_fetch_assoc($query)){
?>
<div class="h1 my-4 text-center">DATA produk</div>

 <form action="" method="POST">
        <!-- Button trigger modal -->
       

        <!-- Modal -->
            <div class="container">
                <div class="card my-5 p-5">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12"> <label for="firstName" class="form-label">name</label> <input type="text" name="nama" class="form-control w" id="firstName" placeholder="" value="<?= $row['nama_produk'] ?>" required="" fdprocessedid="mqoaff">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">Address</label> <input type="text" name="harga" class="form-control" id="address" placeholder="" required="" fdprocessedid="350b4h" value="<?= $row['harga'] ?>">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">No Hp</label> <input type="number" name="stok" class="form-control" id="address" placeholder="" required="" fdprocessedid="350b4h" value="<?= $row['stok'] ?>">
                                <div class="invalid-feedback">
                                    NO HP
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class=" mt-5">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">balik</button>
                        <button type="submit" class="btn btn-primary" name="submit">ubah</button>
                    </div>
                </div>
            </div>
    </form> 
    <?php
}
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        $sql = "UPDATE produk SET 
                        nama_produk = '$nama', 
                        harga = '$harga', 
                        stok = '$stok' 
                        WHERE id_produk = '$id'";

         if (mysqli_query($koneksi, $sql)) {
        echo "
        <script>
            Swal.fire({
    		icon: 'success',
    		title: 'Berhasil!',
    		text: 'Data produk berhasil disimpan'
		}).then((result) => {
   	 if (result.isConfirmed) {
        window.location = 'index.php?hal=stock';
    }
});
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Data gagal disimpan',
                footer: '".mysqli_error($koneksi)."'
            });
        </script>
        ";
    }
    }
    ?>
    </div>
  </div>
</div>
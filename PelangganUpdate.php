<?php 
$id = $_GET['id_pelanggan'];
$query = mysqli_query($koneksi,"SELECT * FROM pelanggan WHERE id_pelanggan ='$id'");
while ($row = mysqli_fetch_assoc($query)){
?>
<div class="h1 my-4 text-center">DATA PELANGGAN</div>

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
                            <div class="col-12"> <label for="firstName" class="form-label">name</label> <input type="text" name="nama" class="form-control w" id="firstName" placeholder="" value="<?= $row['nama_pelanggan'] ?>" required="" fdprocessedid="mqoaff">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">Address</label> <input type="text" name="alamat" class="form-control" id="address" placeholder="" required="" fdprocessedid="350b4h" value="<?= $row['alamat'] ?>">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">No Hp</label> <input type="number" name="no" class="form-control" id="address" placeholder="" required="" fdprocessedid="350b4h" value="<?= $row['no_hp'] ?>">
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
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no'];

        $sql = "UPDATE pelanggan SET 
                        nama_pelanggan = '$nama', 
                        alamat = '$alamat', 
                        no_hp = '$no_hp' 
                        WHERE id_pelanggan = '$id'";

         if (mysqli_query($koneksi, $sql)) {
        echo "
        <script>
            Swal.fire({
    		icon: 'success',
    		title: 'Berhasil!',
    		text: 'Data pelanggan berhasil disimpan'
		}).then((result) => {
   	 if (result.isConfirmed) {
        window.location = 'index.php?hal=pelanggan';
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
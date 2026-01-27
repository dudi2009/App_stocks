<h1 class="my-4 text-center">Pelanggan <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-amazon" viewBox="0 0 16 16">
        <path d="M10.813 11.968c.157.083.36.074.5-.05l.005.005a90 90 0 0 1 1.623-1.405c.173-.143.143-.372.006-.563l-.125-.17c-.345-.465-.673-.906-.673-1.791v-3.3l.001-.335c.008-1.265.014-2.421-.933-3.305C10.404.274 9.06 0 8.03 0 6.017 0 3.77.75 3.296 3.24c-.047.264.143.404.316.443l2.054.22c.19-.009.33-.196.366-.387.176-.857.896-1.271 1.703-1.271.435 0 .929.16 1.188.55.264.39.26.91.257 1.376v.432q-.3.033-.621.065c-1.113.114-2.397.246-3.36.67C3.873 5.91 2.94 7.08 2.94 8.798c0 2.2 1.387 3.298 3.168 3.298 1.506 0 2.328-.354 3.489-1.54l.167.246c.274.405.456.675 1.047 1.166ZM6.03 8.431C6.03 6.627 7.647 6.3 9.177 6.3v.57c.001.776.002 1.434-.396 2.133-.336.595-.87.961-1.465.961-.812 0-1.286-.619-1.286-1.533M.435 12.174c2.629 1.603 6.698 4.084 13.183.997.28-.116.475.078.199.431C13.538 13.96 11.312 16 7.57 16 3.832 16 .968 13.446.094 12.386c-.24-.275.036-.4.199-.299z" />
        <path d="M13.828 11.943c.567-.07 1.468-.027 1.645.204.135.176-.004.966-.233 1.533-.23.563-.572.961-.762 1.115s-.333.094-.23-.137c.105-.23.684-1.663.455-1.963-.213-.278-1.177-.177-1.625-.13l-.09.009q-.142.013-.233.024c-.193.021-.245.027-.274-.032-.074-.209.779-.556 1.347-.623" />
    </svg></h1>
<div class="container">
    <form action="" method="POST">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Data +
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12"> <label for="firstName" class="form-label">name</label> <input type="text" name="nama" class="form-control w" id="firstName" placeholder="" value="" required="" fdprocessedid="mqoaff">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">Address</label> <input type="text" name="alamat" class="form-control" id="address" placeholder="1234 Main St" required="" fdprocessedid="350b4h">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>
                            <div class="col-12"> <label for="address" class="form-label">No Hp</label> <input type="number" name="no" class="form-control" id="address" placeholder="08..." required="" fdprocessedid="350b4h">
                                <div class="invalid-feedback">
                                    NO HP
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
       <?php
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $no = $_POST['no'];

            $sql = "INSERT INTO pelanggan (id_pelanggan, nama_pelanggan, alamat, no_hp)
                VALUES (NULL, '$nama', '$alamat', '$no')";

            if (mysqli_query($koneksi, $sql)) {
                echo "<div class='alert alert-success'>Siswa berhasil disimpan!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
            }
        }
        ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>id</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Hp</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $query = mysqli_query($koneksi, "SELECT * FROM pelanggan");

            if (mysqli_num_rows($query) == 0) {
                echo "<tr><td colspan='8' class='text-center'>Belum ada data siswa.</td></tr>";
            } else {
                while ($row = mysqli_fetch_assoc($query)) {
            ?>
                    <tr>
                        <td><?= $row['id_pelanggan'] ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td>
                            <a href="hapus_pelanggan.php?id=<?= $row['id_pelanggan'] ?>&nama_pelanggan=<?=$row['nama_pelanggan']?>" class="btn btn-danger">Hapus</a>
                            <a href="edit_pelanggan.php?id=<?= $row['id_pelanggan'] ?>" class="btn btn-warning">Edit</a>
                        </td>


                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
     
    </table>
</div>
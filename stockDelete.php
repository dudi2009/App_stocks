<?php 
$id = $_GET['id_produk'];
mysqli_query($koneksi,"DELETE FROM produk WHERE `produk`.`id_produk` = $id");

 if ($koneksi) {
            echo "
        <script>
            Swal.fire({
    		icon: 'success',
    		title: 'Berhasil!',
    		text: 'Data pelanggan berhasil Hapus'
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
                text: 'Data gagal dihapus',
                footer: '" . mysqli_error($koneksi) . "'
            });
        </script>
        ";
        }
?>
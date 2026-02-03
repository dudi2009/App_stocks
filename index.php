<?php
$koneksi = new  mysqli("localhost", "root", "", "db_stock");
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
        <style>
            body{
                background-color: #2b2b2b;
            }
            nav{
               background-color: #2b2b2b;
               color: white; 
            }
            h1{
                color: white;
            }
            li a{
                color: white;
            }
        </style>

</head>

<body >
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <header>
        <?php 
        $hal = isset($_GET['hal']) ? $_GET['hal'] : '';
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000;">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item <?= $hal == 'home' ? 'active' : '' ?>">
                            <a class="nav-link active" aria-current="page" href="?hal=home">Home</a>
                        </li>
                        <li class="nav-item <?= $hal == 'pelanggan' ? 'active' : '' ?>">
                            <a class="nav-link" href="?hal=pelanggan">Pelangan</a>
                        </li>
                        <li class="nav-item <?= $hal == 'stock' ? 'active' : '' ?>">
                            <a class="nav-link" href="?hal=stock">Stock Barang</a>
                        </li>
                        <li class="nav-item <?= $hal == 'transaksi' ? 'active' : '' ?>">
                            <a class="nav-link" href="?hal=transaksi">transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <div class="row">
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
                <div class="col"></div>
            </div>
        </div>
    </main>
    <?php
    if (isset($_GET['hal'])) {

        switch ($hal) {
            case 'pelanggan':
                include "pelanggan.php";
                break;
            case 'stock':
                include "stock.php";
                break;
            case 'home':
                include "home.php";
                break;
            case 'pelangganDelete':
                include "pelangganDelete.php";
                break;
            case 'pelangganUpdate':
                include "pelangganUpdate.php";
                break;
            case 'stockDelete':
                include "stockDelete.php";
                break;
            case 'stockUpdate':
                include "stockUpdate.php";
                break;
            case 'transaksi':
                include "transaksi.php";
                break;
            case 'transaksiMulai':
                include "transaksiMulai.php";
                break;
            case 'transaksiBarang':
                include "transaksiBarang.php";
                break;
            case 'transaksiSelesai':
                include "transaksiSelesai.php";
                break;
            default:
                echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                break;
        }
    } else {
        include "home.php";
    }

    ?>
    <footer>
        <!-- place footer here -->
    </footer>
    <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
    

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>
</html>
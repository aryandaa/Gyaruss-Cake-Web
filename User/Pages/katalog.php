<?php 
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '../error.log');

include $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php';
include '../include/init_cart.php';

$query = "SELECT * FROM produk WHERE kategori = 'Cake'";
$kue = mysqli_query($conn, $query);

$query = "SELECT * FROM produk WHERE kategori = 'Catering'";
$katering = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Gyaruss Cake</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Gyaruss" name="keywords">
    <meta content="Toko kue yang ada di kalsel" name="description">
    <link href="../Asset/images/logo gyarus.png" rel="icon">

    <link rel="stylesheet" href="../Asset/css/index.css">
    <link rel="stylesheet" href="../Asset/css/index2.css">

    <style>
        .product-image {
            width: 100%;
            height: 260px;
            border-radius: 15px 15px 0 0;
            display: block;
        }

        .product-item {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .product-actions {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px; /* jarak icon & tombol */
        }

        .btn-cart-icon {
            width: 55px;
            height: 55px;
            border-radius: 50%;
        }

        .btn-beli {
            padding: 10px 26px;       /* biar langsing */
            border-radius: 50px;
            background-color: #2B143B;
            color: white;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;      /* biar gak jadi 2 baris */
        }

    </style>

</head>

<body>
    <?php 
    $activePage = 'Menu';
    include '../include/header.php'; 
    ?>

 <!-- Produk Cake Start -->   
<div class="container-xxl my-4 py-4 pt-4" style="background-color: white !important;">
    <div class="container">
        <div class="text-start ms-3 mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700; color: #2B143B;">Kue</h1>
        </div>

        <div class="row g-4">

            <?php foreach ($kue as $k): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">

                         <div class="position-relative">
                            <img class="img-fluid product-image" 
                                    src="../Asset/images/Produk/<?= $k['gambar']; ?>" 
                                    alt="<?= $k['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" 
                                    href="detail-produk.php?id=<?= $k['id_produk'] ?>&from=menu">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>
                        
                        <div class="text-center p-4 product-body">
                            <h3 class="mb-2"><?= $k['nama_produk']; ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($k['harga'], 0, ',', '.'); ?>
                            </div>

                            <div class="product-actions">
                                 <form action="../proses/tambah_keranjang.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_produk" value="<?= $k['id_produk'] ?>">
                                <button class="border-0 rounded-circle p-3 btn-cart-icon d-flex justify-content-center align-items-center" style="background-color: #2B143B;">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="23" 
                                        height="23" 
                                        fill="currentColor" 
                                        class="bi bi-bag-plus-fill" 
                                        viewBox="0 0 16 16"
                                        style="color: white;">
                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z"/>
                                    </svg>
                                </button>
                                </form>

                                <a href="form_beli_sekarang.php?id_produk=<?= $k['id_produk']; ?>" class="btn background rounded-pill py-3 px-4 btn-beli"><span class="text-white">Beli Sekarang</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Produk Cake End -->


<!-- Produk Catering Start -->   
<div class="container-xxl my-2 py-2 pt-0" style="background-color: white !important;">
    <div class="container">
        <div class="text-start ms-3 mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700; color: #2B143B;">Katering</h1>    
        </div>

        <div class="row g-4">

            <?php foreach ($katering as $kr): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                         <div class="position-relative">
                            <img class="img-fluid product-image" src="../Asset/images/Produk/<?= $kr['gambar']; ?>" alt="<?= $p['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="detail-produk.php?id=<?= $kr['id_produk'] ?>&from=menu">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text-center p-4 product-body">
                            <h3 class="mb-2"><?= $kr['nama_produk']; ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($kr['harga'], 0, ',', '.'); ?>
                            </div> 
                            <div class="product-actions"> 
                             <form action="../proses/tambah_keranjang.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_produk" value="<?= $kr['id_produk'] ?>">
                                <button class="border-0 rounded-circle p-3 btn-cart-icon d-flex justify-content-center align-items-center" style="background-color: #2B143B;">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="23" 
                                        height="23" 
                                        fill="currentColor" 
                                        class="bi bi-bag-plus-fill" 
                                        viewBox="0 0 16 16"
                                        style="color: white;">
                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z"/>
                                    </svg>
                                </button>
                                </form>

                                <a href="form_beli_sekarang.php?id_produk=<?= $kr['id_produk']; ?>" class="btn background rounded-pill py-3 px-4 btn-beli"><span class="text-white">Beli Sekarang</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Produk Catering End -->

    <?php include '../include/footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square rounded-circle back-to-top" style="background-color: #60405aff;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="color: white;">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
</svg></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../Asset/lib/wow/wow.min.js"></script>
    <script src="../Asset/lib/easing/easing.min.js"></script>
    <script src="../Asset/lib/waypoints/waypoints.min.js"></script>
    <script src="../Asset/lib/counterup/counterup.min.js"></script>
    <script src="../Asset/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="../Asset/js/main.js"></script>

</body>
</html>
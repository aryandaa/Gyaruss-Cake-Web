<?php 
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '../error.log');

include '../include/connect.php';
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
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700;">Kue</h1>
        </div>

        <div class="row g-4">

            <?php foreach ($kue as $k): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                         <div class="position-relative mt-auto">
                            <img class="img-fluid product-image" src="../Asset/images/Produk/<?= $k['gambar']; ?>" alt="<?= $k['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="detail-produk.php?id=<?= $k['id_produk'] ?>&from=/Pages/katalog.php">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-2"><?= $k['nama_produk']; ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($k['harga'], 0, ',', '.'); ?>
                            </div> 
                            <div>
                                 <form action="../proses/tambah_keranjang.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_produk" value="<?= $k['id_produk'] ?>">
                                <button class="border-0 rounded-circle p-3 btn-cart-icon" style="background-color: #2B143B;">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="25" height="25" 
                                        fill="currentColor" 
                                        class="bi bi-cart-plus " 
                                        viewBox="0 0 16 16" 
                                        style="color: white;">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                </button>
                                </form>

                                <a href="form_beli_sekarang.php?id_produk=<?= $k['id_produk']; ?>" class="btn background rounded-pill py-3 px-4"><span class="text-white">Beli Sekarang</span></a>
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
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700;">Katering</h1>    
        </div>

        <div class="row g-4">

            <?php foreach ($katering as $kr): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                         <div class="position-relative mt-auto">
                            <img class="img-fluid product-image" src="../Asset/images/Produk/<?= $kr['gambar']; ?>" alt="<?= $p['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="detail-produk.php?id=<?= $kr['id_produk'] ?>&from=/Pages/katalog.php ">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-2"><?= $kr['nama_produk']; ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($kr['harga'], 0, ',', '.'); ?>
                            </div> 
                            <div>
                             <form action="../proses/tambah_keranjang.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_produk" value="<?= $kr['id_produk'] ?>">
                                <button class="border-0 rounded-circle p-3 btn-cart-icon" style="background-color: #2B143B;">
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        width="25" height="25" 
                                        fill="currentColor" 
                                        class="bi bi-cart-plus " 
                                        viewBox="0 0 16 16" 
                                        style="color: white;">
                                        <path d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z"/>
                                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                                    </svg>
                                </button>
                                </form>

                                <a href="form_beli_sekarang.php?id_produk=<?= $kr['id_produk']; ?>" class="btn background rounded-pill py-3 px-4"><span class="text-white">Beli Sekarang</span></a>
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
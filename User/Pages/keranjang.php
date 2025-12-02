<?php 
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '../error.log');

include '../include/connect.php';
include '../include/init_cart.php';

$data = mysqli_query($conn, "
    SELECT cart.id_cart, cart.qty, produk.nama_produk, produk.harga, produk.gambar
    FROM cart
    JOIN produk ON cart.id_produk = produk.id_produk
    WHERE cart.cart_token = '$cart_token'
");

$count = mysqli_query($conn, 
    "SELECT SUM(qty) AS total FROM cart WHERE cart_token='$cart_token'"
);
$total = mysqli_fetch_assoc($count)['total'] ?? 0;

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
        .cart-item img {
            max-width: 100px;
            height: auto;
        }

        .quantity-input {
            width: 50px;
        }

        .cart-summary {
            background-color: #f8f9fa;
            border-radius: 10px;
        }
        .purple-btn { background-color:#4B2A5A; color:white; }
        .purple-btn:hover { background-color:#3a2047; }
        .purple-bg { background-color:#4B2A5A; color:white; }
        .btn-circle { width:35px; height:35px; border-radius:50%; }

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
    $activePage = 'keranjang';
    include '../include/header.php'; 
    ?>

<!-- Keranjang Start-->   
        <div class="container my-5">

    <h1 class="fw-bold mb-4" style="color:#2B143B; font-family:'Rufina', serif;">
        Keranjang Belanja
    </h1>

    <?php if (mysqli_num_rows($data) == 0): ?>
    <p>Keranjang masih kosong</p>

    <?php else: ?>
    <div class="row g-4">

        <!-- BAGIAN KIRI -->
        <div class="col-lg-8">

            <!-- PRODUK ATAS -->
            <div class="row g-3 mb-4">
            <?php mysqli_data_seek($data, 0);?>
            <?php while ($c = mysqli_fetch_assoc($data)): ?>

            <!-- PRODUK LOOP -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="border-radius:15px;">
                    <img src="../Asset/images/Produk/<?= $c['gambar']; ?>" class="card-img-top"
                        style="height:130px; object-fit:cover; border-radius:15px 15px 0 0;">

                    <div class="d-flex justify-content-between align-items-center px-3 py-2 purple-bg"
                        style="border-radius:0 0 15px 15px;">
                        <span class="fw-semibold"><?= $c['nama_produk']; ?></span>
                        <a href="../proses/hapus_cart.php?id=<?= $c['id_cart']; ?>">
                        <button class="btn btn-sm rounded-circle" style="background-color: red;"><i class="bi bi-trash" style="color: white;"></i></button>
                        </a>
                    </div>

                </div>
            </div>
                <?php endwhile; ?>
        </div>

            <!-- LIST ITEM BAWAH -->
             <?php mysqli_data_seek($data, 0); ?>
            <?php while ($c = mysqli_fetch_assoc($data)): ?>
            <div class="card shadow-sm mb-3 rounded-4 border-0 p-3">
                <div class="d-flex align-items-center">
                    <img src="../Asset/images/Produk/<?= $c['gambar']; ?>"  class="rounded me-3" style="width:80px;">
                    <div class="flex-grow-1">
                        <h6 class="fw-bold mb-1"><?= $c['nama_produk']; ?></h6>
                        <p class="text-muted mb-0">Rp <?= number_format($c['harga'], 0, ',', '.'); ?></p>
                    </div>

                    <div class="d-flex align-items-center gap-2">

                    <a href="../proses/minus_qty.php?id=<?= $c['id_cart']; ?>">
                    <button class="btn rounded-circle d-flex justify-content-center align-items-center shadow"
                            style="width:40px; height:40px; background-color:#504060;">
                        <span class="text-white fw-bold">−</span>
                    </button>
                    </a>

                    <div class="rounded-circle d-flex justify-content-center align-items-center shadow"
                        style="width:40px; height:40px; background-color:#504060;">
                        <span class="text-white fw-bold"><?= $c['qty']; ?></span>
                    </div>

                    <a href="../proses/plus_qty.php?id=<?= $c['id_cart']; ?>">
                    <button class="btn rounded-circle d-flex justify-content-center align-items-center shadow"
                            style="width:40px; height:40px; background-color:#504060;">
                        <span class="text-white fw-bold">+</span>
                    </button>
                    </a>

                </div>

                </div>
            </div>
            <?php endwhile; ?>

        </div>



        <!-- BAGIAN KANAN -->
        <div class="col-lg-4">
            <?php 
            mysqli_data_seek($data, 0);
            $total_harga = 0;
            $total_qty = 0;
            while ($c = mysqli_fetch_assoc($data)) {
                $total_harga += $c['harga'] * $c['qty'];
                $total_qty += $c['qty'];
            }
            ?>
            <div class="card shadow-sm rounded-4 border-0 p-4">

                <h5 class="fw-bold text-center mb-3 fs-4" style="font-family: 'Montserrat', sans-serif; font-weight:700; color:#2B143B;">Jumlah Pesanan</h5>

                <div class="d-flex justify-content-between mb-1">
                    <span>Total Pesanan (<?= $total_qty ?> item)</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                    <strong>Total</strong>
                    <strong>Rp <?= number_format($total_harga, 0, ',', '.') ?></strong>
                </div>

                <form action="form_checkout.php" method="POST">
                    <?php
                    mysqli_data_seek($data, 0);
                    while ($c = mysqli_fetch_assoc($data)): ?>
                        <input type="hidden" name="produk_id[]" value="<?= $c['id_cart']; ?>">
                        <input type="hidden" name="qty[]" value="<?= $c['qty']; ?>">
                    <?php endwhile; ?>
                    
                <div class="d-flex justify-content-center"> 
                    <button class="btn py-2 px-2 shadow rounded-pill" 
                            style="
                            background-color: #504060;
                            width:65%;">
                        <span style="font-family: 'Montserrat', sans-serif; font-weight:700; color: white;">Lanjutkan Pesanan</span>
                    </button>
                </div>
                </form>

            </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<!-- Keranjang End-->

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
                         <div class="position-relative">
                            <img class="img-fluid product-image" src="../Asset/images/Produk/<?= $k['gambar']; ?>" alt="<?= $k['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="detail-produk.php?id=<?= $k['id_produk'] ?>&from=/Pages/keranjang.php ">
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
                         <div class="position-relative">
                            <img class="img-fluid product-image" src="../Asset/images/Produk/<?= $kr['gambar']; ?>" alt="<?= $kr['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="detail-produk.php?id=<?= $kr['id_produk'] ?>&from=/Pages/keranjang.php">
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
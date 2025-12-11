<?php 
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '../error.log');

function smartInclude($local, $hosting) {
    if (file_exists($local)) {
        include $local;
    } elseif (file_exists($hosting)) {
        include $hosting;
    } else {
        die("Include gagal: file tidak ditemukan");
    }
}

smartInclude(
    $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php', // local
    $_SERVER['DOCUMENT_ROOT'] . '/config.php'                  // hosting
);
smartInclude(
    $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/secure.php', // local
    $_SERVER['DOCUMENT_ROOT'] . '/secure.php'                  // hosting
);

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

        .qty-btn {
        width: 40px;
        height: 40px;
        background-color: #504060;
        border: none;
        outline: none;
        text-decoration: none;
        }

        /* Hilangkan highlight biru */
        a:focus,
        a:active,
        button:focus,
        button:active {
            outline: none !important;
            box-shadow: none !important;
        }

        /* Hilangkan garis bawah link */
        a {
            text-decoration: none !important;
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

                    <div class="d-flex justify-content-center  align-items-center px-3 py-2 purple-bg"
                        style="border-radius:0 0 15px 15px;">
                        <span class="fw-semibold text-center"><?= $c['nama_produk']; ?></span>
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
                        <a href="../proses/minus_qty.php?id=<?= $c['id_cart']; ?>">
                        <button class="btn rounded-circle d-flex justify-content-center align-items-center shadow"
                                style="width:40px; height:40px; background-color:#504060; border:none;">
                            <span class="text-white fw-bold"
                                style="font-size:48px; line-height:0;">
                                <i class="bi bi-dash fs-3"></i>
                            </span>
                        </button>
                    </a>

                    <div class="rounded-circle d-flex justify-content-center align-items-center shadow"
                        style="width:40px; height:40px; background-color:#504060;">
                        <span class="text-white fw-bold fs-5" style="font-family: montserrat;"><?= $c['qty']; ?></span>
                    </div>

                    <a href="../proses/plus_qty.php?id=<?= $c['id_cart']; ?>">
                        <button class="btn rounded-circle d-flex justify-content-center align-items-center shadow"
                                style="width:40px; height:40px; background-color:#504060; border:none;">
                            <span class="text-white fw-bold"
                                style="font-size:40px; line-height:0;">
                                <i class="bi bi-plus fs-3"></i>
                            </span>
                        </button>
                    </a>



                    <a href="../proses/hapus_cart.php?id=<?= $c['id_cart']; ?>" class="ms-4 ">
                        <button class="btn qty-btn rounded-circle d-flex justify-content-center align-items-center shadow"
                                style="width:45px; height:45px; background-color:#504060;">
                            <i class="bi bi-trash text-white fs-5"></i>
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
                    <span style="font-family: 'Montserrat', sans-serif;">Total Pesanan (<?= $total_qty ?> item)</span>
                </div>

                <hr>

                <div class="d-flex justify-content-between mb-4">
                    <strong style="font-family: 'Montserrat', sans-serif;">Total</strong>
                    <strong style="font-family: 'Montserrat', sans-serif; font-weight:500;">Rp <?= number_format($total_harga, 0, ',', '.') ?></strong>
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
                               <button class="border-0 rounded-circle p-3 btn-cart-icon d-flex justify-content-center align-items-center" style="background-color: #2B143B;">
                                    <svg width="50" height="50"
                                        fill="currentColor"
                                        viewBox="0 0 16 16" 
                                        version="1.1" 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        class="si-glyph si-glyph-basket-plus"
                                        style="color: white;">
                                                <path d="M9.927,11.918 C9.887,11.833 9.86,11.741 9.86,11.639 L9.86,7.483 C9.86,7.145 10.146,6.907 10.448,6.907 L10.469,6.907 C10.77,6.907 11.063,7.145 11.063,7.483 L11.063,10.943 L11.965,10.943 L11.965,8.982 L13.258,8.982 L13.422,5.976 L14.188,5.976 C14.588,5.976 14.913,4.756 14.913,4.756 C14.913,4.386 14.589,4.084 14.188,4.084 L12.26,4.084 L11.225,0.447 C11.074,0.13 10.699,0.00199999998 10.387,0.161 L10.315,0.197 C10.005,0.357 9.876,0.743 10.027,1.06 L10.768,4.083 L4.114,4.083 L4.882,1.064 C5.036,0.75 4.909,0.362 4.601,0.199 L4.531,0.163 C4.22,0.000999999981 3.843,0.125 3.689,0.44 L2.616,4.083 L0.726,4.083 C0.326,4.083 0.000999999931,4.385 0.000999999931,4.755 C0.000999999931,4.755 0.325,5.975 0.726,5.975 L1.362,5.975 L1.811,12.652 C1.811,12.652 1.863,13.961 3.924,13.961 L9.928,13.961 L9.928,11.918 L9.927,11.918 Z M11.969,5 L13.031,5 L13.031,6.062 L11.969,6.062 L11.969,5 L11.969,5 Z M3.094,6.031 L1.912,6.031 L1.912,4.906 L3.094,4.906 L3.094,6.031 L3.094,6.031 Z M5.006,11.742 C5.006,12.092 4.755,12.375 4.447,12.375 L4.424,12.375 C4.113,12.375 3.863,12.092 3.863,11.742 L3.863,7.413 C3.863,7.063 4.113,6.781 4.424,6.781 L4.447,6.781 C4.755,6.781 5.006,7.063 5.006,7.413 L5.006,11.742 L5.006,11.742 Z M8.004,11.547 C8.004,11.881 7.774,12.152 7.49,12.152 L7.469,12.152 C7.185,12.152 6.955,11.881 6.955,11.547 L6.955,7.448 C6.955,7.114 7.184,6.844 7.469,6.844 L7.49,6.844 C7.773,6.844 8.004,7.115 8.004,7.448 L8.004,11.547 L8.004,11.547 Z" class="si-glyph-fill">
                                                </path>
                                                <path d="M16,12.012 L13.992,12.012 L13.992,10.106 L13.055,10.106 L13.055,12.012 L11.052,12.012 L11.052,12.906 L13.055,12.906 L13.055,14.938 L13.992,14.938 L13.992,12.906 L16,12.906 L16,12.012 Z" class="si-glyph-fill">
                                                </path>
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
                                <button class="border-0 rounded-circle p-3 btn-cart-icon d-flex justify-content-center align-items-center" style="background-color: #2B143B;">
                                    <svg width="50" height="50"
                                        fill="currentColor"
                                        viewBox="0 0 16 16" 
                                        version="1.1" 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        xmlns:xlink="http://www.w3.org/1999/xlink" 
                                        class="si-glyph si-glyph-basket-plus"
                                        style="color: white;">
                                                <path d="M9.927,11.918 C9.887,11.833 9.86,11.741 9.86,11.639 L9.86,7.483 C9.86,7.145 10.146,6.907 10.448,6.907 L10.469,6.907 C10.77,6.907 11.063,7.145 11.063,7.483 L11.063,10.943 L11.965,10.943 L11.965,8.982 L13.258,8.982 L13.422,5.976 L14.188,5.976 C14.588,5.976 14.913,4.756 14.913,4.756 C14.913,4.386 14.589,4.084 14.188,4.084 L12.26,4.084 L11.225,0.447 C11.074,0.13 10.699,0.00199999998 10.387,0.161 L10.315,0.197 C10.005,0.357 9.876,0.743 10.027,1.06 L10.768,4.083 L4.114,4.083 L4.882,1.064 C5.036,0.75 4.909,0.362 4.601,0.199 L4.531,0.163 C4.22,0.000999999981 3.843,0.125 3.689,0.44 L2.616,4.083 L0.726,4.083 C0.326,4.083 0.000999999931,4.385 0.000999999931,4.755 C0.000999999931,4.755 0.325,5.975 0.726,5.975 L1.362,5.975 L1.811,12.652 C1.811,12.652 1.863,13.961 3.924,13.961 L9.928,13.961 L9.928,11.918 L9.927,11.918 Z M11.969,5 L13.031,5 L13.031,6.062 L11.969,6.062 L11.969,5 L11.969,5 Z M3.094,6.031 L1.912,6.031 L1.912,4.906 L3.094,4.906 L3.094,6.031 L3.094,6.031 Z M5.006,11.742 C5.006,12.092 4.755,12.375 4.447,12.375 L4.424,12.375 C4.113,12.375 3.863,12.092 3.863,11.742 L3.863,7.413 C3.863,7.063 4.113,6.781 4.424,6.781 L4.447,6.781 C4.755,6.781 5.006,7.063 5.006,7.413 L5.006,11.742 L5.006,11.742 Z M8.004,11.547 C8.004,11.881 7.774,12.152 7.49,12.152 L7.469,12.152 C7.185,12.152 6.955,11.881 6.955,11.547 L6.955,7.448 C6.955,7.114 7.184,6.844 7.469,6.844 L7.49,6.844 C7.773,6.844 8.004,7.115 8.004,7.448 L8.004,11.547 L8.004,11.547 Z" class="si-glyph-fill">
                                                </path>
                                                <path d="M16,12.012 L13.992,12.012 L13.992,10.106 L13.055,10.106 L13.055,12.012 L11.052,12.012 L11.052,12.906 L13.055,12.906 L13.055,14.938 L13.992,14.938 L13.992,12.906 L16,12.906 L16,12.012 Z" class="si-glyph-fill">
                                                </path>
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
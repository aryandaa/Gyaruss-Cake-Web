<?php 
session_start();
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
include 'User/include/init_cart.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Gyaruss Cake</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Gyaruss" name="keywords">
    <meta content="Toko kue yang ada di kalsel" name="description">
    <link href="User/Asset/images/logo gyarus.png" rel="icon">

    <link rel="stylesheet" href="User/Asset/css/index.css">
    <link rel="stylesheet" href="User/Asset/css/index2.css">
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
    <!-- Spinner Start -->
     <!-- Spinner berfungsi untuk loading pada render awal website -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Mengambil header -->
    <?php 
    $activePage = 'beranda';
    include 'User/include/header.php'; 
    ?>


    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">

            <?php foreach ($bestSeller as $bs): ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="User/Asset/images/Produk/<?= e($bs['gambar']); ?>" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <h1 class="display-1 mb-4 animated slideInDown" style="color: #504060;"><b>Rekomendasi</b></h1>
                                <p class="text-color fs-5 mb-4 pb-3">- Rasakan Kelezatannya</p>
                                <a href="User/Pages/form_beli_sekarang.php?id_produk=<?= e($bs['id_produk']); ?>" class="btn background rounded-pill py-3 px-5"><span class="text-white">Beli Sekarang <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                                </svg></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
    <!-- Carousel End -->


    <!-- Best seller Start -->
    <div class="container-xxl my-5 py-5 pt-0" style="background-color: white !important;">
        <class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-star-fill mx-3" viewBox="0 0 16 16" style="color: #EDB500;">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg> 
                
                Terlaris 
                
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-star-fill mx-3" viewBox="0 0 16 16" style="color: #EDB500;">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg></h1>
            </div>

                <div class="row justify-content-center gx-4 gy-4 text-center">

                <?php foreach ($bestSeller as $bs): ?>
                <div class="col-lg-5 col-md-6 col-sm-10 wow fadeInUp rounded-pill d-flex justify-content-center" data-wow-delay="0.1s">
                    <div class="product-item bg-white" 
                        style="
                        width:100%;
                        max-width: 480px;
                        border-radius: 25px;
                        overflow: hidden;
                        transition: transform .3s ease, box-shadow .3s ease;
                        cursor:pointer;
                        "
                        onmouseover="this.style.transform='scale(1.03)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.12)'"
                        onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)'"
                        >
                        <div class="position-relative">
                            <img class="img-fluid"
                                src="User/Asset/images/Produk/<?= e($bs['gambar']); ?>" 
                                alt="<?= e($bs['nama_produk']); ?>"
                                style="
                                width:100%;
                                height:300px;
                                object-fit:cover;">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="User/Pages/detail-produk.php?id=<?= $bs['id_produk'] ?>&from=index.php" ><i class="fa fa-eye text-primary"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                </div>
            
        </div>
    </div>
    <!-- Best Seller End -->


 <!-- Produk Start -->   
<div class="container-xxl my-2 py-2 pt-0" style="background-color: white !important;">
    <div class="container">
        <div class="text-start ms-3 mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700; color: #2B143B;">Menu</h1>
            <Form meythod="GET" action="index.php">
            <div class="d-flex gap-3 flex-wrap mt-3 align-items-center">
                <button type="submit" name="filter" value="all" class="btn rounded-pill py-3 px-4 <?= ($filter == 'all') ? 'filter-active' : '' ?> " style="background-color: #E9D9DE;">
                    <span class="fw-bold <?= ($filter == 'all') ? 'text-white' : '' ?> fs-6" style="font-family: 'Montserrat', sans-serif; font-weight:700; color: #504060;" >
                        Lihat Semua Menu →
                    </span> 
                </button>
                <button  type="submit" name="filter" value="Cake" class="btn rounded-pill py-3 px-4 <?= ($filter == 'Cake') ? 'filter-active' : '' ?> " style="background-color: #E9D9DE;">
                    <span class="fw-bold <?= ($filter == 'Cake') ? 'text-white' : '' ?>  fs-6" style="font-family: 'Montserrat', sans-serif; font-weight:700; color: #504060;">
                        Kue
                    </span>
                </button>
                <button type="submit" name="filter" value="Catering" class="btn rounded-pill py-3 px-4 <?= ($filter == 'Catering') ? 'filter-active' : '' ?> " style="background-color: #E9D9DE;">
                    <span class="fw-bold <?= ($filter == 'Catering') ? 'text-white' : '' ?> fs-6" style="font-family: 'Montserrat', sans-serif; font-weight:700; color: #504060;">
                        Katering
                    </span>
                </button>
            </div>
        </Form>
        </div>

        <div class="row g-4">
            <?php foreach ($result as $p): ?>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">

                         <div class="position-relative">
                            <img class="img-fluid product-image" 
                                src="User/Asset/images/Produk/<?= e($p['gambar']); ?>" 
                                alt="<?= e($p['nama_produk']); ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle"
                                href="User/Pages/detail-produk.php?id=<?= $p['id_produk'] ?>&from=/index.php ">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>

                        <div class="text-center p-4 product-body">
                            <h3 class="mb-2"><?= e($p['nama_produk']); ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($p['harga'], 0, ',', '.'); ?>
                            </div> 

                            <div class="product-actions">
                                <form action="User/proses/tambah_keranjang.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                                    <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']); ?>">
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
                                <a href="User/Pages/form_beli_sekarang.php?id_produk=<?= $p['id_produk']; ?>" class="btn background rounded-pill py-3 px-4 btn-beli"><span class="text-white">Beli Sekarang</span></a>
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
<!-- Produk End -->

<!-- Testimonial Start -->
<div class="container-xxl my-2 py-2 pt-0 mb-5" style="background-color: white !important;">
    <div class="container">
        <div class="text-start ms-3 mb-3 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-6 mb-3 fw-bold" 
                style="font-family: 'Rufina', serif; font-weight:700; color:#2B143B;">
                Ulasan
            </h1>

            <div class="d-flex align-items-center gap-4 mt-2">

                <h2 class="fw-bold d-flex align-items-center gap-2 m-0" 
                    style="font-family: 'Rufina', serif; color:#2B143B;">
                    <?php
                    echo number_format($rataRating, 1);
                    ?>
                </h2>

                <div class="text-center">
                <div class="d-flex align-items-center mb-1" style="font-size: 32px; color: #FFC107;">
                    <?php
                    $rating = $rataRating;    
                    $fullStars = floor($rating);
                    $halfStar = ($rating - $fullStars >= 0.25 && $rating - $fullStars < 0.75) ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                    for ($i = 0; $i < $fullStars; $i++) {
                        echo '<i class="bi bi-star-fill"></i>';
                    }
                    if ($halfStar) {
                        echo '<i class="bi bi-star-half"></i>';
                    }
                    for ($i = 0; $i < $emptyStars; $i++) {
                        echo '<i class="bi bi-star"></i>';
                    }
                    ?>
                </div>
                <p class="m-0" style="font-family:'Montserrat', sans-serif; color:#504060; font-size:14px;">
                    Rata-rata hasil dari <?php echo number_format($totalReviews);?> ulasan
                </p>
                </div>
            </div>
        </div> 
    <div class="text-start ms-3 mb-5 wow fadeInUp" data-wow-delay="0.1s">


<form method="GET" action="index.php">
    <div class="d-flex align-items-center gap-3 mt-3 w-100 flex-wrap flex-md-nowrap">

        <div class="d-flex align-items-center gap-3 flex-nowrap">
            <button type="submit" name="filtertm" value="all" 
                    class="btn rounded-pill py-3 px-4 <?= ($filtertm == 'all') ? 'filter-active' : '' ?> "
                    style="background-color: #504060;"> <span class="fw-bold fs-6 <?= ($filtertm == 'all') ? 'text-white' : '' ?>"
                    style="font-family: 'Montserrat', sans-serif; font-weight:700; color:white;">
                    Lihat Semua Ulasan →
                </span>
            </button>

            <div class="dropdown">
                <button class="btn rounded-pill py-3 px-4 dropdown-toggle" style="background-color: #E9D9DE;" data-bs-toggle="dropdown">
                    <span class="fw-bold fs-6 d-flex align-items-center gap-2" style="font-family:'Montserrat', sans-serif; font-weight:700; color:#504060;">
                        <i class="bi bi-star-fill" style="color:#FFC107;"></i> 
                        <?php
                            if ($filtertm == '5') {
                                echo "5";
                            } elseif ($filtertm == '4') {
                                echo "4";
                            } elseif ($filtertm == '3') {
                                echo "3";
                            } elseif ($filtertm == '2') {
                                echo "2";
                            } elseif ($filtertm == '1') {
                                echo "1";
                            } else {
                                echo "Filter Ulasan";
                            }
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
                        </svg>
                    </span>
                </button>

                <ul class="dropdown-menu p-2" style="border-radius:10px;">
                    <li>
                        <button type="submit" name="filtertm" value="5"
                                class="dropdown-item d-flex align-items-center gap-2 <?= ($filtertm == '5') ? 'text-white filter-active' : '' ?>"
                                style="font-family:'Montserrat'; font-weight:700;">
                            <i class="bi bi-star-fill" style="color:#FFC107;"></i> 5
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="filtertm" value="4"
                                class="dropdown-item d-flex align-items-center gap-2 <?= ($filtertm == '4') ? 'text-white filter-active' : '' ?>"
                                style="font-family:'Montserrat'; font-weight:700;">
                            <i class="bi bi-star-fill" style="color:#FFC107;"></i> 4
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="filtertm" value="3"
                                class="dropdown-item d-flex align-items-center gap-2 <?= ($filtertm == '3') ? 'text-white filter-active' : '' ?>"
                                style="font-family:'Montserrat'; font-weight:700;">
                            <i class="bi bi-star-fill" style="color:#FFC107;"></i> 3
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="filtertm" value="2"
                                class="dropdown-item d-flex align-items-center gap-2 <?= ($filtertm == '2') ? 'text-white filter-active' : '' ?>"
                                style="font-family:'Montserrat'; font-weight:700;">
                            <i class="bi bi-star-fill" style="color:#FFC107;"></i> 2
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="filtertm" value="1"
                                class="dropdown-item d-flex align-items-center gap-2 <?= ($filtertm == '1') ? 'text-white filter-active' : '' ?>"
                                style="font-family:'Montserrat'; font-weight:700;">
                            <i class="bi bi-star-fill" style="color:#FFC107;"></i> 1
                        </button>
                    </li>
                </ul>
            </div>
        </div>
            
                <a href="User/Pages/input_testimoni.php" 
                    class="btn rounded-pill py-2 px-3 text-decoration-none ms-auto ms-md-auto" 
                    style="background-color: #504060; cursor:pointer;">
                    <span class="fw-bold text-white fs-6" 
                            style="font-family: 'Montserrat', sans-serif; font-weight:700; color:white;">
                        + Tambah Ulasan
                    </span>
                </a>
        </div>
</form>
    </div>

        <div class="container mt-4">
            <div class="row g-4"> 
                <?php foreach ($resulttm as $t): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="custom-testimonial-card p-4 h-100">

                        <div class="quote-icon mb-2">
                            <i class="bi bi-quote"></i>
                        </div>

                        <div class="rating mb-3 text-center" style="color:#FFC107; font-size:22px;">
                            <?php
                            for ($i = 0; $i < 5; $i++){
                                if ($i < $t['rating']){
                                    echo '<i class="bi bi-star-fill"></i>';
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                            }
                            ?>
                        </div>

                        <p class="testimonial-text" style="font-size: 20px;">
                            “<?= e($t['pesan']); ?>”
                        </p>
                        <hr class="border border-dark" style="height: 2px;">
                        <div class="d-flex align-items-center mt-3">
                            <span class="ms-2 profile-name fw-bold"><?= e($t['nama']); ?></span>
                        </div>
                        <?php
                        $id_produk = (int)$t['id_produk'];
                        $stmt = $conn->prepare("SELECT nama_produk FROM produk WHERE id_produk = ?");
                        $stmt->bind_param("i", $id_produk);
                        $stmt->execute();
                        $result_produk = $stmt->get_result();
                        $produk = $result_produk->fetch_assoc();
                        $stmt->close();
                        ?>
                        <div class="border h-10 rounded-pill ps-2 mt-2" style="background-color: #504060;"><span class="text-light">Produk: <?= e($produk['nama_produk']);?></span></div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>
<!-- Testimonial End -->

    <?php include 'User/include/footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square rounded-circle back-to-top" style="background-color: #60405aff;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="color: white;">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
</svg></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="User/Asset/lib/wow/wow.min.js"></script>
    <script src="User/Asset/lib/easing/easing.min.js"></script>
    <script src="User/Asset/lib/waypoints/waypoints.min.js"></script>
    <script src="User/Asset/lib/counterup/counterup.min.js"></script>
    <script src="User/Asset/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="User/Asset/js/main.js"></script>


    <!-- Modal Notifikasi -->
    <div class="modal fade" id="ulasanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 p-4">

        <div class="text-center">
            <h4 class="fw-bold text-success mb-2">Ulasan Berhasil Ditambahkan!</h4>
            <p class="mb-3">Terima kasih sudah memberikan ulasan 😍</p>

            <button type="button" class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal" style="background-color: #504060;">
            Oke
            </button>
        </div>

        </div>
    </div>
    </div>

    <?php if(isset($_GET['added']) && $_GET['added'] == 'true'): ?>
        <script>
            var myModal = new bootstrap.Modal(document.getElementById('ulasanModal'));
            myModal.show();
        </script>
    <?php endif; ?>


</body>
</html>

<?php var_dump($_SESSION['csrf_token']); ?>

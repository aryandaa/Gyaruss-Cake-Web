<?php 
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
include 'include/connect.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$query = "SELECT * FROM produk limit 8"; 
if ($filter === 'Catering') {
    $query = "SELECT * FROM produk WHERE kategori = 'Catering' Limit 8";
} elseif ($filter === 'Cake') {
    $query = "SELECT * FROM produk WHERE kategori = 'Cake' Limit 8";
}
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Gyaruss Cake</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Gyaruss" name="keywords">
    <meta content="Toko kue yang ada di kalsel" name="description">
    <link href="Asset/images/logo gyarus.png" rel="icon">

    <link rel="stylesheet" href="Asset/css/index.css">
    <link rel="stylesheet" href="Asset/css/index2.css">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <?php 
    $activePage = 'beranda';
    include 'include/header.php'; 
    ?>

    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">

            <?php foreach ($bestSeller as $bs): ?>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="Asset/images/best seller/<?= $bs['gambar']; ?>" alt="">
                <div class="owl-carousel-inner">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-8">
                                <h1 class="display-1 text-color mb-4 animated slideInDown"><b>Rekomendasi</b></h1>
                                <p class="text-color fs-5 mb-4 pb-3">- Rasakan Kelezatannya</p>
                                <a href="" class="btn background rounded-pill py-3 px-5"><span class="text-white">Pesan Sekarang <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
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
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-6 mb-4"><svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16" style="color: orange;">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg> Terlaris <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16" style="color: orange;">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg></h1>
            </div>
            <div class="row g-4">
                <?php 
                foreach ($bestSeller as $bs): 
                
                ?>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="position-relative mt-auto">
                            <img class="img-fluid" src="Asset/images/best seller/<?= $bs['gambar']; ?>" alt="<?= $bs['nama']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href=""><i class="fa fa-eye text-primary"></i></a>
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
            <h1 class="display-6 mb-4 fw-bold" style="font-family: 'Rufina', serif; font-weight: 700;">Menu</h1>
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
                         <div class="position-relative mt-auto">
                            <img class="img-fluid product-image" src="Asset/images/Produk/<?= $p['gambar']; ?>" alt="<?= $p['nama_produk']; ?>">
                            <div class="product-overlay">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle" href="#">
                                    <i class="fa fa-eye text-primary"></i>
                                </a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-2"><?= $p['nama_produk']; ?></h3>
                            <div class="pt-1 px-3 mb-3">
                                Rp.<?= number_format($p['harga'], 0, ',', '.'); ?>
                            </div> 
                            <div>
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

                                <a href="" class="btn background rounded-pill py-3 px-4"><span class="text-white">Beli Sekarang</span></a>
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
        <?php
        $filtertm = isset($_GET['filtertm']) ? $_GET['filtertm'] : 'all';
        $query = "SELECT * FROM testimoni limit 8"; 
        if ($filtertm === '5') {
            $query = "SELECT * FROM testimoni WHERE rating = '5' Limit 8";
        } elseif ($filtertm === '4') {
            $query = "SELECT * FROM testimoni WHERE rating = '4' Limit 8";
        } elseif ($filtertm === '3') {
            $query = "SELECT * FROM testimoni WHERE rating = '3' Limit 8";
        } elseif ($filtertm === '2') {
            $query = "SELECT * FROM testimoni WHERE rating = '2' Limit 8";
        } elseif ($filtertm === '1') {
            $query = "SELECT * FROM testimoni WHERE rating = '1' Limit 8";
        }
        $resulttm = mysqli_query($conn, $query);
        if (!$resulttm) {
            die("Query error: " . mysqli_error($conn));
        }

        ?>


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
            
                <a href="Pages/input_testimoni.php" 
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

                        <div class="rating mb-3" style="color:#FFC107; font-size:22px;">
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

                        <p class="testimonial-text">
                            “<?= $t['pesan']; ?>”
                        </p>
                        <hr class="border border-dark" style="height: 2px;">
                        <div class="d-flex align-items-center mt-3">
                            <span class="ms-2 profile-name fw-bold"><?= $t['nama']; ?></span>
                        </div>
                        <?php
                        $id_produk = $t['id_produk'];
                        $query_produk = "SELECT nama_produk FROM produk WHERE id_produk = '$id_produk'";
                        $result_produk = mysqli_query($conn, $query_produk);
                        $produk = mysqli_fetch_assoc($result_produk);
                        ?>
                        <div class="border h-10 rounded-pill ps-2 mt-2" style="background-color: #504060;"><span class="text-light">Produk: <?= $produk['nama_produk'];?></span></div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>
</div>
<!-- Testimonial End -->

    <?php include 'include/footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square rounded-circle back-to-top" style="background-color: #60405aff;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16" style="color: white;">
  <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5"/>
</svg></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Asset/lib/wow/wow.min.js"></script>
    <script src="Asset/lib/easing/easing.min.js"></script>
    <script src="Asset/lib/waypoints/waypoints.min.js"></script>
    <script src="Asset/lib/counterup/counterup.min.js"></script>
    <script src="Asset/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="Asset/js/main.js"></script>
</body>

</html>
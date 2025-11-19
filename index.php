<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
include 'include/connect.php';
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

    <style>
        body {
        font-family: 'Rufina', serif !important;
        }
        .text-color{
            color: #2B143B !important;
        }
        .background{
            background: #2B143B !important;
        }
        .color-primary {
            color: #504060 !important;
        }
        .text-light{
            color: white !important;
        }
        .custom-testimonial-card {
        background-color: #f1dde6;
        border-radius: 20px;
        min-height: 260px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        }

        .custom-testimonial-card .quote-icon i {
            font-size: 32px;
            color: #4a2d63;
        }

        .rating i {
            font-size: 20px;
        }

        .testimonial-text {
            font-size: 15px;
            color: #4a2d63;
            line-height: 1.5;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            background-color: #4a2d63;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-icon i {
            color: white;
            font-size: 18px;
        }

        .profile-name {
            font-weight: 600;
            color: #4a2d63;
        }

        .product-image {
            width: 100% !important; 
            height: 240px !important;
            object-fit: cover !important;
        }


    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    <?php include 'include/header.php'; ?>

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
                                <p class="text-primary text-uppercase fw-bold mb-2">#Best Seller</p>
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
                </svg>Best Seller<svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16" style="color: orange;">
                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                </svg></h1>
            </div>
            <div class="row g-4">
                <?php 
                foreach ($bestSeller as $bs): 
                
                ?>
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="product-item d-flex flex-column bg-white rounded overflow-hidden h-100">
                        <div class="text-center p-4">
                            <div class="d-inline-block border border-primary rounded-pill pt-1 px-3 mb-3">
                                Rp.<?= number_format($bs['harga'], 0, ',', '.'); ?>
                            </div>
                            <h3 class="mb-3"><?= $bs['nama']; ?></h3>
                        </div>
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
                <h1 class="display-6 mb-4 fw-bold font-family: 'Rufina', serif; font-weight: 700;"><b>Menu</b></h1>
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
                                <button class="border rounded-circle" style="background-color: #2B143B;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart-plus" viewBox="0 0 16 16" style="color: white;">
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
<div class="container-xxl bg-light my-6 py-6 pb-0">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-6 mb-4">Testimoni</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">

            <?php foreach ($testimoni as $t): ?>
            <div class="custom-testimonial-card p-4">
                <div class="quote-icon mb-2">
                    <i class="bi bi-quote"></i>
                </div>
                <div class="rating mb-3">
                    <?php
                    for ($i = 0; $i < 5; $i++){
                        if ($i < $t['rating']){
                            echo '<i class="bi bi-star-fill text-warning"></i>';
                        } else {
                            echo '<i class="bi bi-star text-warning"></i>';
                        }
                    }
                    ?>
                </div>
                <p class="testimonial-text">
                    “<?= $t['pesan']; ?>”
                </p>
                <div class="d-flex align-items-center mt-3">
                    <div class="profile-icon">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <span class="ms-2 profile-name"><?= $t['nama']; ?></span>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<!-- Testimonial End -->

    <?php include 'include/footer.php'; ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
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
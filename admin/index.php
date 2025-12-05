<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');

include 'include/connect.php';
include __DIR__ . "/include/config.php";     
session_start();
if(isset($_SESSION['nama'])){
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <title>Dashboard Admin</title>

    <link href="<?= $base_url ?>Admin/Asset/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/vendor/fontawesome-7.1.0/css/all.min.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <link href="<?= $base_url ?>Admin/Asset/vendor/bootstrap-5.3.8.min.css" rel="stylesheet" media="all">

    <link href="<?= $base_url ?>Admin/Asset/css/aos.css"  rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/css/swiper-bundle-12.0.3.min.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.css" rel="stylesheet" media="all">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link href="<?= $base_url ?>Admin/Asset/css/theme.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/css/style2.css" rel="stylesheet" media="all">
    <link href="<?= $base_url ?>Admin/Asset/css/testimoni.css" rel="stylesheet" media="all">
    <style></style>
</head>

<body>
    <div class="page-wrapper">

        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none ">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">

                            <!-- Logo -->
                            <img src="<?= $base_url ?>User/Asset/images/logo gyarus.png"
                               class="img-fluid"
                                style="max-width: 120px;"/>
                        
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>

                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li>
                            <p class="m-0 fw-bold">hello, <?php echo $_SESSION['nama']; ?></p>
                        </li>
                        <li>
                            <div class="navbar-nav ms-lg-auto align-items-center w-100 d-flex justify-content-center">
                        <form class="d-flex mx-lg-auto my-3 my-lg-0 position-relative" autocomplete="off">
                            <input class="form-control rounded-pill border-0 shadow-sm"
                                    id="liveSearch"
                                    type="search" 
                                    placeholder="Cari..."
                                    style="background:#F5F6FA; width: 380px!important; border-color:#D5D5D5;" />

                             <!-- Produk yang muncul -->
                            <div id="searchResult"
                                class="position-absolute bg-white shadow-sm rounded p-2"
                                style="top:45px; width:380px; display:none; z-index:9999;">
                            </div>

                        </form>
                        </div>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt me-3"></i>Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="?p=produk">
                                <i class="bi bi-grid-fill me-3"></i>Produk
                            </a>
                        </li>

                        <li>
                            <a href="?p=testimoni">
                                <i class="fas fa-pen me-3"></i>Ulasan
                            </a>
                        </li>

                        <li class="mt-2">
                            <a class="fw-bold" href="proses/logout.php">
                                <span class="text-danger"><i class="fas fa-power-off me-3"></i>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <?php $page = $_GET['p'] ?? 'pesanan'; ?>
        <aside class="menu-sidebar d-none d-lg-block ">
            <!-- logo -->   
            <div class="logo d-flex justify-content-center mb-4 mt-3" style="background-color: white;">
                <img src="<?= $base_url ?>User/Asset/images/logo gyarus.png" 
                     alt="Gyaruss Logo"
                     class="img-fluid"
                     style="max-width: 160px;">
            </div>

            <div class="menu-sidebar__content js-scrollbar1 p-0">
                <nav class="navbar-sidebar p-0">
                    <ul class="list-unstyled navbar__list m-0 p-0">

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center justify-content-start w-100 px-3 <?= ($page == 'pesanan') ? 'active text-white' : '' ?>"
                                href="?p=pesanan">
                                <i class="fas fa-tachometer-alt me-3"></i>Dashboard
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center justify-content-start w-100 px-3 <?= ($page == 'produk') ? 'active text-white' : '' ?>" 
                                href="?p=produk">
                                <i class="bi bi-grid-fill me-3"></i>
                                Produk
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center justify-content-start w-100 px-3 <?= ($page == 'testimoni') ? 'active text-white' : '' ?>" 
                                href="?p=testimoni">
                                <i class="fas fa-pen me-3"></i>
                                Ulasan
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <a class="nav-link text-danger fw-bold d-flex align-items-center justify-content-start w-100 px-3"
                                href="proses/logout.php">
                                <i class="fas fa-power-off me-3"></i>
                                Logout
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop" style="background-color: #504060;">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">

                        <!-- Search -->
                        <div class="navbar-nav ms-lg-auto align-items-center w-100 d-flex justify-content-center">
                        <form class="d-flex mx-lg-auto my-3 my-lg-0 position-relative" autocomplete="off">
                            <input class="form-control rounded-pill border-0 shadow-sm"
                                    id="liveSearch"
                                    type="search" 
                                    placeholder="Cari..."
                                    style="background:#F5F6FA; width: 380px!important; border-color:#D5D5D5;" />

                             <!-- Produk yang muncul -->
                            <div id="searchResult"
                                class="position-absolute bg-white shadow-sm rounded p-2"
                                style="top:45px; width:380px; display:none; z-index:9999;">
                            </div>

                        </form>
                        </div>

                        <div class="header-button">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                        <div class="content">
                                            <p class="text-template font"><b><?php echo$_SESSION['nama']; ?></b></p>
                                            <p class="text-template font">Admin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->

            <!-- main content start -->

            <div class="main-content" style="background-color: white;">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <?php
                            $pages_dir = __DIR__ . '/pages/';

                            if (isset($_GET['p']) && !empty($_GET['p'])) {
                                $page = basename($_GET['p']) . '.php'; // cegah path traversal

                                if (file_exists($pages_dir . $page)) {
                                    include $pages_dir . $page;
                                } else {
                                    echo "<h3 class='text-danger text-center mt-5'>Halaman tidak ditemukan!</h3>";
                                }

                            } else {
                                include $pages_dir . '/pesanan.php'; // default halaman pertama
                            }
                        ?>
                    </div>
                </div>
            </div>

            <!-- main content end -->
        <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?= $base_url ?>Admin/Asset/js/vanilla-utils.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?= $base_url ?>Admin/Asset/vendor/bootstrap-5.3.8.bundle.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?= $base_url ?>Admin/Asset/vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= $base_url ?>Admin/Asset/vendor/chartjs/chart.umd.js-4.5.1.min.js"></script>

    <!-- Main JS-->
    <script src="<?= $base_url ?>Admin/Asset/js/bootstrap5-init.js"></script>
    <script src="<?= $base_url ?>Admin/Asset/js/main-vanilla.js"></script>
    <script src="<?= $base_url ?>Admin/Asset/js/swiper-bundle-12.0.3.min.js"></script>
    <script src="<?= $base_url ?>Admin/Asset/js/aos.js"></script>
    <script src="<?= $base_url ?>Admin/Asset/js/modern-plugins.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $("#liveSearch").keyup(function () {
        let query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "<?= $base_url ?>Admin/proses/search.php",
                type: "GET",
                data: { q: query },
                success: function (data) {
                    $("#searchResult").html(data).show();
                }
            });
        } else {
            $("#searchResult").hide();
        }
    });

    $(document).click(function(e){
        if (!$(e.target).closest('#liveSearch,#searchResult').length) {
            $("#searchResult").hide();
        }
    });
});
</script>

</body>

</html>
<!-- end document-->
<?php
}else {
header('location: pages/login.php');
}
?>
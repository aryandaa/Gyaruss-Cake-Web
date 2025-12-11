    <?php 
    include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";

    ?>

    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700;1,700&family=Rufina:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= $base_url ?>User/Asset/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= $base_url ?>User/Asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    
    <style>
        .navbar * {
        font-family: "Montserrat", sans-serif !important;
        }

        .navbar input.form-control {
        font-size: 14px;
        padding: 6px 12px;
        transition: all 0.3s ease;
        }

        .navbar input.form-control:focus {
        box-shadow: 0 0 5px rgba(33, 150, 243, 0.4);
        outline: none;
        }

        .navbar .btn-outline-primary {
        border-color: #6c63ff;
        color: #6c63ff;
        }

        .navbar .btn-outline-primary:hover {
        background-color: #6c63ff;
        color: white;
        }

        #searchInput {
        width: 240px !important;
        }

        .icon-large {
            width: 1.6rem;
            height: 1.6rem;
            color: white;
        }

        .navbar-nav .nav-link {
            position: relative;
            font-weight: 600;
            padding-bottom: 6px;
            display: inline-block;
        }

        /* ACTIVE */
        .navbar-nav .nav-link.active {
            color: #2B143B !important;
        }

        .navbar-nav .nav-link.active::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -2px; 
            transform: translateX(-50%);
            width: 55%;              /* panjang garis (sesuaikan) */
            height: 3px;
            background: #2B143B;
            border-radius: 20px;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 9999;
            background: #ffffff !important; 
            backdrop-filter: none !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .navbar-light {
            background-color: #ffffff !important;
        }
        
        .search-item:hover {
            background-color: #f8f4f8;
            border-radius: 8px;
        }


    </style>
    
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-lg-0 px-lg-5" style="background-color: white;">

    <!-- LOGO -->
    <a class="navbar-brand ms-4 ms-lg-0" href="#">
        <img src="<?= $base_url ?>User/Asset/images/logo gyarus.png" alt="Logo" style="height: 60px;">
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler me-4 bg-white border-0 shadow-none" type="button"
        data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        style="background:white !important;">
    <span class="navbar-toggler-icon"></span>
</button>


    <!-- NAV CONTENT -->
    <div class="collapse navbar-collapse" id="navbarCollapse">

        <!-- SEARCH BAR -->
    <div class="navbar-nav ms-lg-auto align-items-center w-100 d-flex justify-content-center">
    <form class="d-flex mx-lg-auto my-3 my-lg-0 position-relative" autocomplete="off">

        <!-- SEARCH INPUT -->
        <input class="form-control rounded-pill border-0 shadow-sm"
               id="liveSearch"
               type="search"
               placeholder="Cari..."
               style="background:#F5F6FA; width: 380px!important; border-color:#D5D5D5;">

        <!-- SEARCH RESULT DROPDOWN -->
        <div id="searchResult"
             class="position-absolute bg-white shadow-sm rounded p-2"
             style="top:45px; width:380px; display:none; z-index:9999;">
        </div>

    </form>
    </div>


        <!-- MENU -->
        <div class="navbar-nav ms-lg-auto align-items-center">
            <a href="<?= $base_url ?>index.php" class="nav-item nav-link text-color fs-5 px-2 py-3 <?php echo ($activePage == 'beranda') ? 'active' : ''; ?>">Beranda</a>
            <a href="<?= $base_url ?>User/Pages/katalog.php" class="nav-item nav-link text-color fs-5 px-2 py-3 <?php echo ($activePage == 'Menu') ? 'active' : ''; ?>">Menu</a>
            <a href="<?= $base_url ?>User/Pages/testimoni.php" class="nav-item nav-link text-color fs-5 px-2 py-3 <?php echo ($activePage == 'Ulasan') ? 'active' : ''; ?>">Ulasan</a>

            <!-- CART ICON -->
            <a href="<?= $base_url ?>User/Pages/keranjang.php" class="nav-item nav-link text-color fs-5 <?php echo ($activePage == 'keranjang') ? 'active' : ''; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="35" height="35" fill="currentColor">
                    <path d="M320 64C326.6 64 332.9 66.7 337.4 71.5L481.4 223.5L481.9 224L560 224C577.7 224 592 238.3 592 256C592 270.5 582.4 282.7 569.2 286.7L523.1 493.9C516.6 523.2 490.6 544 460.6 544L179.3 544C149.3 544 123.3 523.2 116.8 493.9L70.8 286.7C57.6 282.8 48 270.5 48 256C48 238.3 62.3 224 80 224L158.1 224L158.6 223.5L302.6 71.5C307.1 66.7 313.4 64 320 64zM320 122.9L224.2 224L415.8 224L320 122.9zM240 328C240 314.7 229.3 304 216 304C202.7 304 192 314.7 192 328L192 440C192 453.3 202.7 464 216 464C229.3 464 240 453.3 240 440L240 328zM320 304C306.7 304 296 314.7 296 328L296 440C296 453.3 306.7 464 320 464C333.3 464 344 453.3 344 440L344 328C344 314.7 333.3 304 320 304zM448 328C448 314.7 437.3 304 424 304C410.7 304 400 314.7 400 328L400 440C400 453.3 410.7 464 424 464C437.3 464 448 453.3 448 440L448 328z"></path>
                </svg>

            </a>
        </div>

    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    $("#liveSearch").keyup(function () {
        let query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "<?= $base_url ?>User/proses/search.php",
                method: "GET",
                data: { q: query },
                success: function (data) {
                    $("#searchResult").html(data);
                    $("#searchResult").show();
                }
            });
        } else {
            $("#searchResult").hide();
        }
    });

    // Klik di luar → hide
    $(document).click(function(e){
        if (
            !$(e.target).closest('#liveSearch').length &&
            !$(e.target).closest('#searchResult').length
        ) {
            $("#searchResult").hide();
        }
    });
});
</script>

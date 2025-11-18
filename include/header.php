    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,700;1,700&family=Rufina:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="Asset/lib/animate/animate.min.css" rel="stylesheet">
    <link href="Asset/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <!-- Template Stylesheet -->
    <link href="Asset/css/styleindex.css" rel="stylesheet">
    
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
        color: #fff;
        }

        #searchInput {
        width: 240px !important;
        }


    </style>
    
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-lg-0 px-lg-5" 
     style="background-color: #e3f2fd;">

    <!-- LOGO -->
    <a class="navbar-brand ms-4 ms-lg-0" href="#">
        <img src="Asset/images/logo gyarus.png" alt="Logo" style="height: 60px;">
    </a>

    <!-- TOGGLER -->
    <button class="navbar-toggler me-4" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- NAV CONTENT -->
    <div class="collapse navbar-collapse" id="navbarCollapse">

        <!-- SEARCH BAR (selalu center di desktop, full di mobile) -->
        <form class="d-flex mx-lg-auto my-3 my-lg-0" onsubmit="return false;">
            <input class="form-control rounded-pill border-0 shadow-sm"
                   id="searchInput" 
                   type="search"
                   placeholder="Cari..." 
                   style="background:#fff; width: 200px;">
        </form>

        <!-- MENU -->
        <div class="navbar-nav ms-lg-auto align-items-center">
            <a href="#" class="nav-item nav-link active">Home</a>
            <a href="#" class="nav-item nav-link text-color">Menu</a>
            <a href="#" class="nav-item nav-link text-color">Ulasan</a>

            <!-- CART ICON -->
            <a href="#" class="nav-item nav-link text-color">
                <i class="bi bi-basket" style="font-size: 1.6rem;"></i>
            </a>
        </div>

    </div>
</nav>



    <script>
document.getElementById("searchInput").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    let items = document.querySelectorAll(".product-item"); // card produk

    items.forEach(function (item) {
        let name = item.querySelector("h3, h4").innerText.toLowerCase();

        if (name.includes(filter)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
});
</script>

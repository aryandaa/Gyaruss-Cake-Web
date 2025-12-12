   <?php 
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";

    ?>
   
   <style>
    .text-ungu {
        color: #2B143B;
    }
    .font-montserrat {
        font-family: 'Montserrat', sans-serif !important;
        font-weight: 200 !important;
    }
    
    .montserrat-font {
    font-family: "Montserrat", sans-serif !important;
    font-optical-sizing: auto;
    font-weight: 200 !important;
    font-style: normal !important;
    }

    .lokasi-wrapper {
    max-width: 1000px; /* bisa adjust biar sesuai desain */
    margin: 0 auto; /* ini yang bikin center */
    }

    a {
    text-decoration: none !important;
    }

   </style>
   

 <div class="container-fluid py-5" style="background-color:#f1dde6;">
    <div class="container py-5">

        <div class="row g-5 align-items-start">

            <!-- Lokasi & Sosmed -->
            <div class="col-lg-4 col-md-6">
                <h4 class="text-ungu mb-1 fs-3">Lokasi Gyaruss Cake</h4>

                <!-- Rating -->
                <div class="d-flex align-items-center mt-1 mb-3" style="font-size:32px; color:#FFC107;">
                    <?php
                    $rating = $rataRating;    
                    $fullStars = floor($rating);
                    $halfStar = ($rating - $fullStars >= 0.25 && $rating - $fullStars < 0.75) ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;

                    for ($i = 0; $i < $fullStars; $i++) echo '<i class="bi bi-star-fill"></i>';
                    if ($halfStar) echo '<i class="bi bi-star-half"></i>';
                    for ($i = 0; $i < $emptyStars; $i++) echo '<i class="bi bi-star"></i>';
                    ?>
                </div>

                <!-- Alamat -->
                <p class="text-ungu mb-4 fs-6">
                    Jl. Komplek Mahatama Regency, Blok B5, No. 108 <br>
                    Kel. Tanjung Pagar, <br>
                    Banjarmasin <br>
                    70234
                </p>

                <!-- Sosial Media -->
                <h4 class="text-ungu mb-3 fs-3">Sosial Media</h4>

                <p class="mb-2 d-flex align-items-center">
                    <i class="bi bi-whatsapp me-3 fs-4"></i>
                    <span class=""><a href="https://wa.me/6281348034658" 
                                    class="text-ungu montserrat-font">0813-4803-4658</a></span>
                </p>

                <p class="mb-2 d-flex align-items-center">
                    <i class="bi bi-instagram me-3 fs-4"></i>
                    <span class=""><a href="https://www.instagram.com/nur_alimah84?igsh=MXBzejMxZG1wdW94bA=="
                                    class="text-ungu montserrat-font">nur_alimah84</a></span>
                </p>

            </div>

            
            <!-- MAP -->
            <div class="col-lg-4 col-md-6 mt-5">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127962.52375539638!2d114.51823311016532!3d-3.357123799999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de421e31a001119%3A0x799d4a8be57fe70f!2sGyaruss%20Cake!5e0!3m2!1sid!2sid!4v1706517360000!5m2!1sid!2sid"
                    width="100%"
                    height="300"
                    style="border:0; border-radius:12px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    class="border" >
                </iframe>
            </div>

            <!-- Logo + Jam Buka -->
            <div class="col-lg-4 col-md-6 text-center mt-5">
                <img src="<?= $base_url ?>User/Asset/images/logo gyarus.png" class="img-fluid mb-3" style="max-width:150px;" alt="Logo">
                <p class="text-ungu fs-6">
                    Kelezatan yang <br>Merayakan Momen Anda
                </p>

                <h3 class="text-ungu mt-4"><b>Jam Buka</b></h3>
                <p class="text-ungu fs-6">
                    Buka Setiap Hari <br>
                    <b>24 Jam</b>
                </p>
            </div>

        </div>
    </div>
</div>

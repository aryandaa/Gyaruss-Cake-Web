<?php
$from = isset($_GET['from']) ? $_GET['from'] : '/index.php';
include "../proses/proses_detail-produk.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Produk</title>

    <link rel="icon" href="../Asset/images/logo gyarus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-white">

<!-- LOGO TOP -->
<div class="container mt-4 text-center">
    <img src="../Asset/images/logo gyarus.png" 
         alt="Gyaruss Cake" 
         style="width:160px;">
</div>

<!-- DETAIL PRODUK -->
<div class="container my-5">

    <h2 class="fw-bold mb-4" style="color:#2B143B;">Detail Produk</h2>

    <div class="row g-4 align-items-start">

        <!-- GAMBAR -->
        <div class="col-lg-6">
            <div class="shadow rounded overflow-hidden">
                <img src="../Asset/images/Produk/<?php echo $data['gambar']; ?>" 
                     class="img-fluid w-100"
                     alt="<?php echo $data['nama_produk']; ?>">
            </div>
        </div>

        <!-- INFORMASI PRODUK -->
        <div class="col-lg-6">

            <h3 class="fw-bold" style="color:#2B143B;">
                <?= $data['nama_produk']; ?>
            </h3>

            <p class="mt-3" style="color:#504060; line-height:1.7;">
                <?= nl2br($data['deskripsi']); ?>
            </p>

            <h4 class="fw-bold mt-4 mb-2" style="color:#2B143B;">Harga</h4>

            <!-- HARGA -->
            <div class="px-4 py-2 rounded-pill d-inline-block mb-4"
                 style="background-color:#E9D9DE; color:#504060; font-weight:700; font-size:18px;">
                Rp <?= number_format($data['harga'], 0, ',', '.'); ?>
            </div>

            <!-- BUTTONS -->
            <div class="d-flex gap-3 mt-3">

                <!-- KEMBALI -->
                <a href="../<?= $from; ?>" 
                   class="btn border-2 rounded-pill px-4 py-2 fw-bold"
                   style="border-color:#504060; color:#504060;">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu
                </a>

                <!-- PESAN SEKARANG -->
                <form action="../proses/tambah_keranjang.php" method="POST">
                    <input type="hidden" name="id_produk" value="<?= $data['id_produk']; ?>">
                    <button class="btn rounded-pill px-4 py-2 fw-bold text-white"
                            style="background-color:#504060;">
                        Pesan Sekarang <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

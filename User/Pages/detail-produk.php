<?php
session_abort();
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";


$from = isset($_GET['from']) ? $_GET['from'] : '../../index.php';
include "../proses/proses_detail-produk.php";

$from = $_GET['from'] ?? 'menu';

switch ($from) {
    case 'search':
        $backUrl = '../../index.php';
        break;

    case 'menu':
        $backUrl = './katalog.php';
        break;

    default:
        $backUrl = '../../index.php'; 
}

$id_produk = $data['id_produk'];

$ulasan = mysqli_query($conn, "
    SELECT nama, pesan, rating
    FROM testimoni 
    WHERE id_produk = '$id_produk'
    and aktif = 1
");

$qAvg = mysqli_query($conn, "
    SELECT AVG(rating) AS rata_rating 
    FROM testimoni 
    WHERE id_produk = '$id_produk'
    and aktif = 1
");
$AVGrating = mysqli_fetch_assoc($qAvg);
$rataRatingprd = $AVGrating['rata_rating'] ?? 0;

// Hitung jumlah rating per bintang (1–5) khusus produk ini
$ratingCount = [];
$q = mysqli_query($conn, "
    SELECT rating, COUNT(*) AS total
    FROM testimoni
    WHERE id_produk = '$id_produk'
    and aktif = 1
    GROUP BY rating
");

while ($row = mysqli_fetch_assoc($q)) {
    $ratingCount[$row['rating']] = $row['total'];
}

// Pastikan semua level rating (1–5) ada nilainya
for ($i = 1; $i <= 5; $i++) {
    if (!isset($ratingCount[$i])) {
        $ratingCount[$i] = 0;
    }
}

//menampilkan jumlah Testimoni
$sql = "SELECT COUNT(*) AS total_reviews FROM testimoni WHERE id_produk = '$id_produk' and aktif = 1;";
$totalReviewsResult = mysqli_query($conn, $sql);
$totalReviewsRow = mysqli_fetch_assoc($totalReviewsResult);
$totalReviews = $totalReviewsRow['total_reviews'];

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

            <h4 class="fw-bold mt-4" style="color:#504060;">Harga</h4>

            <!-- HARGA -->
            <div class="px-1 py-2 d-inline-block mb-4"
                 style="color:#504060; font-weight:700; font-size:18px;">
                - Rp <?= number_format($data['harga'], 0, ',', '.'); ?>
            </div>

            <h4 class="fw-bold mt-2 mb-2" style="color:#504060;">Estimasi Pesanan</h4>

            <div class="px-1 py-2 d-inline-block mb-4"
                 style="color:#504060; font-weight:700; font-size:18px;">
                - "2 - 4 Hari"
            </div>

            <!-- BUTTONS -->
            <div class="d-flex gap-3 mt-3">

                <!-- KEMBALI -->
                <a href="<?= $backUrl ?>" 
                   class="btn border-2 rounded-pill px-4 py-2 fw-bold"
                   style="border-color:#504060; color:#504060;">
                    <i class="bi bi-arrow-left"></i> Kembali ke Menu
                </a>

                <!-- PESAN SEKARANG -->
                <a href="form_beli_sekarang.php?id_produk=<?= $data['id_produk']; ?>" 
                    class="btn rounded-pill px-4 py-2 fw-bold text-white"
                    style="background-color:#504060;";>
                    Pesan Sekarang <i class="bi bi-arrow-right"></i>
                </a>
            </div>

        </div>

    </div>

</div>

<!-- ULASAN PRODUK -->
<div class="container my-5">

    <h3 class="fw-bold mb-4" style="color:#2B143B;">Ulasan Produk</h3>

    <?php if (mysqli_num_rows($ulasan) == 0): ?>
        
        <p class="text-muted">Belum ada ulasan untuk produk ini.</p>

    <?php else: ?>

            <div class="d-flex align-items-center gap-4 mt-2">

                <h2 class="fw-bold d-flex align-items-center gap-2 m-0" 
                    style="font-family: 'Rufina', serif; color:#504060;">
                    <?php
                    echo number_format($rataRatingprd, 1);
                    ?>
                </h2>

                <div class="text-center">
                <div class="d-flex align-items-center mb-1" style="font-size: 32px; color: #FFC107;">
                    <?php
                    $rating = $rataRatingprd;    
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

        <?php while ($u = mysqli_fetch_assoc($ulasan)): ?>

            <?php 
                // generate star
                $rating = $u['rating'];
                $fullStars = floor($rating);
                $halfStar = ($rating - $fullStars >= 0.25 && $rating - $fullStars < 0.75) ? 1 : 0;
                $emptyStars = 5 - $fullStars - $halfStar;
            ?>

            <div class="p-3 mb-4 rounded shadow-sm"
                 style="background:#F8F4F8; border-left:6px solid #504060;">

                <!-- Nama + Bintang -->
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong style="color:#504060;">
                        <?= htmlspecialchars($u['nama']); ?>
                    </strong>

                    <!-- BINTANG -->
                    <div class="d-flex align-items-center" style="font-size:20px; color:#FFC107;">
                        <?php
                            for ($i = 0; $i < $fullStars; $i++) echo '<i class="bi bi-star-fill"></i>';
                            if ($halfStar) echo '<i class="bi bi-star-half"></i>';
                            for ($i = 0; $i < $emptyStars; $i++) echo '<i class="bi bi-star"></i>';
                        ?>
                    </div>
                </div>

                <!-- Isi Ulasan -->
                <p class="m-0" style="color:#504060; line-height:1.6;">
                    “<?= nl2br(htmlspecialchars($u['pesan'])); ?>”
                </p>

            </div>

        <?php endwhile; ?>

    <?php endif; ?>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

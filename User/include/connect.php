<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php';

//index.php = 
//menampilkan semua Produk dan filter kategorinya:
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Default: tampilkan 3 Cake + 3 Catering
if ($filter === 'all') {
    $query = "
        (SELECT * FROM produk 
        WHERE kategori = 'Cake' AND aktif = 1 
        LIMIT 4)
        UNION ALL
        (SELECT * FROM produk 
        WHERE kategori = 'Catering' AND aktif = 1 
        LIMIT 4)
    ";
}
// Filter Catering
elseif ($filter === 'Catering') {
    $query = "
        SELECT * FROM produk 
        WHERE kategori = 'Catering' AND aktif = 1 
        LIMIT 8
    ";
}
// Filter Cake
elseif ($filter === 'Cake') {
    $query = "
        SELECT * FROM produk 
        WHERE kategori = 'Cake' AND aktif = 1 
        LIMIT 8
    ";
}

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}



//Menampilkan Best Seller
$sql = "SELECT * FROM produk WHERE best_seller = 1 and aktif = 1 LIMIT 2";
$bestSeller = mysqli_query($conn, $sql);

//menampilkan Testimoni dan filter ratingnya:
$filtertm = isset($_GET['filtertm']) ? $_GET['filtertm'] : 'all';
$query = "SELECT * FROM testimoni WHERE aktif = 1 limit 6"; 
    if ($filtertm === '5') {
        $query = "SELECT * FROM testimoni WHERE rating = '5' and aktif = 1 Limit 8";
    } elseif ($filtertm === '4') {
        $query = "SELECT * FROM testimoni WHERE rating = '4' and aktif = 1 Limit 8";
    } elseif ($filtertm === '3') {
        $query = "SELECT * FROM testimoni WHERE rating = '3' and aktif = 1 Limit 8";
    } elseif ($filtertm === '2') {
        $query = "SELECT * FROM testimoni WHERE rating = '2' and aktif = 1 Limit 8";
    } elseif ($filtertm === '1') {
        $query = "SELECT * FROM testimoni WHERE rating = '1' and aktif = 1 Limit 8";
    }
    $resulttm = mysqli_query($conn, $query);
    if (!$resulttm) {
        die("Query error: " . mysqli_error($conn));
    }

//menampilkan Rata-Rata Testimoni
$sql = "SELECT AVG(rating) AS rata_rating FROM testimoni;";
$AVG = mysqli_query($conn, $sql);
$AVGrating = mysqli_fetch_assoc($AVG);
$rataRating = $AVGrating['rata_rating'];

//menampilkan jumlah Testimoni
$sql = "SELECT COUNT(*) AS total_reviews FROM testimoni;";
$totalReviewsResult = mysqli_query($conn, $sql);
$totalReviewsRow = mysqli_fetch_assoc($totalReviewsResult);
$totalReviews = $totalReviewsRow['total_reviews'];

//input_testimoni.php: 
//dropdown produk
$sql = "SELECT * FROM produk WHERE aktif = 1;";
$produkList = mysqli_query($conn, $sql);
//menghitung total value berdasarkan jawaban
$ratingCount = [];
$q = mysqli_query($conn, "
    SELECT rating, COUNT(*) AS total
    FROM testimoni
    GROUP BY rating");
while ($row = mysqli_fetch_assoc($q)) {
    $ratingCount[$row['rating']] = $row['total'];
}
for ($i = 1; $i <= 5; $i++) {
    if (!isset($ratingCount[$i])) {
        $ratingCount[$i] = 0;
    }
}
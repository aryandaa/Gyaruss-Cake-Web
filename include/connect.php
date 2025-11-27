<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "gyaruss_cake";
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//index.php = 
//menampilkan semua Produk:
$sql = "SELECT * FROM produk LIMIT 8";
$result = mysqli_query($conn, $sql);
//Menampilkan Best Seller
$sql = "SELECT * FROM produk WHERE best_seller = 1 LIMIT 3";
$bestSeller = mysqli_query($conn, $sql);
//menampilkan Testimoni
$sql = "SELECT * FROM testimoni LIMIT 6";
$testimoni = mysqli_query($conn, $sql);
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
$sql = "SELECT * FROM produk;";
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
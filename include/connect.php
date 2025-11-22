<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "gyaruss_cake";
$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//index.php = Produk
$sql = "SELECT * FROM produk LIMIT 8";
$result = mysqli_query($conn, $sql);
//index.php = Best Seller
$sql = "SELECT * FROM bestseller LIMIT 3";
$bestSeller = mysqli_query($conn, $sql);
//index.php = Testimoni
$sql = "SELECT * FROM testimoni";
$testimoni = mysqli_query($conn, $sql);
//index.php = Rata-Rata Testimoni
$sql = "SELECT AVG(rating) AS rata_rating FROM testimoni;";
$AVG = mysqli_query($conn, $sql);
$AVGrating = mysqli_fetch_assoc($AVG);
$rataRating = $AVGrating['rata_rating'];
//index.php = Total Testimoni
$sql = "SELECT COUNT(*) AS total_reviews FROM testimoni;";
$totalReviewsResult = mysqli_query($conn, $sql);
$totalReviewsRow = mysqli_fetch_assoc($totalReviewsResult);
$totalReviews = $totalReviewsRow['total_reviews'];
//relasi produk & testimoni
$sql = "SELECT produk.id_produk, produk.nama_produk, COUNT(testimoni.id_testimoni) AS jumlah_testimoni
        FROM produk
        LEFT JOIN testimoni ON produk.id_produk = testimoni.id_produk
        GROUP BY produk.id_produk, produk.nama_produk;";
$produkTestimoni = mysqli_query($conn, $sql);


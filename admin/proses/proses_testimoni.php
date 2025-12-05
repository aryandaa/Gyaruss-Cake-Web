<?php
include __DIR__ . '/../include/connect.php';
include __DIR__ . '/../include/config.php';


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
?>
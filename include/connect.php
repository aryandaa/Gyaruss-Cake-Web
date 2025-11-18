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

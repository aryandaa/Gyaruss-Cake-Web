<?php
/// Default: LOCAL dulu
$base_url = "http://localhost/Gyruss-Cake-Web/";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "gyaruss_cake";

// override jika bukan localhost
// if (!strpos($_SERVER['HTTP_HOST'], 'localhost')) {
//     $base_url = "https://" . $_SERVER['HTTP_HOST'] . "/";
//     $db_host = "localhost";
//     $db_user = "db_host_user";
//     $db_pass = "db_host_pass";
//     $db_name = "db_host_name";
// }

// koneksi database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

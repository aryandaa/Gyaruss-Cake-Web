<?php
if (isset($_SERVER['HTTP_HOST']) && 
    ($_SERVER['HTTP_HOST'] === 'localhost' || 
     $_SERVER['HTTP_HOST'] === '127.0.0.1')) {

    // LOCAL
    $base_url = "http://localhost/Gyruss-Cake-Web/";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "gyaruss_cake";

} else {

    // HOSTING
    $base_url = "https://gyarusscake.my.id/";
    $db_host = "localhost";
    $db_user = "gyarusca_gyaruss";
    $db_pass = "Mud]XC}%Ef}SO%o0"; 
    $db_name = "gyarusca_gyaruss_cake";
}

// koneksi database
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

<?php
session_start();
include '../include/connect.php';

if (!isset($_GET['id'])) {
    header('Location: keranjang.php');
    exit();
}

$id_cart = $_GET['id'];

// Hapus baris keranjang
$query = "DELETE FROM cart WHERE id_cart = '$id_cart'";
mysqli_query($conn, $query);

header('Location: ../Pages/keranjang.php');
exit();
?>

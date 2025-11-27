<?php
session_start();
include '../include/connect.php';

if (!isset($_GET['id'])) {
    header('Location: ../Pages/keranjang.php');
    exit();
}

$id_cart = $_GET['id'];

$query = "UPDATE cart SET qty = qty + 1 WHERE id_cart = '$id_cart'";
mysqli_query($conn, $query);

header('Location: ../Pages/keranjang.php');
exit();
?>

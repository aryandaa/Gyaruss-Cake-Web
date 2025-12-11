<?php
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";


$id = mysqli_real_escape_string($conn, $_GET['id'] ?? '');
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id'"));

if (!$data) {
    echo "id tidak ditemukan.";
    exit;
}

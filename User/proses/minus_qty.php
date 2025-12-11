<?php
session_start();
function smartInclude($local, $hosting) {
    if (file_exists($local)) {
        include $local;
    } elseif (file_exists($hosting)) {
        include $hosting;
    } else {
        die("Include gagal: file tidak ditemukan");
    }
}

smartInclude(
    $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php', // local
    $_SERVER['DOCUMENT_ROOT'] . '/config.php'                  // hosting
);
smartInclude(
    $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/secure.php', // local
    $_SERVER['DOCUMENT_ROOT'] . '/secure.php'                  // hosting
);

if (!isset($_GET['id'])) {
    header('Location: ../Pages/keranjang.php');
    exit();
}

$id_cart = $_GET['id'];

// Ambil qty sekarang
$q = mysqli_query($conn, "SELECT qty FROM cart WHERE id_cart = '$id_cart'");
$data = mysqli_fetch_assoc($q);
$qty = $data['qty'];

if ($qty > 1) {
    // Bisa dikurangi
    $query = "UPDATE cart SET qty = qty - 1 WHERE id_cart = '$id_cart'";
    mysqli_query($conn, $query);
} else {
    // Kalau qty = 1 dan dikurangi → hapus produk
    mysqli_query($conn, "DELETE FROM cart WHERE id_cart = '$id_cart'");
}

header('Location: ../Pages/keranjang.php');
exit();
?>

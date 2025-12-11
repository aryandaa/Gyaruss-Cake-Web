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

include '../include/init_cart.php'; // mengambil cart_token

$id_produk = $_POST['id_produk'];

// cek apakah produk ini sudah ada di keranjang user
$cek = mysqli_query($conn, "SELECT * FROM cart 
                            WHERE cart_token='$cart_token' 
                            AND id_produk='$id_produk'");

if (mysqli_num_rows($cek) > 0) {
    // produk sudah ada -> qty + 1
    mysqli_query($conn, "UPDATE cart 
                         SET qty = qty + 1 
                         WHERE cart_token='$cart_token' 
                         AND id_produk='$id_produk'");
} else {
    // produk belum ada -> insert baru
    mysqli_query($conn, "INSERT INTO cart (cart_token, id_produk, qty)
                         VALUES ('$cart_token', '$id_produk', 1)");
}

header("Location: ../Pages/keranjang.php");
exit;
?>
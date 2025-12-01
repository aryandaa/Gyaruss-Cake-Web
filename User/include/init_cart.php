<?php
include "connect.php";
if (!isset($_COOKIE['cart_token'])) {
    $token = bin2hex(random_bytes(16));
    setcookie('cart_token', $token, time() + (86400 * 30), "/");
} else {
    $token = $_COOKIE['cart_token'];
}

$cart_token = $token;
?>

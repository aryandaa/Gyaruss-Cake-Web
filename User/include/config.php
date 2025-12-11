<?php
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // LOCAL
    $base_url = "http://localhost/Gyruss-Cake-Web/";
} else {
    // HOSTING
    $base_url = "https://" . $_SERVER['HTTP_HOST'] . "/";
}
?>

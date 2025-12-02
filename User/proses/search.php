<?php
include "../include/connect.php";
include "../include/config.php";

$keyword = mysqli_real_escape_string($conn, $_GET['q']);

if ($keyword == "") {
    echo "";
    exit;
}

$query = "SELECT id_produk, nama_produk, gambar, harga FROM produk 
          WHERE nama_produk LIKE '%$keyword%' LIMIT 5";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<div class='p-2 text-muted'>Produk tidak ditemukan...</div>";
    exit;
}

while ($row = mysqli_fetch_assoc($result)) {
    $url = $base_url . "User/Pages/detail-produk.php?id=" . $row['id_produk'] . "&from=search";
    $urlfoto = $base_url . "User/Asset/images/Produk/{$row['gambar']}";
    echo "
    <a href='$url'
       class='d-flex align-items-center p-2 text-decoration-none text-dark search-item'>

        <img src='$urlfoto' 
            style='width:40px; height:40px; object-fit:cover; border-radius:5px;'>

        <div class='ms-2'>
            <div class='fw-semibold'>{$row['nama_produk']}</div>
            <div class='text-muted' style='font-size:13px;'>Rp " . number_format($row['harga'],0,',','.') . "</div>
        </div>

    </a>";
}

?>

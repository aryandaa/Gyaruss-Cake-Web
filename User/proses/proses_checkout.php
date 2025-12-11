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
include "../include/init_cart.php";  // ambil $cart_token

// Ambil data user
$nama   = mysqli_real_escape_string($conn, $_POST['nama']);
$wa     = mysqli_real_escape_string($conn, $_POST['no_wa']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$catatan= mysqli_real_escape_string($conn, $_POST['catatan']);
$metode = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);

// Ambil isi keranjang
$keranjang = mysqli_query($conn, "
    SELECT c.id_produk, c.qty, p.nama_produk, p.harga
    FROM cart c
    JOIN produk p ON c.id_produk = p.id_produk
    WHERE c.cart_token = '$cart_token'
");

if (mysqli_num_rows($keranjang) == 0) {
    die("Keranjang kosong!");
}

// Hitung total
$total_harga = 0;
$items = [];

while ($row = mysqli_fetch_assoc($keranjang)) {
    $subtotal = $row['qty'] * $row['harga'];
    $total_harga += $subtotal;
    $items[] = $row;
}

// Generate kode pesanan
$kode = "ORDER-" . date("ymd") . "-" . rand(1000,9999);

// Insert ke tabel pesanan (100% sesuai database Yanda)
mysqli_query($conn, "
    INSERT INTO pesanan (kode_pesanan, nama, no_wa, alamat, metode_pembayaran, catatan, total_harga)
    VALUES ('$kode', '$nama', '$wa', '$alamat', '$metode', '$catatan', '$total_harga')
");

$id_pesanan = mysqli_insert_id($conn);

// Insert ke pesanan_detail
foreach ($items as $i) {
    $subtotal = $i['qty'] * $i['harga'];
    
    mysqli_query($conn, "
        INSERT INTO pesanan_detail (id_pesanan, id_produk, nama_produk, harga_satuan, qty, subtotal)
        VALUES (
            '$id_pesanan',
            '{$i['id_produk']}',
            '{$i['nama_produk']}',
            '{$i['harga']}',
            '{$i['qty']}',
            '$subtotal'
        )
    ");
}

//update status best seller
mysqli_query($conn, "UPDATE produk SET best_seller = 0");

$result = mysqli_query($conn, "
    SELECT id_produk, SUM(qty) as total_jual
    FROM pesanan_detail
    GROUP BY id_produk
    ORDER BY total_jual DESC
    LIMIT 2
");

while ($row = mysqli_fetch_assoc($result)) {
    $idp = $row['id_produk'];
    mysqli_query($conn, "UPDATE produk SET best_seller = 1 WHERE id_produk = '$idp'");
}


$pesan =
rawurlencode("╔══════════════════════════════════════╗") . "%0A" .
rawurlencode("║ PESANAN BARU MASUK ║") . "%0A" .
rawurlencode("╚══════════════════════════════════════╝") . "%0A%0A" .

rawurlencode("Ada pesanan baru nih! Yuk cek detailnya 👇") . "%0A%0A" .

rawurlencode("━━━━━━━━ DETAIL PRODUK ━━━━━━━━") . "%0A";

foreach ($items as $i) {
    $namaProduk = $i['nama_produk'];
    $qty        = $i['qty'];
    $hargaSat   = number_format($i['harga'],0,',','.');
    $sub        = number_format($i['qty'] * $i['harga'],0,',','.');

    $pesan .= rawurlencode("• $namaProduk") . "%0A";
    $pesan .= rawurlencode("   ├─ Jumlah: {$qty} pcs") . "%0A";
    $pesan .= rawurlencode("   ├─ Harga: Rp {$hargaSat}") . "%0A";
    $pesan .= rawurlencode("   └─ Subtotal: Rp {$sub}") . "%0A%0A";
}

$pesan .=
rawurlencode("━━━━━━━━ TOTAL PEMBAYARAN ━━━━━━━━") . "%0A" .
rawurlencode("Total: Rp " . number_format($total_harga,0,',','.')) . "%0A%0A" .

rawurlencode("━━━━━━━━ DATA PELANGGAN ━━━━━━━━") . "%0A" .
rawurlencode("Nama: $nama") . "%0A" .
rawurlencode("WhatsApp: $wa") . "%0A" .
rawurlencode("Alamat: $alamat") . "%0A" .
rawurlencode("Metode Pembayaran: $metode") . "%0A" .
rawurlencode("Catatan: $catatan") . "%0A%0A" .

rawurlencode("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━") . "%0A" .
rawurlencode("Yuk segera diproses!") . "%0A" .
rawurlencode("#GyarussCake");

// Nomor WA
$waToko = "6289692778102";

// Hapus cart
mysqli_query($conn, "DELETE FROM cart WHERE cart_token = '$cart_token'");

// Redirect ke WA
header("Location: https://wa.me/$waToko?text=$pesan");
exit();

?>

<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php';
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

$pesan = 
"╔═══════════════════════╗".
"║ PESANAN BARU MASUK    ║".
"╚═══════════════════════╝".

" Ada pesanan baru nih! Yuk cek detailnya ".

"━━━━━━━━━━━━━━━━━━━━━━━━━━".
" DETAIL PRODUK PESANAN".
"━━━━━━━━━━━━━━━━━━━━━━━━━━";

// Loop produk cart
foreach ($items as $i) {
    $namaProduk = rawurlencode($i['nama_produk']);
    $qty        = rawurlencode($i['qty']);
    $sub        = rawurlencode(number_format($i['qty'] * $i['harga'],0,',','.'));
    $hargaSat   = rawurlencode(number_format($i['harga'],0,',','.'));

    $pesan .= 
    " $namaProduk".
    "   ├─  Jumlah: {$qty} pcs".
    "   ├─  Harga Satuan: Rp {$hargaSat}".
    "   └─  Subtotal: Rp {$sub}";
}

$pesan .=
"━━━━━━━━━━━━━━━━━━━━━━━━━━".
" TOTAL PEMBAYARAN".
"━━━━━━━━━━━━━━━━━━━━━━━━━━".
"Total: Rp " . rawurlencode(number_format($total_harga,0,',','.')) .

"━━━━━━━━━━━━━━━━━━━━━━━━━━".
" DATA PELANGGAN".
"━━━━━━━━━━━━━━━━━━━━━━━━━━".
" Nama: " . rawurlencode($nama) .
" WhatsApp: " . rawurlencode($wa) . 
" Alamat: " . rawurlencode($alamat) .
" Metode Pembayaran: " . rawurlencode($metode) .

" Catatan:%0A".
rawurlencode($catatan) . 

"━━━━━━━━━━━━━━━━━━━━━━━━━━".
" yuk segera diproses!".
"#GyarussCake";

// Nomor WA
$waToko = "6289692778102";

// Hapus cart
mysqli_query($conn, "DELETE FROM cart WHERE cart_token = '$cart_token'");

// Redirect ke WA
header("Location: https://wa.me/$waToko?text=$pesan");
exit();

?>

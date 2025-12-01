<?php  
session_start();
include "../include/connect.php";

$id_produk = $_POST['id_produk'];
$nama      = mysqli_real_escape_string($conn, $_POST['nama']);
$wa        = mysqli_real_escape_string($conn, $_POST['wa']);
$alamat    = mysqli_real_escape_string($conn, $_POST['alamat']);
$catatan   = mysqli_real_escape_string($conn, $_POST['catatan']);
$qty       = (int)$_POST['qty'];

// Ambil data produk
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
$produk = mysqli_fetch_assoc($q);

$harga       = $produk['harga'];
$subtotal    = $qty * $harga;
$kode = "ORDER-" . date("ymd") . "-" . rand(1000,9999);

// Simpan ke `pesanan`
mysqli_query($conn, "
    INSERT INTO pesanan (kode_pesanan,nama,wa,alamat,total_harga,metode_pembayaran,catatan,status,created_at)
    VALUES ('$kode','$nama','$wa','$alamat','$subtotal','transfer','$catatan','pending',NOW())
");

$id_pesanan = mysqli_insert_id($conn);

// Simpan ke detail_pesanan
mysqli_query($conn, "
    INSERT INTO detail_pesanan (id_pesanan,id_produk,qty,harga_satuan,subtotal)
    VALUES ('$id_pesanan','$id_produk','$qty','$harga','$subtotal')
");

// Siapkan pesan WhatsApp
$pesanWA = urlencode("
Pesanan Baru!
Kode: $kode

Produk: {$produk['nama_produk']}
Qty: $qty
Harga: Rp ".number_format($harga,0,',','.')."
Total: Rp ".number_format($subtotal,0,',','.') ."

Nama: $nama
WA: $wa
Alamat: $alamat
Catatan: $catatan
");

// Nomor WA toko
$waToko = "628xxx";

// Redirect WA + success page
header("Location: https://wa.me/$waToko?text=$pesanWA");
exit();
?>

<?php
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";

$id_produk = $_POST['id_produk'] ?? '';

if ($id_produk === '') {
    die("ID produk tidak dikirim melalui form");
}

$q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id_produk");
$produk = mysqli_fetch_assoc($q);

if (!$produk) {
    die("Produk tidak ditemukan di database");
}

$error = [];
$id_produk = $_POST['id_produk'];
$nama = trim($_POST['nama'] ?? '');
$wa = trim($_POST['no_wa'] ?? '');
$alamat= trim($_POST['alamat'] ?? '');
$pembayaran = trim($_POST['metode_pembayaran'] ?? '');
$catatan = trim($_POST['catatan'] ?? '');
$qty = (int)$_POST['qty'];

// ======================
// 1. VALIDASI INPUT
// ======================

$errors = [];

if ($nama === '') {
    $errors['nama'] = "Nama tidak boleh kosong";
}
if ($wa === '') {
    $errors['no_wa'] = "Nomor WhatsApp tidak boleh kosong";
} elseif (!preg_match('/^[0-9]{10,15}$/', $wa)) {
    $errors['no_wa'] = "Format nomor WhatsApp tidak valid";
}
if ($alamat === '') {
    $errors['alamat'] = "Alamat tidak boleh kosong";
}
if ($qty < 1) {
    $errors['qty'] = "Jumlah pesanan minimal 1";
}
if ($pembayaran === '') {
    $errors['metode_pembayaran'] = "Pilih metode pembayaran";
}
if (!empty($errors)) {
    include "../Pages/form_beli_sekarang.php";
    exit;
}

// ======================
// 2. VALIDASI CAPTCHA
// ======================

$secretKey = "6Lde1RcsAAAAAJB4t12o1ZYBegQYuKa98twEM2F8";
$captcha = $_POST['g-recaptcha-response'] ?? '';

if(!$captcha){
    $errors['captcha'] = "Captcha harus diisi!";
    include "../Pages/form_beli_sekarang.php";
    exit;
}
$verify = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha"
);
$response = json_decode($verify);
if($response->success === false){
    $errors['captcha'] = "Captcha gagal diverifikasi!";
    include "../Pages/form_beli_sekarang.php";
    exit;
}

// Ambil data dari table produk
$q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
$produk = mysqli_fetch_assoc($q);

$harga       = $produk['harga'];
$subtotal    = $qty * $harga;
$waktuSekarang = date("Y-m-d H:i:s");
$waktuWA = date("d M Y, H:i", strtotime($waktuSekarang));
$kode = "ORDER-" . date("ymd") . "-" . rand(1000,9999);

// Simpan ke `pesanan`
mysqli_query($conn, "
     INSERT INTO pesanan 
     (kode_pesanan, nama, no_wa, alamat, metode_pembayaran, catatan, total_harga, waktu_pesan)
     VALUES 
     ('$kode', '$nama', '$wa', '$alamat', '$pembayaran', '$catatan', '$subtotal', NOW()) ");

$id_pesanan = mysqli_insert_id($conn);

// Simpan ke detail_pesanan
mysqli_query($conn, "
     INSERT INTO pesanan_detail 
     (id_pesanan, id_produk, nama_produk, qty, harga_satuan, subtotal)
     VALUES 
     ('$id_pesanan','$id_produk','{$produk['nama_produk']}','$qty','$harga','$subtotal')
");

// Update status best seller
mysqli_query($conn, "UPDATE produk SET best_seller = 0");

$result_bs = mysqli_query($conn, "
    SELECT id_produk, SUM(qty) as total_jual
    FROM pesanan_detail
    GROUP BY id_produk
    ORDER BY total_jual DESC
    LIMIT 2
");

while($bs = mysqli_fetch_assoc($result_bs)) {
    $idp = $bs['id_produk'];
    mysqli_query($conn, "UPDATE produk SET best_seller = 1 WHERE id_produk = '$idp'");
}

// Siapkan pesan WhatsApp
$pesan  = "╔═══════════════════════╗
║   NOTIFIKASI PESANAN    ║
╚═══════════════════════╝

 YAY! PESANAN BARU MASUK! 
Hai Admin Gyaruss Cake! 
Ada pelanggan yang baru saja memesan kue dari kita! 
Yuk segera diproses! 

━━━━━━━━━━━━━━━━━━━━━━━━━━

 INFORMASI PESANAN

 Kode Unik Pesanan: $kode

 Tanggal & Waktu: $waktuWA

 DETAIL PRODUK PESANAN

 {$produk['nama_produk']}
   ├─  Jumlah: $qty pcs
   ├─  Harga Satuan: Rp ".number_format($harga,0,',','.')."
   └─  Subtotal: Rp ".number_format($subtotal,0,',','.')."

 Metode Pembayaran: $pembayaran

 DATA PELANGGAN

 Nama Lengkap: $nama
 Nomor WhatsApp: $wa
 Alamat Pengiriman: $alamat

 Catatan Pelanggan:
\"$catatan\"

━━━━━━━━━━━━━━━━━━━━━━━━━━

 Semangat Admin! Mari kita berikan pelayanan terbaik 
untuk pelanggan kita! 

#GyarussCake #OrderBaru
#BakingWithLove #TeamGyaruss
";

// Encode aman
$pesanWA = urlencode($pesan);

// Nomor WA Toko
$waToko = "6289692778102";

// Redirect
header("Location: https://wa.me/$waToko?text=$pesanWA");
exit();
?>

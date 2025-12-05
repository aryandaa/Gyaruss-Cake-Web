<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php';

$error = [];
$nama = trim($_POST['nama'] ?? '');
$rating = trim($_POST['rating'] ?? '');
$pesan = trim($_POST['pesan'] ?? '');
$produk = trim($_POST['id_produk'] ?? '');

// ======================
// 1. VALIDASI INPUT
// ======================

if ($nama === '') {
    $errors['nama'] = "Nama tidak boleh kosong";
}
if ($produk === '') {
    $errors['produk'] = "Produk tidak boleh kosong";
}
if ($rating === '') {
    $errors['rating'] = "Rating tidak boleh kosong";
}
if ($pesan === '') {
    $errors['pesan'] = "Ulasan tidak boleh kosong";
}
if (!empty($errors)) {
    include "../Pages/input_testimoni.php";
    exit;
}

// ======================
// 2. VALIDASI CAPTCHA
// ======================

$secretKey = "6Lde1RcsAAAAAJB4t12o1ZYBegQYuKa98twEM2F8";
$captcha = $_POST['g-recaptcha-response'] ?? '';

if(!$captcha){
    $errors['captcha'] = "Captcha harus diisi!";
    include "../Pages/input_testimoni.php";
    exit;
}
$verify = file_get_contents(
    "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha"
);
$response = json_decode($verify);
if($response->success === false){
    $errors['captcha'] = "Captcha gagal diverifikasi!";
    include "../Pages/input_testimoni.php";
    exit;
}

// ======================
// 3. INSERT
// ======================

if (isset($_POST['submit'])){
    extract($_POST);
    $sql = "INSERT INTO testimoni (nama, rating, pesan, id_produk) 
                VALUE ('$nama', '$rating', '$pesan', '$produk')";
    $query = mysqli_query($conn, $sql);

// ======================
// 4. REDIRECT
// ======================

    header("location:../../index.php?added=true");
    exit;
}

?>
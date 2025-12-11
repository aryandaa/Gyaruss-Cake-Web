<?php
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";


if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); history.back();</script>";
    exit;
}

$id = intval($_GET['id']); // Anti SQLi

// Ambil nama gambar dulu
$q = $conn->prepare("SELECT gambar FROM produk WHERE id_produk = ?");
$q->bind_param("i", $id);
$q->execute();
$res = $q->get_result();

if ($res->num_rows === 0) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='../index.php?p=produk';</script>";
    exit;
}

$data = $res->fetch_assoc();
$gambar = $data['gambar'];

// Hapus komentar terkait produk
$del_komen = $conn->prepare("DELETE FROM testimoni WHERE id_produk = ?");
$del_komen->bind_param("i", $id);
$del_komen->execute();
$del_komen->close();

// Hapus database
$del = $conn->prepare("DELETE FROM produk WHERE id_produk = ?");
$del->bind_param("i", $id);

if ($del->execute()) {

    // Hapus file gambar (kecuali default.png)
    if ($gambar !== "default.png") {
        $path = __DIR__ . "/../../User/Asset/images/Produk/" . $gambar;
        if (file_exists($path)) {
            unlink($path);
        }
    }

    echo "<script>alert('Produk berhasil dihapus!'); window.location='../index.php?p=produk';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk!'); history.back();</script>";
}

$q->close();
$del->close();
$conn->close();
?>

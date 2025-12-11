<?php
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

// PROSES SIMPAN
if (isset($_POST['simpan'])) {

    // Ambil input + XSS prevent
    $nama_produk = htmlspecialchars(trim($_POST['nama_produk']));
    $harga = intval($_POST['harga']);
    $kategori = htmlspecialchars(trim($_POST['kategori']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));

    // Slug nama file dari nama produk
    $slug = strtolower(str_replace(' ', '-', $nama_produk));

    // Upload gambar
    $gambar = "default.png";

    if (!empty($_FILES['gambar']['name'])) {
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = $slug . '-' . uniqid() . '.' . $ext;

        $folder = __DIR__ . "/../../User/Asset/images/Produk/";
        move_uploaded_file($_FILES['gambar']['tmp_name'], $folder . $gambar);
    }

    // Prepared Statement → Anti SQL Injection
    $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, kategori, deskripsi, gambar, aktif) VALUES (?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("sisss", $nama_produk, $harga, $kategori, $deskripsi, $gambar);

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil ditambahkan! 😍'); window.location='../index.php?p=produk';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan produk 😭');</script>";
    }

    $stmt->close();
}
?>
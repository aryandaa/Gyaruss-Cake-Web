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

if (isset($_POST['simpan'])) {

    // Ambil data dari form
    $id_produk   = intval($_POST['id_produk']);
    $nama_produk = htmlspecialchars(trim($_POST['nama_produk']));
    $harga       = intval($_POST['harga']);
    $kategori    = htmlspecialchars(trim($_POST['kategori']));
    $deskripsi   = htmlspecialchars(trim($_POST['deskripsi']));
    $best_seller = intval($_POST['best_seller']);
    $aktif       = intval($_POST['aktif']);

    // Ambil data lama untuk hapus gambar jika diganti
    $check = mysqli_query($conn, "SELECT gambar FROM produk WHERE id_produk = $id_produk");
    $oldData = mysqli_fetch_assoc($check);
    $oldImage = $oldData['gambar'];

    $gambar = $oldImage; // default tetap gambar lama

    // Jika upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {

        $slug = strtolower(str_replace(' ', '-', $nama_produk));
        $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $gambar = $slug . '-' . uniqid() . '.' . $ext;

        $uploadDir = __DIR__ . '/../../User/Asset/images/Produk/';

        // Hapus gambar lama jika ada
        if ($oldImage !== "default.png" && file_exists($uploadDir . $oldImage)) {
            unlink($uploadDir . $oldImage);
        }

        move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $gambar);
    }

    // Update ke Database
    $stmt = $conn->prepare("UPDATE produk SET 
        nama_produk = ?, 
        harga = ?, 
        kategori = ?, 
        deskripsi = ?, 
        best_seller = ?, 
        aktif = ?, 
        gambar = ?
        WHERE id_produk = ?
    ");

    $stmt->bind_param("sisssisi",
        $nama_produk,
        $harga,
        $kategori,
        $deskripsi,
        $best_seller,
        $aktif,
        $gambar,
        $id_produk
    );

    if ($stmt->execute()) {
        echo "<script>
                alert('Produk berhasil diperbarui! 😍');
                window.location='../index.php?p=produk';
              </script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk 😭');</script>";
    }

    $stmt->close();
}
?>

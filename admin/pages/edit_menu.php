<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Gyruss-Cake-Web/config.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Produk tidak ditemukan'); window.location='../index.php?p=produk';</script>";
    exit;
}

$id_produk = intval($_GET['id']);

// Ambil data produk berdasarkan ID
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id_produk");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data produk tidak ditemukan'); window.location='../index.php?p=produk';</script>";
    exit;
}

// Include proses edit (submit form)
include "../proses/proses_edit_menu.php";
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body class="bg-white">

<div class="container py-4">

    <!-- JUDUL -->
    <h2 class="fw-bold mb-4" style="color:#2B143B;">Edit Menu</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?= $data['id_produk']; ?>">

    <div class="row g-4">

    
        <!-- AREA Edit FOTO -->
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="d-flex flex-column justify-content-center align-items-center shadow-sm bg-light-subtle border rounded-4 text-center"
                    id="uploadBox"
                style="width: 300px; height: 300px; cursor:pointer; border:2px dashed #C8BDCE; background-color:#EDE6F0;">

                <!-- Preview Image -->
                <img id="previewImage"
                    src="<?= $base_url ?>User/Asset/images/Produk/<?= $data['gambar']; ?>"
                    class=""
                    style="width:100%; height:100%; object-fit:cover; border-radius:10px;" />

                <i id="previewIcon" class="bi bi-camera-fill"
                style="font-size:50px; color:#504060;"></i>

                <p id="previewText" class="mt-2"
                style="font-size:14px; color:#504060;">
                    Klik atau seret Foto Produk di sini
                </p>

                <input type="file" name="gambar" id="fotoInput" class="d-none" accept="image/*">

            </div>
        </div>


        <!-- FORM INPUT -->
        <div class="col-lg-8">

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">ID Produk</label>
                    <input type="text" class="form-control rounded-3" placeholder="Auto" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">Nama Produk</label>
                    <input type="text" 
                        class="form-control rounded-3" 
                        name="nama_produk" 
                        placeholder="Masukan Nama Produk... "
                        value="<?= htmlspecialchars($data['nama_produk']); ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">Harga</label>
                    <input type="number" 
                        class="form-control rounded-3" 
                        name="harga" 
                        placeholder="Masukan Harga..."
                        value="<?= $data['harga']; ?>">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">Kategori</label>
                    <select class="form-select rounded-3" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option <?= ($data['kategori'] == 'Cake') ? 'selected' : ''; ?> value="Cake">Kue</option>
                        <option <?= ($data['kategori'] == 'Catering') ? 'selected' : ''; ?> value="Catering">Catering</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" style="color:#504060;">Deskripsi</label>
                    <textarea class="form-control rounded-3"
                            rows="3" maxlength="200"
                            name="deskripsi"><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                </div>


                <div class="col-12">
                    <label class="form-label fw-semibold" style="color:#504060;">Best Seller?</label>
                    <div class="d-flex gap-4">

                        <label class="d-flex align-items-center gap-2">
                            <input type="radio" name="best_seller" value="1" 
                                <?= ($data['best_seller'] == 1) ? 'checked' : ''; ?>>
                            <span>Ya (Tampilkan Badge 🔥 Terlaris)</span>
                        </label>

                        <label class="d-flex align-items-center gap-2">
                            <input type="radio" name="best_seller" value="0"
                                <?= ($data['best_seller'] == 0) ? 'checked' : ''; ?>>
                            <span>Tidak</span>
                        </label>

                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label class="form-label fw-semibold" style="color:#504060;">Status Produk</label>
                    <div class="d-flex gap-4">

                        <label class="d-flex align-items-center gap-2">
                            <input type="radio" name="aktif" value="1"
                                <?= ($data['aktif'] == 1) ? 'checked' : ''; ?>>
                            <span>Aktif (Tampil di Menu)</span>
                        </label>

                        <label class="d-flex align-items-center gap-2">
                            <input type="radio" name="aktif" value="0"
                                <?= ($data['aktif'] == 0) ? 'checked' : ''; ?>>
                            <span>Nonaktif (Sembunyikan)</span>
                        </label>

                    </div>
                </div>


            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-end gap-3 mt-4">

                <a href="../index.php?p=produk"
                   class="btn px-4 py-2 rounded-pill fw-semibold"
                   style="border:2px solid #504060; color:#504060;">
                    Batal
                </a>

                <button type="submit" name="simpan"
                        class="btn px-4 py-2 rounded-pill fw-semibold text-white"
                        style="background:#504060;">
                    Simpan Menu <i class="bi bi-check-lg"></i>
                </button>

            </div>

        </div>
    </div>
    </form>

</div>

<script>
const fileInput = document.getElementById("fotoInput");
const uploadBox = document.getElementById("uploadBox");
const previewImg = document.getElementById("previewImage");
const previewIcon = document.getElementById("previewIcon");
const previewText = document.getElementById("previewText");

// Klik area → buka file explorer
uploadBox.addEventListener("click", () => {
    fileInput.value = ""; // reset supaya event change tetap detect
    fileInput.click();
});

// Event pilih foto
fileInput.addEventListener("change", function () {
    const file = this.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImg.src = e.target.result;
        previewImg.classList.remove("d-none");
        previewIcon.style.display = "none";
        previewText.style.display = "none";
    };
    reader.readAsDataURL(file);
});

if (previewImg.src !== "") {
    previewIcon.style.display = "none";
    previewText.style.display = "none";
}

</script>
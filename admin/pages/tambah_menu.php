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
    <h2 class="fw-bold mb-4" style="color:#2B143B;">Tambah Menu Baru</h2>
    
    <form action="" method="POST" enctype="multipart/form-data">

    <div class="row g-4">

    
        <!-- AREA UPLOAD FOTO -->
        <div class="col-lg-4 d-flex justify-content-center">
            <div class="d-flex flex-column justify-content-center align-items-center shadow-sm bg-light-subtle border rounded-4 text-center"
                    id="uploadBox"
                style="width: 300px; height: 300px; cursor:pointer; border:2px dashed #C8BDCE; background-color:#EDE6F0;">

                <!-- Preview Image -->
                <img id="previewImage"
                    src=""
                    class="d-none"
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
                    <input type="text" class="form-control rounded-3" name="nama_produk" placeholder="Masukan Nama Produk...">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">Harga</label>
                    <input type="number" class="form-control rounded-3" name="harga" placeholder="Masukan Harga...">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color:#504060;">Kategori</label>
                    <select class="form-select rounded-3" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="Cake">Kue</option>
                        <option value="Catering">Catering</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold" style="color:#504060;">Deskripsi</label>
                    <textarea class="form-control rounded-3"
                              rows="3" maxlength="200"
                              name="deskripsi"
                              placeholder="Masukkan deskripsi produk..."></textarea>
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
    <?php include "../proses/proses_tambah_menu.php";?>

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

</script>


</body>
</html>

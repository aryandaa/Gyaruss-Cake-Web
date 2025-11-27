<?php 
include_once("../include/connect.php");
$errors = $errors ?? [];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Ulasan</title>

    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            background: #fff;
            font-family: "Montserrat", sans-serif;
        }

        /* Custom arrow ungu */
        .select-custom {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' fill='%233D2949' viewBox='0 0 16 16'%3E%3Cpath d='M3 6l5 5 5-5H3z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
        }

        /* Style list radio rating */
        .rating-item {
            border-bottom: 1px solid #E6E6E6;
            padding: 12px;
        }

        .rating-item:last-child {
            border-bottom: none;
        }

        .rating-item input {
            accent-color: #3D2949;
        }

        .rating-stars {
            color: #FFC107;
            font-size: 20px;
            margin-right: 8px;
        }
    </style>

</head>
<body>

<div class="container" style="max-width: 420px; margin-top: 30px;">
    <h3 class="fw-bold text-center mb-4" style="color:#2B143B;">Tambah Ulasan</h3>
    <form action="../proses/proses_input_testimoni.php" method="post">

    <!-- NAMA -->
    <div class="mb-3">
        <label class="fw-semibold" style="color:#6A6A6A;">Nama</label>
        <input type="text" class="form-control py-2" placeholder="Ketik Nama" name="nama" value="<?= $_POST['nama'] ?? '' ?>">
            <?php if(isset($errors['nama'])): ?>
                <small class="text-danger"><?= $errors['nama'] ?></small>
            <?php endif; ?>
    </div>

    <!-- PRODUK -->
    <div class="mb-3">
        <label class="fw-semibold" style="color:#6A6A6A;">Produk</label>
        <select class="form-select py-2 select-custom" name="id_produk">
            <option value="" disabled selected>Pilih Produk</option>
            <?php foreach ($produkList as $l):?>
            <option value="<?= $l['id_produk']; ?>"><?= $l['nama_produk']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if(isset($errors['produk'])): ?>
            <small class="text-danger"><?= $errors['produk'] ?></small>
        <?php endif; ?>
    </div>

    <!-- BINTANG -->
    <div class="mb-3">
        <label class="fw-semibold" style="color:#6A6A6A;">Bintang</label>
        <select class="form-select py-2 select-custom" name="rating" id="rating"> 
            <option value="5">⭐⭐⭐⭐⭐(<?= $ratingCount[5] ?>)</option>
            <option value="4">⭐⭐⭐⭐(<?= $ratingCount[4] ?>)</option>
            <option value="3">⭐⭐⭐(<?= $ratingCount[3] ?>)</option>
            <option value="2">⭐⭐(<?= $ratingCount[2] ?>)</option>
            <option value="1">⭐(<?= $ratingCount[1] ?>)</option>
        </select>
        <?php if(isset($errors['rating'])): ?>
            <small class="text-danger"><?= $errors['rating'] ?></small>
        <?php endif; ?>
    </div>

    <!-- ULASAN -->
    <div class="mb-1">
        <label class="fw-semibold" style="color:#6A6A6A;">Ulasan</label>
        <textarea 
                id="pesan"
                name="pesan"
                class="form-control" 
                rows="3" 
                maxlength="150" 
                placeholder="Ketik ulasannya" 
                oninput="updateCount()"
                value="<?= $_POST['pesan'] ?? '' ?>">
        </textarea>
        <?php if(isset($errors['pesan'])): ?>
            <small class="text-danger"><?= $errors['pesan'] ?></small>
        <?php endif; ?>
    </div>

    <div class="text-end text-muted" style="font-size: 13px;">
        <span id="charCount">0</span>/150 karakter
    </div>

    <div class="g-recaptcha" data-sitekey="6Lde1RcsAAAAAPTvY0Xu32txIbpxUZBZFiHJAXco"></div>
        <?php if(isset($errors['captcha'])): ?>
            <small class="text-danger"><?= $errors['captcha'] ?></small>
        <?php endif; ?>

    <!-- BUTTON -->
    <div class="d-flex justify-content-between mt-4">
        <a href="../index.php"
                class="btn px-4 py-2 rounded-pill border border-dark"
                style="background:#fff; font-weight:600;"
                >Batal
        </a>

        <button class="btn px-4 py-2 rounded-pill" 
                style="background:#3D2949; color:#fff; font-weight:600;" 
                name="submit"
                type="submit">Simpan
        </button>
    </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function updateCount() {
    let textarea = document.getElementById('pesan');
    let counter = document.getElementById('charCount');

    let length = textarea.value.length;
    counter.innerText = length;

    // Kalau full 150 karakter, warna jadi merah (opsional)
    if (length >= 150) {
        counter.style.color = "red";
    } else {
        counter.style.color = "#6A6A6A";
    }
}
</script>

</body>
</html>

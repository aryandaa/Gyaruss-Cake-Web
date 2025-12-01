<?php
session_start();
include __DIR__ . "/../include/connect.php";

// Ambil id_produk dari GET (normal) atau POST (ketika form dipanggil ulang lewat include)
$id_produk = $_GET['id_produk'] ?? $_POST['id_produk'] ?? null;

if (!$id_produk) {
    die("ID produk tidak dikirim");
}

$q = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = $id_produk");
$produk = mysqli_fetch_assoc($q);

if (!$produk) {
    die("Produk tidak ditemukan");
}
$errors = $errors ?? [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pemesanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        body {
            background-color: #f8f8f8;
            font-family: 'Montserrat', sans-serif;
        }

        .form-card {
            background: white;
            border-radius: 18px;
            padding: 40px 50px;
        }

        .title-logo {
            width: 150px;
        }

        .section-title {
            font-weight: 700;
            color: #2B143B;
        }

        .input-custom {
            background-color: #F1E6EA;
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
        }

        .input-custom:focus {
            outline: none;
            border: 2px solid #2B143B;
        }

        .radio-custom input {
            accent-color: #2B143B;
        }

        .btn-submit {
            background-color: #2B143B;
            border-radius: 50px;
            padding: 12px 30px;
            color: white;
            font-weight: 700;
        }

        .btn-submit:hover {
            background-color: #43225e;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="form-card mx-auto" style="max-width: 900px;">

        <!-- LOGO -->
        <div class="text-center mb-4">
            <img src="../Asset/images/logo gyarus.png" class="title-logo" alt="logo">
            <h4 class="mt-3 fw-bold" style="color:#2B143B;">Formulir Pemesanan</h4>
            <p class="text-muted">Lengkapi data anda untuk mengkonfirmasi pemesanan ke penjual</p>
        </div>

        <hr class="mb-4">

        <h4 class="text-center fw-bold mb-4 section-title">Masukkan data</h4>

        <form action="../proses/proses_beli_sekarang.php" method="POST">

            <div class="row g-4">

                <input type="hidden" name="id_produk" value="<?= $produk['id_produk'] ?>">

                <!-- Nama -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control input-custom" placeholder="Nama lengkap">
                    <?php if(isset($errors['nama'])): ?>
                        <small class="text-danger"><?= $errors['nama'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- Produk -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Produk yang dipilih</label>
                    <input type="text" name="produk" class="form-control input-custom" value="<?= htmlspecialchars($produk['nama_produk']); ?>" readonly>
                </div>

                <!-- WhatsApp -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Nomor WhatsApp</label>
                    <input type="text" name="no_wa" class="form-control input-custom" placeholder="08xxxx">
                    <?php if(isset($errors['no_wa'])): ?>
                        <small class="text-danger"><?= $errors['no_wa'] ?></small>
                    <?php endif; ?>
                </div>

                <!-- Jumlah -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Jumlah Pesanan</label>
                    <input type="number" name="qty" class="form-control input-custom" min="1" value="1">
                </div>

                <!-- Alamat -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control input-custom" rows="2" placeholder="Masukkan alamat lengkap"></textarea>
                    <?php if(isset($errors['alamat'])): ?>
                        <small class="text-danger"><?= $errors['alamat'] ?></small>
                    <?php endif; ?>
                </div>


                <!-- Total harga -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Total harga</label>
                    <input type="text" name="total" class="form-control input-custom mb-4" value=" Rp <?= number_format($produk['harga'], 0, ',', '.'); ?>" readonly>
                </div>

                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Catatan tambahan (opsional)</label>
                    <textarea name="catatan" class="form-control input-custom" rows="2" placeholder="Tambahkan catatan..."></textarea>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="fw-semibold mb-1">Metode pembayaran</label>
                    <div class="d-flex gap-4 radio-custom mt-2">
                        <label><input type="radio" name="metode_pembayaran" value="Transfer" checked> Transfer</label>
                        <label><input type="radio" name="metode_pembayaran" value="Cash"> Cash</label>
                    </div>
                </div>

            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="g-recaptcha" data-sitekey="6Lde1RcsAAAAAPTvY0Xu32txIbpxUZBZFiHJAXco"></div>
                    <?php if(isset($errors['captcha'])): ?>
                        <small class="text-danger"><?= $errors['captcha'] ?></small>
                    <?php endif; ?>
                </div>
            </div>
            

            <div class="d-flex justify-content-between align-items-center mt-5">

                <a href="../../index.php" class="btn btn-submit">
                    Batal
                </a>
                

                <button type="submit" class="btn btn-submit">
                    Pesan Sekarang →
                </button>

            </div>


        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

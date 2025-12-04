<?php
session_start();
include __DIR__ . "/../include/connect.php";


// =========================
// CEK JIKA CART TIDAK KIRIM PRODUK
// =========================
if (!isset($_POST['produk_id'])) {
    die("Tidak ada produk yang dikirim dari keranjang.");
}

$produk_id = $_POST['produk_id'];  // array id_cart
$qty       = $_POST['qty'];       // array qty

$items = [];
$total_semua = 0;


// =========================
// AMBIL SEMUA DATA PRODUK DARI CART
// =========================
foreach ($produk_id as $i => $id_cart) {

    $q = mysqli_query($conn, "
        SELECT produk.*, cart.qty, cart.id_cart
        FROM cart 
        JOIN produk ON cart.id_produk = produk.id_produk
        WHERE cart.id_cart = '$id_cart'
    ");

    $row = mysqli_fetch_assoc($q);
    if ($row) {
        $items[] = $row;
        $total_semua += ($row['harga'] * $row['qty']);
    }
}

$errors = $errors ?? [];

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Pesanan</title>

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

        .produk-card {
            border: 1px solid #ddd;
            border-radius: 14px;
            padding: 12px;
            margin-bottom: 12px;
            background: #fff;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="form-card mx-auto" style="max-width: 900px;">

        <!-- LOGO -->
        <div class="text-center mb-4">
            <img src="../Asset/images/logo gyarus.png" class="title-logo" alt="logo">
            <h4 class="mt-3 fw-bold" style="color:#2B143B;">Checkout Pesanan</h4>
            <p class="text-muted">Pastikan data kamu benar sebelum konfirmasi pemesanan</p>
        </div>

        <hr class="mb-4">

        <!-- PRODUK LIST -->
        <h4 class="section-title mb-3 text-center">Produk yang Dipesan</h4>

        <?php foreach ($items as $p): ?>
        <div class="produk-card d-flex align-items-center">
            <img src="../Asset/images/Produk/<?= $p['gambar'] ?>"
                 style="width:80px; border-radius:12px;">

            <div class="ms-3 flex-grow-1">
                <h6 class="fw-bold mb-1"><?= $p['nama_produk'] ?></h6>
                <div class="text-muted small">
                    Harga : Rp <?= number_format($p['harga'], 0, ',', '.') ?><br>
                    Jumlah : <?= $p['qty'] ?>
                </div>
            </div>

            <div class="fw-bold">
                Rp <?= number_format($p['harga'] * $p['qty'], 0, ',', '.') ?>
            </div>
        </div>
        <?php endforeach; ?>


        <!-- ========================= -->
        <!-- FORM PEMESANAN -->
        <!-- ========================= -->
        <h4 class="text-center fw-bold mt-5 mb-4 section-title">Data Pemesan</h4>
        
        <form action="../proses/proses_checkout.php" method="POST">

            <!-- Kirim ulang data produk -->
            <?php foreach ($items as $p): ?>
                <input type="hidden" name="produk_id[]" value="<?= $p['id_produk'] ?>">
                <input type="hidden" name="qty[]" value="<?= $p['qty'] ?>">
            <?php endforeach; ?>

            <div class="row g-4">

                <!-- Nama -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control input-custom" placeholder="Nama lengkap">
                </div>

                <!-- WhatsApp -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Nomor WhatsApp</label>
                    <input type="text" name="no_wa" class="form-control input-custom" placeholder="08xxxx">
                </div>


                <!-- Alamat -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Alamat Lengkap</label>
                    <textarea name="alamat" class="form-control input-custom" rows="2"
                              placeholder="Masukkan alamat lengkap"></textarea>
                </div>


                <!-- Estimasi selesai -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Estimasi Selesai</label>
                    <input type="text" name="no_wa" class="form-control input-custom" placeholder="2-5 Hari" readonly>
                </div>

                <!-- Total Harga -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Total Harga</label>
                    <input type="text" class="form-control input-custom fw-bold" 
                        value="Rp <?= number_format($total_semua, 0, ',', '.') ?>" readonly>
                </div>
                
                <!-- Catatan -->
                <div class="col-md-6">
                    <label class="fw-semibold mb-1">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control input-custom" rows="2"
                              placeholder="Tambahkan catatan..."></textarea>
                </div>

                <!-- Pembayaran -->
                <div class="col-md-12">
                    <label class="fw-semibold mb-1">Metode Pembayaran</label>
                    <div class="d-flex gap-4 radio-custom mt-2">
                        <label><input type="radio" name="metode_pembayaran" value="Transfer" checked> Transfer</label>
                        <label><input type="radio" name="metode_pembayaran" value="Cash"> Cash</label>
                    </div>
                </div>

            </div>


            <!-- CAPTCHA -->
            <div class="mt-4">
                <div class="g-recaptcha" data-sitekey="6Lde1RcsAAAAAPTvY0Xu32txIbpxUZBZFiHJAXco"></div>
            </div>

            <!-- TOTAL & SUBMIT -->
            <div class="d-flex justify-content-between align-items-center mt-5">
                
                <a href="../Pages/keranjang.php" class="btn btn-submit">Batal</a>

                <button type="submit" class="btn btn-submit">
                    Konfirmasi Pesanan →  
                </button>

            </div>

        </form>
    </div>
</div>

</body>
</html>

<?php
include __DIR__ . '/../include/connect.php';
include __DIR__ . '/../include/config.php';
include __DIR__ . '/../proses/backend_pesanan.php';
?>

<div class="container-custom">
<div class="row">
    <div class="col-12">
        <h2 class="title-1 m-b-25" style="font-family: 'Montserrat', sans-serif !important;">
            Pesanan Pelanggan
        </h2>

<div class="card shadow-sm p-3 mb-4" style="border-radius: 16px;">

    <form method="GET" action="index.php" class="d-flex align-items-center gap-3 flex-wrap w-100"
          style="margin-bottom:20px;" >

        <input type="hidden" name="p" value="pesanan">

        <!-- Icon Filter -->
        <div class="d-flex align-items-center px-3 py-2 rounded"
             style="background:#F5EAF0; cursor:pointer;">
            <i class="bi bi-funnel-fill" style="color:#2B143B; font-size:18px;"></i>
        </div>

        <!-- Filter Tanggal -->
        <div class="flex-grow-1">
        <input type="date" name="date"
               value="<?= $_GET['date'] ?? '' ?>"
               class="form-control border-0 shadow-none"
               style="background:#F8F4F6; padding:10px 14px; border-radius:10px;">
        </div>

        <!-- Filter Nama -->
        <div class="flex-grow-1">
            <select name="nama"
                    class="form-select border-0 shadow-none"
                    style="background:#F8F4F6; padding:10px 14px; border-radius:10px;">
                <option value="">Nama Pelanggan</option>
                <?php
                $nama_result = mysqli_query($conn, "SELECT DISTINCT nama FROM pesanan ORDER BY nama ASC");
                while ($n = mysqli_fetch_assoc($nama_result)) {
                    $selected = ($_GET['nama'] ?? '') == $n['nama'] ? 'selected' : '';
                    echo "<option $selected>" . htmlspecialchars($n['nama']) . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Filter Metode -->
        <div class="flex-grow-1">
            <select name="metode"
                    class="form-select border-0 shadow-none"
                    style="background:#F8F4F6; padding:10px 14px; border-radius:10px;">
                <option value="">Metode Pembayaran</option>
                <option <?= (($_GET['metode'] ?? '') == 'Tunai') ? 'selected' : '' ?>>Tunai</option>
                <option <?= (($_GET['metode'] ?? '') == 'Transfer') ? 'selected' : '' ?>>Transfer</option>
            </select>
        </div>

        <!-- Tombol Filter Aktif -->
        <button class="btn text-white fw-semibold" style="background:#2B143B; border-radius:10px;">
            Filter
        </button>

        <button type="submit" id="btnFilter" style="display:none;"></button>

        <!-- Reset: clear GET -->
        <a href="index.php?p=pesanan" class="btn text-danger fw-semibold">
            <i class="bi bi-arrow-clockwise me-1"></i> Reset
        </a>

        </form>
</div>

        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Waktu Pesan</th>
                        <th>Nama</th>
                        <th class="text-end">Nomor WhatsApp</th>
                        <th class="text-end">Alamat</th>
                        <th class="text-end">Metode</th>
                        <th class="text-end">Catatan</th>
                        <th class="text-end">Total Harga</th>
                        <th class="text-end">Produk yang dibeli</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr style="font-family: 'Montserrat', sans-serif !important;">
                            <td><?= $row['kode_pesanan'] ?></td>
                            <td><?= $row['waktu_pesan'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td class="text-end"><?= $row['no_wa'] ?></td>
                            <td class="text-end"><?= $row['alamat'] ?></td>
                            <td class="text-end"><?= $row['metode_pembayaran'] ?></td>
                            <td class="text-end"><?= $row['catatan'] ?></td>
                            <td class="text-end">Rp <?= number_format($row['total_harga'],0,',','.') ?></td>
                            <td class="text-end"><?= $row['produk_dibeli'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>


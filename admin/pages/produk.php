<?php
include __DIR__ . '/../include/connect.php';
include __DIR__ . '/../include/config.php';

$query = "SELECT * FROM produk";
$result = mysqli_query($conn, $query);
?>

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">daftar Produk</h2>
                <button class="au-btn au-btn-icon au-btn--blue">
                    <i class="zmdi zmdi-plus"></i>add item</button>
        </div>
    </div>
</div>

        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Penjualan</th>
                        <th class="text-end">Kategori</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($result as $r): ?>
                        <tr style="font-family: 'Montserrat', sans-serif !important;">
                            <td><?= $r['id_produk'] ?></td>
                            <td><img src="<?= $base_url ?>User/Asset/images/Produk/<?= $r['gambar']; ?>" alt=""></td>
                            <td><b><?= $r['nama_produk'] ?></b></td>
                            <td class="text-end">Rp.<?= number_format($r['harga'], 0, ',', '.'); ?></td>
                            <td class="text-end"><?= $row['alamat'] ?></td>
                            <td class="text-end"><?= $r['kategori'] ?></td>
                            <td class="text-end"><?= $row['catatan'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
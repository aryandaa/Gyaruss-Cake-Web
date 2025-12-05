<?php
include __DIR__ . '/../include/connect.php';
include __DIR__ . '/../include/config.php';

$query = "
    SELECT 
        p.id_produk,
        p.nama_produk,
        p.gambar,
        p.harga,
        p.kategori,
        p.best_seller,
        COUNT(d.id_produk) AS total_penjualan
    FROM produk p
    LEFT JOIN pesanan_detail d ON p.id_produk = d.id_produk
    GROUP BY p.id_produk
    ORDER BY total_penjualan DESC";

$result = mysqli_query($conn, $query);
?>

<style>
.foto-col {
    min-width: 150px !important; /* kasih ruang buat gambar */
}

.foto-col img {
    width: 150px !important;
    height: 100px !important;
    object-fit: cover !important;
    border-radius: 10px !important;
    display: block;
    margin: auto;
}

.table img {
    max-width: none !important;
}

/* Fix modal tidak bisa diklik pada layout dengan transform */
.modal {
    z-index: 200000 !important;
}
.modal-backdrop {
    z-index: 199999 !important;
}

body.modal-open {
    pointer-events: none;
}
.modal,
.modal * {
    pointer-events: auto !important;
}



</style>

<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">daftar Produk</h2>
                <a href="<?= $base_url ?>Admin/pages/tambah_menu.php" class="btn btn-primary d-inline-flex align-items-center fw-bold px-4 py-2 rounded"
                        style="background-color:#504060; border-color:#504060;">
                    <i class="bi bi-plus-lg me-2 fs-5"></i>
                    Tambah menu Baru
                </a>

        </div>
    </div>
</div>

        <div class="table-responsive table--no-card m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th class="text-center">Foto</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Penjualan</th>
                        <th class="text-end">Kategori</th>
                        <th class="text-end">Opsi</th>
                    </tr>
                </thead>

                <tbody>                    
                    <?php 
                    $no = 1;
                    foreach($result as $r): ?>
                        <tr style="font-family: 'Montserrat', sans-serif !important;">
                            <td><?= $no++; ?></td>
                            <td class=" foto-col text-center">
                                <img src="<?= $base_url ?>User/Asset/images/Produk/<?= $r['gambar']; ?>" alt="">
                            </td>
                            <td><b><?= $r['nama_produk'] ?></b></td>
                            <td class="text-end">Rp.<?= number_format($r['harga'], 0, ',', '.'); ?></td>
                            <td class="text-end">
                                <?= $r['total_penjualan'] ?>

                                <?php if($r['best_seller'] == 1): ?>
                                    <span class="badge"
                                        style="background:#FF5B5B; color:white; padding:4px 10px; border-radius:12px; font-size:12px; margin-left:6px;">
                                        🔥 Terlaris
                                    </span>
                                <?php endif; ?>
                        
                            </td>
                            <td class="text-end"><?= $r['kategori'] ?></td>
                            <td class="text-center">

                                <a href="<?= $base_url ?>Admin/pages/edit_menu.php?id=<?= $r['id_produk'] ?>" class="btn-edit">Edit</a>

                                <button class="btn btn-danger" style="background-color: rgba(255,0,0,0.2); color: #CC3A3A; border:none; border-radius:10px; padding:6px 20px; font-weight:600;"
                                    onclick="showDeleteModal(<?= $r['id_produk']; ?>)">
                                    Hapus
                                </button>

                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- MODAL KONFIRMASI HAPUS -->
<div class="modal fade" id="modalHapus" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" 
         style="background:#4B385C; color:white; border-radius:20px;">

      <div class="modal-body text-center py-4">
        <i class="bi bi-exclamation-triangle-fill" 
           style="font-size:50px; color:white;"></i>

        <p class="mt-3 mb-4" style="font-size:18px;">
            Anda yakin menghapus ini?
        </p>

        <div class="d-flex justify-content-center gap-3">

          <a id="btnYesDelete"
             class="btn px-4 py-2 fw-bold text-white"
             style="background:#FF3B30; border-radius:12px;">
             Yes
          </a>

          <button class="btn px-4 py-2 fw-bold"
                  style="background:white; color:#4B385C; border-radius:12px;"
                  data-bs-dismiss="modal">
              No
          </button>

        </div>
      </div>

    </div>
  </div>
</div>

<script>
function showDeleteModal(id) {
    const yesBtn = document.getElementById("btnYesDelete");
    yesBtn.href = "proses/proses_hapus.php?id=" + id;
    const modal = new bootstrap.Modal(document.getElementById("modalHapus"));
    modal.show();
}
</script>


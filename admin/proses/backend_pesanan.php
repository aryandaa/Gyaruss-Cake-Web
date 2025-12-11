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

$where = [];

if (!empty($_GET['date'])) {
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $where[] = "DATE(p.waktu_pesan) = '$date'";
}

if (!empty($_GET['nama'])) {
    $nama = mysqli_real_escape_string($conn, $_GET['nama']);
    $where[] = "p.nama = '$nama'";
}

if (!empty($_GET['metode'])) {
    $metode = mysqli_real_escape_string($conn, $_GET['metode']);
    $where[] = "p.metode_pembayaran = '$metode'";
}

$whereSQL = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

$query = "
    SELECT 
        p.id_pesanan,
        p.kode_pesanan,
        p.waktu_pesan,
        p.nama,
        p.no_wa,
        p.alamat,
        p.metode_pembayaran,
        p.catatan,
        p.total_harga,
        GROUP_CONCAT(DISTINCT pr.nama_produk SEPARATOR '<br>') AS produk_dibeli
    FROM pesanan p
    INNER JOIN pesanan_detail d ON p.id_pesanan = d.id_pesanan
    INNER JOIN produk pr ON d.id_produk = pr.id_produk
    $whereSQL
    GROUP BY p.id_pesanan
    ORDER BY p.id_pesanan DESC
";


$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($conn));
}
?>
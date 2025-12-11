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

if (isset($_POST['id_testimoni'])) {
    $id = intval($_POST['id_testimoni']);
    $aktif = intval($_POST['aktif']);

    $stmt = $conn->prepare("UPDATE testimoni SET aktif = ? WHERE id_testimoni = ?");
    $stmt->bind_param("ii", $aktif, $id);

    if ($stmt->execute()) {
        echo "<script>location.href='../index.php?p=testimoni';</script>";
    } else {
        echo "Error update status";
    }

    $stmt->close();
}
?>

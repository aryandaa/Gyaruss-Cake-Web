<?php
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";


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

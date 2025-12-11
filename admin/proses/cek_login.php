<?php
session_start();
include __DIR__ . "/../../config.php";
include __DIR__ . "/../../secure.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = trim($_POST['user']);
    $pass = trim($_POST['password']);

    if ($user == "" || $pass == "") {
        echo "<script>alert('Username dan Password wajib diisi!'); window.location='../pages/login.php';</script>";
        exit;
    }

    // Prepared Statement tanpa password_verify karena plain-text
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $data_admin = $result->fetch_assoc();

        // COCOKAN password langsung (plain-text)
        if ($pass === $data_admin['password']) {

            $_SESSION['id_admin'] = $data_admin['id_admin'];
            $_SESSION['nama'] = $data_admin['nama_admin'];

            echo "<script>alert('Login berhasil!'); window.location='../index.php';</script>";
            exit;

        } else {
            echo "<script>alert('Password salah!'); window.location='../pages/login.php';</script>";
            exit;
        }

    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location='../pages/login.php';</script>";
        exit;
    }

} else {
    header("Location: ../pages/login.php");
    exit;
}
?>

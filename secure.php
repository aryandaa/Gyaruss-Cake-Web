<?php
// Start session dulu wajib
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mode development vs production
if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['REMOTE_ADDR'] === '127.0.0.1') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 0);
}

ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log'); // lebih aman

// Bikin token CSRF kalo belum ada
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Biar gak bisa diakses langsung
if (basename($_SERVER['PHP_SELF']) === 'secure.php') {
    http_response_code(403);
    exit('Forbidden');
}

// Include config hanya sekali
include "config.php";

// Helper untuk sanitize output HTML
if (!function_exists("e")) {
    function e($str) {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
}
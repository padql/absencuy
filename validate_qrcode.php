<?php
session_start();
include 'db/conn.php'; // Koneksi database

$secret_key = "cuy_secret";
$date = date('Y-m-d');
$expected_code = hash('sha256', $date . $secret_key);

// Ambil data user
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Cek apakah kode valid
if (!isset($_GET['code']) || $_GET['code'] !== $expected_code) {
    die("QR Code tidak valid atau sudah kadaluarsa.");
}

// Cek di database apakah sudah scan hari ini
$stmt = $conn->prepare("SELECT * FROM qr_scans WHERE ip_address = ? AND user_agent = ? AND scan_date = ?");
$stmt->execute([$ip_address, $user_agent, $date]);
$existingScan = $stmt->fetch();

if ($existingScan) {
    die("QR Code hanya bisa digunakan sekali per hari di perangkat ini. Silakan coba besok.");
}

// Jika belum scan, simpan ke database
$stmt = $conn->prepare("INSERT INTO qr_scans (ip_address, user_agent, scan_date) VALUES (?, ?, ?)");
$stmt->execute([$ip_address, $user_agent, $date]);

// Redirect ke halaman utama
header("Location: dashboard_awal.php");
exit();
?>

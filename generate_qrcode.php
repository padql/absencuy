<?php
session_start();
include 'db/conn.php'; // Koneksi ke database

require 'vendor/autoload.php'; // Pastikan sudah install library barcode
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Buat kode unik berdasarkan tanggal
$date = date('Y-m-d');
$secret_key = "cuy_secret"; // Bisa diganti dengan sesuatu yang lebih kompleks
$unique_code = hash('sha256', $date . $secret_key);

// Simpan kode ini di sesi
$_SESSION['daily_code'] = $unique_code;

// Buat QR Code
$qrCode = QrCode::create("http://yourwebsite.com/validate_qr.php?code=$unique_code")
    ->setSize(300)
    ->setMargin(10)
    ->setWriter(new PngWriter());

header('Content-Type: ' . $qrCode->getContentType());
echo $qrCode->writeString();
?>

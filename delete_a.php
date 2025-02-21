<?php
include('db/conn.php');

if (isset($_GET['kode_a'])) {
    $kode_a = $_GET['kode_a'];

    // Query hapus data
    $deleteQuery = $conn->query("DELETE FROM absensi WHERE kode_a = '$kode_a'");

    if ($deleteQuery) {
        header("Location: card_absen.php?status=success");
    } else {
        header("Location: card_absen.php?status=error");
    }
}

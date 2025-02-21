<?php
include 'db/conn.php';

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $no_hp = $_POST['no_hp'];

    // Cek apakah NIP ada di database
    $check_query = "SELECT * FROM wakel WHERE nip = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $nip);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows == 0) {
        die("Error: NIP tidak ditemukan di database.");
    }
    $check_stmt->close();

    // Update data dengan prepared statement
    $stmt = $conn->prepare("UPDATE wakel SET nama=?, kelas=?, jk=?, agama=?, no_hp=? WHERE nip=?");
    $stmt->bind_param("ssssss", $nama, $kelas, $jk, $agama, $no_hp, $nip);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui!";
        header("Location: walikelas.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

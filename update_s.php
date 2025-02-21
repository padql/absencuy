<?php
include 'db/conn.php'; // Pastikan file db.php sudah terhubung dengan database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    $no_hp = $_POST['no_hp'];
    $kota = $_POST['kota'];

    

    // Update query
    $query = "UPDATE siswa SET 
                nama = '$nama', 
                kelas = '$kelas', 
                jk = '$jk', 
                agama = '$agama', 
                no_hp = '$no_hp',
                kota = '$kota'
              WHERE nis = '$nis'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil diperbarui dengan nomor HP dan kota acak!";
        header("Location: siswa.php"); // Kembali ke halaman utama
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

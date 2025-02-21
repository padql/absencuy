<?php
include 'db/conn.php'; // Pastikan file db.php sudah terhubung dengan database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $kode_a = $_POST['kode_a'];
    $nis = $_POST['nis'];
    $nip = $_POST['nip'];
    $kelas = $_POST['kelas'];
    $tgl = $_POST['tgl'];
    $ket = $_POST['ket'];
    $infaq = $_POST['infaq'];
    // $email = $_POST['email'];
    // Hash password
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Generate nomor HP acak sebanyak 12 digit
    // $no_hp = '08' . mt_rand(1000000000, 9999999999); // Awal nomor HP dengan '08'

    // Daftar kota untuk diacak
    // $kota_list = [
    //     'Jakarta', 'Surabaya', 'Bandung', 'Yogyakarta', 'Medan', 
    //     'Indramayu', 'Bogor', 'Semarang', 'Bekasi', 'Cirebon', 
    //     'Tangerang', 'Majalengka', 'Cianjur'
    // ];

    // Pilih kota secara acak dari daftar
    // $kota = $kota_list[array_rand($kota_list)];

    

    // Update query
    $query = "UPDATE absensi SET 
                nis = '$nis', 
                nip = '$nip',  
                kelas = '$kelas', 
                tgl = '$tgl',
                ket = '$ket',
                infaq = '$infaq'
                -- email = '$email',
                -- password = '$password'
              WHERE kode_a = '$kode_a'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil diperbarui dengan nomor HP dan kota acak!";
        header("Location: card_absen.php"); // Kembali ke halaman utama
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

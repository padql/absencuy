<?php
include 'db/conn.php';
include 'header.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Template nip
    $nip = str_pad(rand(1, 99999999), 18, "0", STR_PAD_LEFT);

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas']; // Ambil nilai dari select Kelas
    $jk = $_POST['jk']; // Ambil nilai dari select Jenis Kelamin
    $agama = $_POST['agama']; // Ambil nilai dari select Agama
    // Buat nomor HP acak
    $prefix_no_hp = "08";
    $random_digits = str_pad(rand(0, 99999999), 10, "0", STR_PAD_LEFT); // 8 digit acak
    $no_hp = $prefix_no_hp . $random_digits;

    // Query untuk memasukkan data ke tabel siswa
    $stmt = $conn->prepare("INSERT INTO wakel (nip, nama, kelas, jk, agama, no_hp, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nip, $nama, $kelas, $jk, $agama, $no_hp, $hashedPassword);
    if ($stmt->execute()) {
        // Hitung total data setelah penambahan
        $totalQuery = $conn->query("SELECT COUNT(*) AS total FROM wakel");
        $totalData = $totalQuery->fetch_assoc()['total'];

        $limit = 10; // Jumlah data per halaman
        $totalPages = ceil($totalData / $limit);

        // Redirect ke halaman terakhir dengan parameter page
        header("Location: walikelas.php?page=$totalPages");
        exit(); // Jangan lanjutkan eksekusi kode berikutnya
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa</title>
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <h1>Isi cuyyy</h1>

    <form action="add_w.php" method="POST">
        <!-- <label for="nip_lanjutan">nip:</label>
        <input type="text" name="nip_lanjutan" placeholder="Isi angka setelah 22231" required> -->
        
        <label for="nama">Nama:</label>
        <input type="text" name="nama" placeholder="Nama" required pattern="[A-Za-z\s]+" title="Nama apa plat nomor? :p">
        
        <!-- Kelas -->
        <label for="kelas">Kelas:</label>
        <select name="kelas" id="kelas" required>
            <option value="1">Kelas 1</option>
            <option value="2">Kelas 2</option>
            <option value="3">Kelas 3</option>
        </select>

        <!-- Jenip Kelamin -->
        <label for="jk">Jenis Kelamin:</label>
        <select name="jk" id="jk" required>
            <option value="0">Laki-laki</option>
            <option value="1">Perempuan</option>
        </select>

        <!-- Agama -->
        <label for="agama">Agama:</label>
        <select name="agama" id="agama" required>
            <option value="4">Islam</option>
            <option value="5">Kristen</option>
            <option value="6">Katolik</option>
            <option value="7">Hindu</option>
            <option value="8">Buddha</option>
        </select>

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password" required>

        <!-- Submit -->
        <button type="submit" class="contained">Tambah</button>
    </form>
</body>
</html>


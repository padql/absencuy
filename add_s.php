<?php
include 'db/conn.php';
include 'header.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Template NIS
    $prefix_nis = "22231";
    $random_nis = str_pad(rand(0, 99999999), 3, "0", STR_PAD_LEFT); // 3 digit acak
    $nis = $prefix_nis . $random_nis;

    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $jk = $_POST['jk'];
    $agama = $_POST['agama'];
    
    $prefix_no_hp = "08";
    $random_digits = str_pad(rand(0, 99999999), 11, "0", STR_PAD_LEFT); // 11 digit acak
    $no_hp = $prefix_no_hp . $random_digits;

    // Daftar kota
    $kotaList = ['Jakarta', 'Surabaya', 'Bandung', 'Yogyakarta', 'Medan', 'Indramayu', 'Bogor', 'Semarang', 'Bekasi', 'Cirebon', 'Tangerang', 'Majalengka', 'Cianjur'];

    // Pilih kota secara acak
    $kota = $kotaList[array_rand($kotaList)];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Query buat memasukkan data ke tabel siswa
    $stmt = $conn->prepare("INSERT INTO siswa (nis, nama, kelas, jk, agama, no_hp, kota, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $nis, $nama, $kelas, $jk, $agama, $no_hp, $kota, $password);
    $stmt->execute();
    $stmt->close();

    // Hitung total data abis penambahan
    $totalQuery = $conn->query("SELECT COUNT(*) AS total FROM siswa");
    $totalData = $totalQuery->fetch_assoc()['total'];

    // Tentukan halaman terakhir yang harus dituju
    $limit = 10; // Jumlah data per halaman
    $totalPages = ceil($totalData / $limit);

    // Redirect ke halaman terakhir dengan parameter page
    header("Location: siswa.php?page=$totalPages");
    exit(); // Jangan lanjutkan eksekusi kode berikutnya
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

    <form action="add_s.php" method="POST">
        <!-- <label for="nis_lanjutan">NIS:</label>
        <input type="text" name="nis_lanjutan" placeholder="Isi angka setelah 22231" required> -->
        
        <label for="nama">Nama:</label>
        <input type="text" name="nama" placeholder="Nama" required pattern="[A-Za-z\s]+" title="Nama apa plat nomor? :p">
        
        <!-- Kelas -->
        <label for="kelas">Kelas:</label>
        <select name="kelas" id="kelas" required>
            <option value="1">Kelas 1</option>
            <option value="2">Kelas 2</option>
            <option value="3">Kelas 3</option>
        </select>

        <!-- Jenis Kelamin -->
        <label for="jk">Jenis Kelamin:</label>
        <select name="jk" id="jk" required>
            <option value="0">Laki-laki</option>
            <option value="1">Perempuan</option>
        </select>

        <!-- Agama -->
        <label for="agama">Agama:</label>
        <select name="agama" id="agama" required>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select>

        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <!-- Submit -->
        <button type="submit" class="contained">Tambah</button>
    </form>
</body>
</html>


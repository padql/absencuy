<?php
include 'db/conn.php';
include 'header.html';

// Ambil data siswa untuk NIS
$querySiswa = $conn->query("
    SELECT nis, nama, kelas
    FROM siswa 
    WHERE nis NOT IN (SELECT nis FROM absensi)
");

// Ambil data wakel untuk NIP dengan kelas terkait
$queryWakel = $conn->query("SELECT nip, kelas FROM wakel");

$wakelData = [];
while ($row = $queryWakel->fetch_assoc()) {
    $wakelData[$row['kelas']] = $row['nip']; // Map kelas ke NIP
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $prefix_kode_a = "A";
    $random_kode_a = str_pad(rand(0, 99999999), 8, "0", STR_PAD_LEFT); // 8 digit acak
    $kode_a = $prefix_kode_a . $random_kode_a;
    $nis = $_POST['nis'];
    $nip = $_POST['nip'];
    $tgl = $_POST['tgl'];
    $ket = $_POST['ket'];
    $kelas = $_POST['kelas'];

    // Ambil data kelas berdasarkan NIS
    $kelasQuery = $conn->prepare("SELECT kelas FROM siswa WHERE nis = ?");
    $kelasQuery->bind_param("s", $nis);
    $kelasQuery->execute();
    $kelasResult = $kelasQuery->get_result();
    $kelas = $kelasResult->fetch_assoc()['kelas'] ?? null;
    $kelasQuery->close();

    // Query untuk memasukkan data ke tabel absensi
    $stmt = $conn->prepare("INSERT INTO absensi (kode_a, nis, nip, tgl, ket, kelas) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $kode_a, $nis, $nip, $tgl, $ket, $kelas);
    $stmt->execute();
    $stmt->close();

    // Hitung total data setelah penambahan
    $totalQuery = $conn->query("SELECT COUNT(*) AS total FROM absensi");
    $totalData = $totalQuery->fetch_assoc()['total'];

    // Tentukan halaman terakhir yang harus dituju
    $limit = 10;
    $totalPages = ceil($totalData / $limit);

    // Redirect ke halaman terakhir
    header("Location: add_a.php?status=succes");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Absensi</title>
    <link href="css/style.css" rel="stylesheet" />
    <script>
        // Data wakel sesuai kelas
        const wakelData = <?= json_encode($wakelData) ?>;

        // Update kelas dan pilih NIP otomatis
        function updateKelas() {
            const nisSelect = document.getElementById("nis");
            const kelasInput = document.getElementById("kelas");
            const nipInput = document.getElementById("nip");

            const selectedOption = nisSelect.options[nisSelect.selectedIndex];
            if (!selectedOption) {
                kelasInput.value = ""; // Jika tidak ada NIS yang dipilih
                nipInput.value = "";
                return;
            }

            const selectedKelas = selectedOption.getAttribute("data-kelas");

            // Update kelas input
            kelasInput.value = selectedKelas || ""; // Kosongkan jika data-kelas tidak valid

            // Pilih NIP otomatis berdasarkan kelas
            nipInput.value = wakelData[selectedKelas] || ""; // Kosongkan jika kelas tidak memiliki NIP
        }

        // Set tanggal otomatis ke hari ini
        window.addEventListener('DOMContentLoaded', () => {
            const tglInput = document.getElementById('tgl');
            const today = new Date().toISOString().split('T')[0];
            tglInput.value = today;
        });
    </script>
</head>
<body>
    <h1>Tambah Absensi</h1>

    <form action="" method="POST">
        <!-- Combo box untuk NIS -->
        <label for="nis">NIS:</label>
        <select name="nis" id="nis" onchange="updateKelas()" required>
            <option value="">-- Pilih NIS --</option>
            <?php while ($row = $querySiswa->fetch_assoc()): ?>
                <option 
                    value="<?= htmlspecialchars($row['nis']) ?>" 
                    data-kelas="<?= htmlspecialchars($row['kelas']) ?>">
                    <?= htmlspecialchars($row['nis']) ?> - <?= htmlspecialchars($row['nama']) ?> - <?= htmlspecialchars($row['kelas']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <!-- Input kelas -->
        <label for="kelas">Kelas:</label>
        <input type="text" id="kelas" name="kelas" readonly required>

        <!-- Input NIP -->
        <label for="nip">NIP:</label>
        <input type="text" id="nip" name="nip" readonly required>

        <!-- Input Tanggal -->
        <label for="tgl">Tanggal:</label>
        <input type="date" id="tgl" name="tgl" required>

        <!-- Input Keterangan -->
        <label for="ket">Keterangan:</label>
        <select name="ket" id="ket" required>
            <option value="0">Hadir</option>
            <option value="1">Alpa</option>
            <option value="2">Izin</option>
            <option value="3">Sakit</option>
        </select>

        <button type="submit" class="contained">Tambah</button>
    </form>
</body>
</html>

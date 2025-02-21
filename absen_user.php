<?php
include 'db/conn.php';  // Koneksi ke database

$message = "";

// Variabel nis harus didefinisikan sebelum digunakan
$nis = '';
$nip = ''; // Inisialisasi variabel nip sebagai string kosong

// Cek jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];  // Ambil nilai NIS dari form
    $nip = $_POST['nip'];  // NIP otomatis
    $tgl = date('Y-m-d');  // Tanggal hari ini
    $ket = "Hadir";        // Status kehadiran
    $infaq = 5000;         // Infaq

    // Validasi input
    if (!empty($nis)) {
        // Cek apakah NIS sudah ada di tabel absensi
        $checkSql = "SELECT * FROM absensi WHERE nis = '$nis' AND tgl = '$tgl'";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            // Jika sudah ada, tampilkan pesan bahwa siswa sudah absen
            $message = "NIS $nis sudah melakukan absen pada tanggal ini.";
        } else {
            // Query untuk menyimpan data absen
            $sql = "INSERT INTO absensi (nis, nip, tgl, ket, infaq) VALUES ('$nis', '$nip', '$tgl', '$ket', '$infaq')";

            if ($conn->query($sql) === TRUE) {
                $message = "Absen berhasil!";
            } else {
                $message = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        $message = "NIS harus diisi!";
    }
}

// Ambil daftar NIS dari tabel siswa
$siswaQuery = "SELECT nis, nama FROM siswa";
$siswaResult = $conn->query($siswaQuery);
$siswaList = [];
while ($row = $siswaResult->fetch_assoc()) {
    $siswaList[] = $row;
}

// Cek jika NIS sudah absen hari ini
$nisAbsen = isset($_POST['nis']) ? $_POST['nis'] : '';
$checkAbsenQuery = "SELECT * FROM absensi WHERE nis = '$nisAbsen' AND tgl = CURDATE()";
$checkAbsenResult = $conn->query($checkAbsenQuery);
$isAbsened = $checkAbsenResult->num_rows > 0;

// Ambil data NIP berdasarkan NIS
if (isset($nis) && !$isAbsened) {
    $siswaQuery = "SELECT nip FROM siswa WHERE nis = '$nis'";
    $siswaResult = $conn->query($siswaQuery);
    
    // Pastikan query berhasil
    if ($siswaResult && $siswaResult->num_rows > 0) {
        $row = $siswaResult->fetch_assoc();
        $nip = $row['nip']; // Ambil NIP dari query jika ada
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absen Siswa</title>
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
            const selectedKelas = selectedOption.getAttribute("data-kelas");

            // Update kelas input
            kelasInput.value = selectedKelas;

            // Pilih NIP otomatis berdasarkan kelas
            nipInput.value = wakelData[selectedKelas] || ""; // Kosongkan jika kelas tidak memiliki NIP
        }
    </script>
</head>
<body>

    <h2>Form Absen Siswa</h2>

    <!-- Tampilkan pesan jika ada -->
    <?php if(isset($message)) { echo "<p>$message</p>"; } ?>

    <!-- Form Input -->
    <form action="absen.php" method="POST">
        <?php if (!$isAbsened) { ?>
            <label for="nis">Nomor Induk Siswa (NIS): </label>
            <select id="nis" name="nis" required onchange="updateKelas()">
                <option value="">Pilih NIS</option>
                <?php foreach ($siswaList as $siswa) { ?>
                    <option value="<?php echo $siswa['nis']; ?>" <?php echo ($siswa['nis'] == $nis) ? 'selected' : ''; ?>>
                        <?php echo $siswa['nis']; ?> - <?php echo $siswa['nama']; ?>
                    </option>
                <?php } ?>
            </select><br><br>
        <?php } else { ?>
            <p>NIS Anda sudah absen hari ini.</p>
        <?php } ?>

        <?php if (isset($nis) && !$isAbsened) { ?>
            <label for="nip">NIP: </label>
            <input type="text" id="nip" name="nip" value="<?php echo htmlspecialchars($nip); ?>" readonly><br><br>
        <?php } ?>

        <input type="submit" value="Kirim Absen">
    </form>

</body>
</html>

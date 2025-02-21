<?php
include('header.html');
include('db/conn.php');

// Ambil kode absen dari URL
// Ambil kode absen dari parameter URL
$kodeAbsen = isset($_GET['kode_a']) ? $_GET['kode_a'] : null;

if (!$kodeAbsen) {
    die("Kode absen tidak ditemukan.");
}

// Query untuk mengambil data berdasarkan kode_a
$query = "SELECT * FROM absensi WHERE kode_a = '$kodeAbsen'";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    die("Data tidak ditemukan.");
}

$data = $result->fetch_assoc();


// Proses update data jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nis = $conn->real_escape_string($_POST['nis']);
    $nip = $conn->real_escape_string($_POST['nip']);
    $kelas = $conn->real_escape_string($_POST['kelas']);
    $tgl = $conn->real_escape_string($_POST['tgl']);
    $ket = $conn->real_escape_string($_POST['ket']);
    $infaq = $conn->real_escape_string($_POST['infaq']);

    $updateQuery = "UPDATE absensi SET nis = '$nis', nip = '$nip', kelas = '$kelas', tgl = '$tgl', ket = '$ket', infaq = '$infaq' WHERE kode_a = '$kodeAbsen'";
    
    if ($conn->query($updateQuery)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='card_absen.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Edit Absensi</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Data Absensi</h2>
        <form method="POST" class="mt-4">
            <div class="form-group">
                <label for="nis">NIS</label>
                <input type="text" class="form-control" id="nis" name="nis" value="<?php echo htmlspecialchars($data['nis']); ?>" required>
            </div>
            <div class="form-group">
                <label for="nip">NIP</label>
                <input type="text" class="form-control" id="nip" name="nip" value="<?php echo htmlspecialchars($data['nip']); ?>" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['kelas']); ?>" required>
            </div>
            <div class="form-group">
                <label for="tgl">Tanggal</label>
                <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo htmlspecialchars($data['tgl']); ?>" required>
            </div>
            <div class="form-group">
                <label for="ket">Keterangan</label>
                <select  id="ket" name="ket">
                    <option value="0" <?php echo ($data['ket'] === '0') ? 'selected' : ''; ?>>Hadir</option>
                    <option value="1" <?php echo ($data['ket'] === '1') ? 'selected' : ''; ?>>Izin</option>
                    <option value="2" <?php echo ($data['ket'] === '2') ? 'selected' : ''; ?>>Sakit</option>
                    <option value="3" <?php echo ($data['ket'] === '3') ? 'selected' : ''; ?>>Alfa</option>
                </select>
            </div>
            <div class="form-group">
                <label for="infaq">Infaq</label>
                <input type="number" class="form-control" id="infaq" name="infaq" value="<?php echo htmlspecialchars($data['infaq']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" onclick="window.history.back();" class="outlined">Kembali</button>
        </form>
    </div>
    <?php
    include 'footer.html';
    ?>
</body>

</html>

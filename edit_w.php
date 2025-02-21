<?php
include('header.html');
include('db/conn.php');

// Ambil data Wakel berdasarkan nip yang dikirim melalui URL
$nip = $_GET['nip'];
$query = "SELECT * FROM Wakel WHERE nip = '$nip'";
$result = $conn->query($query);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Wakel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <h1>Edit Data Wakel</h1>
    <form action="update_w.php" method="POST">
        <!-- nip (diisi dengan nilai yang sudah ada) -->
        <input type="text" name="nip" value="<?php echo $row['nip']; ?>" required>

        <!-- Nama -->
        <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required pattern="[A-Za-z\s]+" title="Nama apa plat nomor? :p">

        <!-- Kelas -->
        <select name="kelas" required>
            <option value="1" <?php echo ($row['kelas'] == 1) ? 'selected' : ''; ?>>Kelas 1</option>
            <option value="2" <?php echo ($row['kelas'] == 2) ? 'selected' : ''; ?>>Kelas 2</option>
            <option value="3" <?php echo ($row['kelas'] == 3) ? 'selected' : ''; ?>>Kelas 3</option>
        </select>

        <!-- Jenip Kelamin -->
        <select name="jk" required>
            <option value="0" <?php echo ($row['jk'] == 0) ? 'selected' : ''; ?>>Laki-laki</option>
            <option value="1" <?php echo ($row['jk'] == 1) ? 'selected' : ''; ?>>Perempuan</option>
        </select>

        <!-- Agama -->
        <select name="agama" required>
            <option value="4" <?php echo ($row['agama'] == 4) ? 'selected' : ''; ?>>Islam</option>
            <option value="5" <?php echo ($row['agama'] == 5) ? 'selected' : ''; ?>>Kristen</option>
            <option value="6" <?php echo ($row['agama'] == 6) ? 'selected' : ''; ?>>Katolik</option>
            <option value="7" <?php echo ($row['agama'] == 7) ? 'selected' : ''; ?>>Hindu</option>
            <option value="8" <?php echo ($row['agama'] == 8) ? 'selected' : ''; ?>>Buddha</option>
            <option value="9" <?php echo ($row['agama'] == 9) ? 'selected' : ''; ?>>Konghucu</option>
        </select>

        <!-- No HP -->
        <input type="number" name="no_hp" value="<?php echo $row['no_hp']; ?>" required>

        <!-- Submit -->
        <button type="submit" class="contained">Update</button>
        <button type="button" onclick="window.history.back();" class="outlined">Kembali</button>
    </form>
</body>
</html>

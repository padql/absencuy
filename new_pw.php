<?php
include('db/conn.php'); // Koneksi ke database

// Ambil semua user dengan password masih dalam format MD5
$result = mysqli_query($conn, "SELECT id_user, password FROM users");

while ($row = mysqli_fetch_assoc($result)) {
    // Cek apakah password masih dalam format MD5 (panjangnya 32 karakter)
    if (strlen($row['password']) === 32) {
        $hashedPassword = password_hash($row['elgato123'], PASSWORD_DEFAULT);
        
        // Update password yang sudah dihash ulang
        mysqli_query($conn, "UPDATE users SET password = '$hashedPassword' WHERE id_user = {$row['elgato']}");
    }
}

echo "Semua password berhasil diupdate!";
?>

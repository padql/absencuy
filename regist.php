<?php
// Koneksi ke database
require 'db/conn.php';
// Proses form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $role = $_POST['role'];

    // Insert ke database
    $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['username' => $username, 'password' => $password, 'role' => $role])) {
        echo "User berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan user.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input User</title>
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="login-box">
    <form method="post">
        <h2>Tambah User</h2>
        <label>Username:</label>
        <input type="text" name="username" required><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br>
        
        <label>Role:</label>
        <select name="role">
            <option value="admin">Admin</option>
            <option value="guru">Guru</option>
            <option value="user">User</option>
        </select><br>
        
        <button type="submit" class="contained">Simpan</button>
        <button type="button" onclick="window.history.back();" class="outlined">Kembali</button>
    </form>
</div>
</body>
</html>

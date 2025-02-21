    <?php
    session_start();

    include('db/conn.php'); // Pastikan koneksi database sudah benar

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password']; // Tanpa hash dulu

        $query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Cek password dengan password_verify()
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id_user'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Redirect sesuai role
                header('Location: ' . ($user['role'] == 'guru' ? 'dashboard_guru.php' : 'dashboard_siswa.php'));
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil login.',
                        icon: 'success',
                    });
                });
                </script>";
                exit();
            } else {
                echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Pasword salah.',
                        icon: 'error',
                    });
                });
                </script>";
            }
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: 'Perhatian!',
                        text: 'User tidak ditemukan.',
                        icon: 'warning',
                    });
                });
                </script>";
        }
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cuy Absen</title>
        <link href="css/style.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div class="login-box">
            <form method="POST">
                <h1>Login</h1>
                <input type="text" name="username" placeholder="Username" autocomplete="username" required>
                <input type="password" name="password" placeholder="Password" autocomplete="current-password" required>
                <button type="submit" class="contained">Login</button>
                <a href="dashboard_awal.php"><button type="button" class="outlined">Kembali</button></a>
                <a href="regist.php">Daftar akun</a>
            </form>
        </div>    
    </body>
    </html>

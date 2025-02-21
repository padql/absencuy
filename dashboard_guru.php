<?php
session_start();



include('db/conn.php'); 

if ($_SESSION['role'] === 'guru') {
    include('header.html');
    echo "Guru page loaded"; 
}

var_dump($conn);

if (!$conn) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

$distinctClassQuery = $conn->query("SELECT DISTINCT kelas FROM absensi ORDER BY kelas ASC");
if (!$distinctClassQuery) {
    die("Query gagal: " . $conn->error);
}

$classes = $distinctClassQuery->fetch_all(MYSQLI_ASSOC);

var_dump($classes);

$selectedClass = isset($_GET['kelas']) ? $conn->real_escape_string($_GET['kelas']) : null;
$absensi = [];
if ($selectedClass) {
    if ($selectedClass === 'all') {
        $query = "SELECT * FROM absensi";
    } else {
        $query = "SELECT * FROM absensi WHERE kelas = '$selectedClass'";
    }

    $result = $conn->query($query);
    if ($result) {
        $absensi = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        die("Query gagal: " . $conn->error);
    }
}

$user = isset($_SESSION['username']) ? $_SESSION['username'] : 'GUEST';

var_dump($absensi);
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Absensi Kelas</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/style.css">
  <style>
        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }

        .background {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            margin: 0;
            padding: 0;
            background: #d1e3ff;
            overflow: hidden;
            z-index: 0;
        }

        .background li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(153, 161, 199, 0.5);
            box-shadow: 0 0 10px 1px rgba(255, 255, 255, 0.2);
            
            animation: animate 36s linear infinite;
            z-index: 1;
        }

            .background li:nth-child(0) { left: 82%; width: 141px; height: 141px; bottom: -141px; animation-delay: 1s; }
            .background li:nth-child(1) { left: 69%; width: 266px; height: 266px; bottom: -266px; animation-delay: 4s; }
            .background li:nth-child(2) { left: 11%; width: 128px; height: 128px; bottom: -128px; animation-delay: 9s; }
            .background li:nth-child(3) { left: 44%; width: 182px; height: 182px; bottom: -182px; animation-delay: 8s; }
            .background li:nth-child(4) { left: 34%; width: 141px; height: 141px; bottom: -141px; animation-delay: 14s; }
            .background li:nth-child(5) { left: 28%; width: 223px; height: 223px; bottom: -223px; animation-delay: 1s; }
            .background li:nth-child(6) { left: 78%; width: 186px; height: 186px; bottom: -186px; animation-delay: 8s; }
            .background li:nth-child(7) { left: 82%; width: 228px; height: 228px; bottom: -228px; animation-delay: 19s; }
            .background li:nth-child(8) { left: 33%; width: 162px; height: 162px; bottom: -162px; animation-delay: 17s; }
            .background li:nth-child(9) { left: 62%; width: 273px; height: 273px; bottom: -273px; animation-delay: 36s; }

            .user {
                color:rgb(0, 54, 112);
            }
    </style>

</head>

<body>
    <ul class="background">
    <section class="slider_section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="detail-box">
              <h1 class="index">
                SELAMAT DATANG <span class="user"><?php echo htmlspecialchars($user, ENT_QUOTES, 'UTF-8'); ?></span>
              </h1>
              <p class="index-p">
                Ipsum officia cillum irure do veniam sunt consequat duis sint cupidatat ipsum. Adipisicing dolor culpa aute eiusmod ipsum nulla eu sit velit voluptate deserunt do. Ad veniam irure dolor occaecat duis. Laborum excepteur aliquip cupidatat officia est velit.
              </p>
                  <a href="add_a.php" class="btn btn-primary">
                    Tambah Absen
                  </a>
            </div>
          </div>
        </div>
      </div>
    </section>
            <li></li><li></li><li></li><li></li><li></li>
            <li></li><li></li><li></li><li></li><li></li>
    </ul>

</body>

</html>

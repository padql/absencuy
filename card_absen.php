<?php
include('header.html');
include('db/conn.php');

// Ambil semua data kelas yang tersedia
$distinctClassQuery = $conn->query("SELECT DISTINCT kelas FROM absensi ORDER BY kelas ASC");
if (!$distinctClassQuery) {
    die("Query gagal: " . $conn->error);
}
$classes = $distinctClassQuery->fetch_all(MYSQLI_ASSOC);

// Ambil data absensi berdasarkan kelas yang dipilih
$selectedClass = isset($_GET['kelas']) ? $conn->real_escape_string($_GET['kelas']) : null;
$absensi = [];
if ($selectedClass) {
    if ($selectedClass === 'all') {
        // Query untuk semua kelas
        $query = "SELECT * FROM absensi";
    } else {
        // Query untuk kelas tertentu
        $query = "SELECT * FROM absensi WHERE kelas = '$selectedClass'";
    }

    $result = $conn->query($query);
    if ($result) {
        $absensi = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        die("Query gagal: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Absensi Kelas</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- font awesome style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet" />
  <style>
    .card {
      height: 50vh;
      cursor: pointer;
      position: relative;
      background: linear-gradient(to top, rgba(192, 219, 240, 1), rgba(173, 210, 238, 1));
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow: hidden;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 15px rgba(0, 0, 0, 0);
    }

    /* Gradien untuk efek muncul dari bawah */
    .card::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 0%;
      background: linear-gradient(to top, rgba(139, 184, 218, 1), rgba(0, 0, 0, 0));
      z-index: 1;
      transition: height 0.3s ease;
    }

    .card:hover::after {
      height: 80%;
    }

    .card-title {
      font-size: 4.6rem;

      font-weight: bold;
      color: black;
      transition: color 0.3s;
    }

    .card-title-all {
      font-size: 2.6rem;

      font-weight: bold;
      color: black;
      transition: color 0.3s;
    }

    .card-text {
      font-size: 0.9rem;
      visibility: hidden;
      opacity: 0;
      color: rgba(255, 255, 255, 0);
      transition: visibility 0.3s, opacity 0.3s, color 0.3s;
      z-index: 2; /* Supaya tetap di atas efek hover */
    }

    .card:hover .card-text {
      visibility: visible;
      opacity: 0.8;
      color: rgba(0, 0, 0, 0.8);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Teks title di tengah, detail di bawah */
        align-items: center;
        height: 100%; /* Pastikan memenuhi tinggi kartu */
        width: 100%;
        padding: 20px;
        z-index: 2; /* Tetap di atas */
    }

    .card-title {
        margin-top: 100px; /* Supaya tetap di tengah vertikal */
    }

    .card-title-all {
        margin-top: 100px; /* Supaya tetap di tengah vertikal */
    }

    .card-text {
        margin-bottom: auto; /* Tetap di bagian bawah */
    }
</style>

</head>

<body>
  <section class="class-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-16">
          <h2 class="mt-4 mb-4">PILIH KELAS</h2>
          <div class="row">
            <!-- Card untuk semua kelas -->
            <div class="col-lg-3 col-md-6 mb-4">
              <div class="card" onclick="window.location.href='absen.php?kelas=all'">
                <div class="card-body text-center">
                  <h5 class="card-title-all">Semua <br /> Kelas</h5>
                  <p class="card-text">Klik untuk melihat absensi semua kelas</p>
                </div>
              </div>
            </div>

            <!-- Card untuk masing-masing kelas -->
            <?php foreach ($classes as $class): ?>
              <div class="col-lg-3 col-md-6 mb-4">
                <div class="card" onclick="window.location.href='absen.php?kelas=<?php echo urlencode($class['kelas']); ?>'">
                  <div class="card-body text-center">
                    <h5 class="card-title"><?php echo htmlspecialchars($class['kelas']); ?></h5>
                    <p class="card-text">Klik untuk melihat absensi kelas ini</p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>

<?php
session_start();
include('header.html');
include('db/conn.php');

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Ambil role dari session
$role = $_SESSION['role']; // "guru" atau "siswa"

// Logika Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman aktif
$offset = ($page - 1) * $limit; // Data mulai ditampilkan

// Hitung total data
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM siswa");
$totalData = $totalQuery->fetch_assoc()['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data sesuai limit dan offset
$result = $conn->query("SELECT * FROM siswa LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Daftar Siswa</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!-- font awesome style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="css/style.css" rel="stylesheet" />
  <style>
    .back-button {
      width: 3%;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <!-- about section -->
  <section class="siswa-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <div class="siswa-box">
            <div class="back-button"> 
              <button type="button" onclick="window.history.back();" class="outlined"><i class="fa-solid fa-angle-left"></i></button>
            </div>
            <h2>Daftar Siswa</h2>
            <?php if ($role === 'guru'): ?>
                <a href="add_s.php" class="button-outlined">
                    <i class="fas fa-plus text-primary"></i>
                </a>
            <?php endif; ?>
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>JK</th>
                  <th>Agama</th>
                  <th>No HP</th>
                  <th>Kota</th>
                  <?php if ($role === 'guru'): ?>
                  <th>Aksi</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $nomor = $offset + 1; // Menambahkan offset agar nomor urut sesuai halaman
                while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= htmlspecialchars($row['nis']); ?></td>
                        <td><?= htmlspecialchars($row['nama']); ?></td>
                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                        <td><?= htmlspecialchars($row['jk']); ?></td>
                        <td><?= htmlspecialchars($row['agama']); ?></td>
                        <td><?= htmlspecialchars($row['no_hp']); ?></td>
                        <td><?= htmlspecialchars($row['kota']); ?></td>
                        <?php if ($role === 'guru'): ?>
                        <td>
                            <a href="edit_s.php?nis=<?= $row['nis']; ?>" title="Edit">
                              <i class="fas fa-edit text-primary"></i>
                            </a> 
                              |
                            <a href="delete_s.php?nis=<?= $row['nis']; ?>" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                              <i class="fas fa-trash text-danger"></i>
                            </a>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php
                    $nomor++;
                endwhile;
                ?>
              </tbody>
            </table>
  
            <!-- Navigasi Halaman -->
            <div class="pagination">
              <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Sebelumnya</a>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?php echo $i; ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                  <?php echo $i; ?>
                </a>
              <?php endfor; ?>

              <?php if ($page < $totalPages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Berikutnya &raquo;</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
</html>

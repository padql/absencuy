<?php
include('header.html');
include('db/conn.php');

// Logika Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman aktif
$page = max(1, $page); // Minimal halaman 1
$offset = ($page - 1) * $limit; // Data mulai ditampilkan

// Ambil kelas dari parameter URL
$selectedClass = isset($_GET['kelas']) ? $conn->real_escape_string($_GET['kelas']) : null;

// Cek jika kelas dipilih
if ($selectedClass) {
    if ($selectedClass === 'all') {
        // Query untuk semua kelas
        $totalQuery = $conn->query("SELECT COUNT(*) AS total FROM absensi");
        $query = "SELECT * FROM absensi ORDER BY kelas, tgl LIMIT $limit OFFSET $offset";
    } else {
        // Query untuk kelas tertentu
        $totalQuery = $conn->query("SELECT COUNT(*) AS total FROM absensi WHERE kelas = '$selectedClass'");
        $query = "SELECT * FROM absensi WHERE kelas = '$selectedClass' ORDER BY tgl LIMIT $limit OFFSET $offset";
    }

    if (!$totalQuery) {
        die("Query total gagal: " . $conn->error);
    }

    $totalData = $totalQuery->fetch_assoc()['total'];
    $totalPages = ceil($totalData / $limit);

    $result = $conn->query($query);
    if (!$result) {
        die("Query absensi gagal: " . $conn->error);
    }
    $absensi = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $selectedClass = 'all'; // Default ke semua kelas jika parameter tidak valid
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Absensi Kelas</title>

  <!-- Bootstrap Core CSS -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    .pagination a {
      margin: 0 5px;
      text-decoration: none;
      color: #007bff;
    }

    .pagination a.active {
      font-weight: bold;
      text-decoration: none;
      color: #0056b3;
    }
    
    .back-button {
      width: 3%;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <div class="back-button"> 
      <button type="button" onclick="window.history.back();" class="outlined"><i class="fa-solid fa-angle-left"></i></button>
    </div>
    <h2>
      <?php
      if ($selectedClass === 'all') {
          echo "Absensi Semua Kelas";
      } else {
          echo "Absensi Kelas " . htmlspecialchars($selectedClass);
        }
        ?>
    </h2>
    <table class="table table-striped mt-3">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Absen</th>
          <th>NIS</th>
          <th>NIP</th>
          <th>Kelas</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Infaq</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($absensi)): $nomor = $offset + 1; ?>
          <?php foreach ($absensi as $row): ?>
            <tr>
              <td><?php echo $nomor++; ?></td>
              <td><?php echo htmlspecialchars($row['kode_a']); ?></td>
              <td><?php echo htmlspecialchars($row['nis']); ?></td>
              <td><?php echo htmlspecialchars($row['nip']); ?></td>
              <td><?php echo htmlspecialchars($row['kelas']); ?></td>
              <td><?php echo htmlspecialchars($row['tgl']); ?></td>
              <td><?php echo htmlspecialchars($row['ket']); ?></td>
              <td><?php echo htmlspecialchars($row['infaq']); ?></td>
              <td>
                  <a href="edit_a.php?kode_a=<?php echo urlencode($row['kode_a']); ?>" title="Edit">
                    <i class="fas fa-edit text-primary"></i>
                  </a> 
                  |
                  <a href="delete_a.php?kode_a=<?php echo urlencode($row['kode_a']); ?>" title="Hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                    <i class="fas fa-trash text-danger"></i>
                  </a>

              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Data tidak ditemukan</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <!-- Navigasi Halaman -->
    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?kelas=<?php echo urlencode($selectedClass); ?>&page=<?php echo $page - 1; ?>">&laquo; Sebelumnya</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?kelas=<?php echo urlencode($selectedClass); ?>&page=<?php echo $i; ?>" <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>

      <?php if ($page < $totalPages): ?>
        <a href="?kelas=<?php echo urlencode($selectedClass); ?>&page=<?php echo $page + 1; ?>">Berikutnya &raquo;</a>
      <?php endif; ?>
    </div>
  </div>
  <?php
    include 'footer.html' 
  ?>
</body>

</html>

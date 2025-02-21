<?php
include 'db/conn.php';

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $stmt = $conn->prepare("DELETE FROM siswa WHERE nis = ?");
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $stmt->close();
    header("Location: siswa.php");
}
?>

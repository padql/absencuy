<?php
include 'db/conn.php';

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];
    $stmt = $conn->prepare("DELETE FROM wakel WHERE nip = ?");
    $stmt->bind_param("s", $nip);
    $stmt->execute();
    $stmt->close();
    header("Location: walikelas.php");
}
?>

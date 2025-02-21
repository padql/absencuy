<?php
session_start();
session_unset();  // Hapus semua session variables
session_destroy(); // Hapus session

// Redirect ke index.php
header("Location: index.php");
exit();
?>

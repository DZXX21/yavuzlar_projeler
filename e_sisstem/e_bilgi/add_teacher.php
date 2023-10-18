<!-- add_teacher.php -->
<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Öğretmen eklemek için form ekleyin...
?>

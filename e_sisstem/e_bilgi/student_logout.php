<?php
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header("Location: student_login.php");
exit;
?>

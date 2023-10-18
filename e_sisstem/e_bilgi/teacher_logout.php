<?php
session_start();

// Oturumu sonlandır
session_unset();
session_destroy();

// Kullanıcıyı öğretmen giriş sayfasına yönlendir
header("Location: teacher_login.php");
exit;
?>

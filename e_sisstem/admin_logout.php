<?php
session_start();

// Tüm oturum değişkenlerini temizle
session_unset();

// Oturumu sonlandır
session_destroy();

// Giriş sayfasına yönlendir
header("Location: login.php");
exit;
?>

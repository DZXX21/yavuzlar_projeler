<?php
session_start();

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı "login.html" sayfasına yönlendir
header("Location: login.html");
exit();
?>

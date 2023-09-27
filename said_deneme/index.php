<?php
session_start();

// Tarayıcı önbelleğini devre dışı bırak
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı "login.html" sayfasına yönlendir
header("Location: login.html");
exit();
?>

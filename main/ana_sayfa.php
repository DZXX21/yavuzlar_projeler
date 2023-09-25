<?php
session_start();
if (!isset($_SESSION["kullanici_adi"])) {
    // Kullanıcı oturumu yoksa, giriş yapma sayfasına yönlendirin.
    header("Location: giris_sayfasi.php");
    exit();
}

// Kullanıcı oturumu varsa, hoş geldiniz mesajı veya kullanıcıya özel içerik gösterebilirsiniz.
$kullanici_adi = $_SESSION["kullanici_adi"];
echo "Hoş geldiniz, $kullanici_adi!";
?>

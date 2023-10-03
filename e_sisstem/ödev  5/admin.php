<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "kullanici_adi";
$password = "parola";
$dbname = "veritabani_adi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Formdan gelen kullanıcı adı ve şifre
$kullaniciAdi = $_POST["kullaniciAdi"];
$sifre = $_POST["sifre"];

// Kullanıcı adı ve şifre kontrolü (Örnek: "admin" kullanıcısı ve "password" şifre)
if ($kullaniciAdi === "admin" && $sifre === "password") {
    // Kullanıcı doğrulandı, yönetici sayfasına yönlendir
    header("Location: admin_yonetim.php");
} else {
    echo "Hatalı kullanıcı adı veya şifre. Tekrar deneyin.";
}

$conn->close();
?>

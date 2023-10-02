<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "e_sistem";

// MySQL sunucusuna bağlantı oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eposta = $_POST["eposta"];
    $sifre = $_POST["sifre"];

    // Veritabanından kullanıcıyı sorgulayın
    $sql = "SELECT * FROM kullancilar WHERE eposta='$eposta'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($sifre, $row["sifre"])) {
            echo "Giriş başarılı!";
            // Giriş başarılı ise kullanıcıyı başka bir sayfaya yönlendirin
        } else {
            echo "Şifre yanlış!";
        }
    } else {
        echo "Kullanıcı bulunamadı!";
    }

    // Bağlantıyı kapat
    $conn->close();
}
?>

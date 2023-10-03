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
    $isim = $_POST["isim"];
    $soyisim = $_POST["soyisim"];
    $tc = $_POST["tc"];
    $eposta = $_POST["eposta"];
    
    // Öğretmen seçeneği kontrolü
    $ogretmen = isset($_POST["ogretmen"]) ? ($_POST["ogretmen"] == "Evet" ? "Öğretmen" : "") : ""; // Eğer işaretlenmediyse boş bırak
    
    $sifre = password_hash($_POST["sifre"], PASSWORD_DEFAULT);

    // SQL sorgusu ile veritabanına kullanıcı ekleyin
    $sql = "INSERT INTO kullancilar (isim, soyisim, tc, eposta, ogretmen, sifre) VALUES ('$isim', '$soyisim', '$tc', '$eposta', '$ogretmen', '$sifre')";

    if ($conn->query($sql) === TRUE) {
        echo "Kayıt başarıyla tamamlandı.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
    
    // Bağlantıyı kapat
    $conn->close();
}


<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

// Veritabanına bağlanma
$conn = mysqli_connect($host, $username, $password, $database);

// Bağlantıyı kontrol etme
if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = mysqli_real_escape_string($conn, $_POST["kullanici_adi"]);
    $sifre = mysqli_real_escape_string($conn, $_POST["sifre"]);
    
    // Kullanıcı adı ve şifre kontrolü
    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$kullanici_adi' AND sifre='$sifre'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Kullanıcı girişi başarılı
        $_SESSION["kullanici_adi"] = $kullanici_adi; // Oturum başlat
        header("Location: ana_sayfa.php"); 
    } else {
        // Kullanıcı girişi başarısız
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}

// Bağlantıyı kapatma işlemi gereksizdir ve bu satırı kaldırın
// $conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "e_sistem";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri al
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Şifre güvenli bir şekilde hash'le

    // Veritabanına yönetici kaydı ekle
    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Yönetici kaydı başarıyla eklendi.";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
}
?>

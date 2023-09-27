<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = $_POST["kullanici_adi"];
    $sifre = $_POST["sifre"];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT kullanici_adi, sifre FROM kullanicilar WHERE kullanici_adi=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $kullanici_adi);
    $stmt->execute();
    $stmt->bind_result($db_kullanici_adi, $db_sifre);
    $stmt->fetch();

    if (password_verify($sifre, $db_sifre)) {
        $_SESSION["kullanici_adi"] = $kullanici_adi;
        $stmt->close();
        $conn->close();
        header("Location: ana_sayfa.php");
        exit();
    } else {
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}
?>
<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";


$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
    die("Bağlantı hatası: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = mysqli_real_escape_string($conn, $_POST["kullanici_adi"]);
    $sifre = mysqli_real_escape_string($conn, $_POST["sifre"]);
    
    
    $sql = "SELECT * FROM kullanicilar WHERE kullanici_adi='$kullanici_adi' AND sifre='$sifre'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        $_SESSION["kullanici_adi"] = $kullanici_adi; 
        header("Location: ana_sayfa.php"); 
    } else {
      
        echo "Kullanıcı adı veya şifre hatalı.";
    }
}


?>

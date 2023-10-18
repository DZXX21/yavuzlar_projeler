<?php
session_start();

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

// Öğrenci ID'sini al
if (isset($_GET["id"])) {
    $student_id = $_GET["id"];

    // Öğrenci bilgilerini veritabanından sorgula
    $sql = "SELECT * FROM students WHERE id = $student_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $isim = $row["isim"];
        $soyisim = $row["soyisim"];
        $numara = $row["numara"];
        $sinif = $row["sinif"];
        $tc_kimlik = $row["tc_kimlik"];
    } else {
        echo "Öğrenci bilgileri bulunamadı.";
    }
} else {
    echo "Geçersiz öğrenci ID'si.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Detayları</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Detayları</h2>
        <table>
            <tbody>
                <tr>
                    <td><strong>İsim:</strong></td>
                    <td><?php echo $isim; ?></td>
                </tr>
                <tr>
                    <td><strong>Soyisim:</strong></td>
                    <td><?php echo $soyisim; ?></td>
                </tr>
                <tr>
                    <td><strong>Öğrenci Numarası:</strong></td>
                    <td><?php echo $numara; ?></td>
                </tr>
                <tr>
                    <td><strong>Sınıf:</strong></td>
                    <td><?php echo $sinif; ?></td>
                </tr>
                <tr>
                    <td><strong>TC Kimlik:</strong></td>
                    <td><?php echo $tc_kimlik; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

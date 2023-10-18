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

if (!isset($_SESSION["student_logged_in"]) || $_SESSION["student_logged_in"] !== true) {
    header("Location: student_login.php");
    exit;
}

$student_username = $_SESSION["student_username"];

// Öğrenci bilgilerini veritabanından sorgula
$sql = "SELECT * FROM students WHERE student_username = '$student_username'";
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

// Öğrencinin ödevlerini veritabanından çek
$sql = "SELECT * FROM assignments WHERE student_id = (SELECT id FROM students WHERE student_username = '$student_username')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Paneli</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Bilgileri</h2>
        <table>
            <tbody>
                <tr>
                    <td><strong>Öğrenci Kullanıcı Adı:</strong></td>
                    <td><?php echo isset($student_username) ? $student_username : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>İsim:</strong></td>
                    <td><?php echo isset($isim) ? $isim : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Soyisim:</strong></td>
                    <td><?php echo isset($soyisim) ? $soyisim : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Öğrenci Numarası:</strong></td>
                    <td><?php echo isset($numara) ? $numara : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Sınıf:</strong></td>
                    <td><?php echo isset($sinif) ? $sinif : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>TC Kimlik:</strong></td>
                    <td><?php echo isset($tc_kimlik) ? $tc_kimlik : 'Bilinmiyor'; ?></td>
                </tr>
            </tbody>
        </table>

        <h2>Ödevler</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Öğretmen</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Son Teslim Tarihi</th>
                    <th>Durumu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["teacher_id"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["deadline"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Henüz ödev bulunmamaktadır.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="student_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>

<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: admin_login.php");
    exit;
}

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

// Öğrenci verilerini sorgula
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Listesi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Öğrenci Listesi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İsim</th>
                    <th>Soyisim</th>
                    <th>Numara</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["isim"] . "</td>";
                        echo "<td>" . $row["soyisim"] . "</td>";
                        echo "<td>" . $row["numara"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Kayıtlı öğrenci yok.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="admin_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>

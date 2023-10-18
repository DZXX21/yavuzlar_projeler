

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
$sql = "SELECT A.id, A.title, A.deadline, A.status, A.teacher_name
        FROM assignments A
        JOIN students S ON A.student_id = S.id
        WHERE S.student_username = '$student_username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrenci Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #0074d9;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            font-size: 24px;
        }

        /* Öğrenci bilgi tablosu stilleri */
        #student-info-table {
            table-layout: fixed;
        }

        #student-info-table td {
            width: 50%;
        }

        /* Ödevler tablosu stilleri */
        #assignments-table {
            table-layout: fixed;
        }

        #assignments-table th, #assignments-table td {
            max-width: 200px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Öğrenci Bilgileri</h2>
        <table id="student-info-table">
            <tbody>
                <tr>
                    <td><strong>Öğrenci Kullanıcı Adı:</strong></td>
                    <td><?php echo isset($student_username) ? $student_username : 'Bilinmiyor'; ?></td>
                </tr>
                <!-- Diğer bilgiler buraya eklenebilir -->
            </tbody>
        </table>

        <h2>Ödevler</h2>
        <table id="assignments-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Öğretmen</th>
                    <th>Başlık</th>
                    <th>Son Teslim Tarihi</th>
                    <th>Durumu</th>
                    <th>Detaylar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["teacher_name"] . "</td>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["deadline"] . "</td>";
                        echo "<td>" . $row["status"] . "</td>";
                        echo "<td><a href='assignment_details.php?assignment_id=" . $row["id"] . "'>Detayları Gör</a></td>";
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

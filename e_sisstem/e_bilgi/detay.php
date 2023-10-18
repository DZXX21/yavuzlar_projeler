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

if (isset($_GET["assignment_id"])) {
    $assignment_id = $_GET["assignment_id"];

    // Ödev detaylarını veritabanından çek
    $sql = "SELECT A.title, A.teacher_name, A.description, A.deadline, A.status
            FROM assignments A
            WHERE A.id = $assignment_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $title = $row["title"];
        $teacher_name = $row["teacher_name"];
        $description = $row["description"];
        $deadline = $row["deadline"];
        $status = $row["status"];
    } else {
        echo "Ödev detayları bulunamadı.";
    }
} else {
    echo "Ödev ID'si belirtilmedi.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ödev Detayları</title>
    <style>
        /* CSS stilleri burada bulunuyor */
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
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ödev Detayları</h2>
        <table>
            <tbody>
                <tr>
                    <td><strong>Başlık:</strong></td>
                    <td><?php echo isset($title) ? $title : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Öğretmen:</strong></td>
                    <td><?php echo isset($teacher_name) ? $teacher_name : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Açıklama:</strong></td>
                    <td><?php echo isset($description) ? $description : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Son Teslim Tarihi:</strong></td>
                    <td><?php echo isset($deadline) ? $deadline : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Durumu:</strong></td>
                    <td><?php echo isset($status) ? $status : 'Bilinmiyor'; ?></td>
                </tr>
            </tbody>
        </table>

        <a href="student_dashboard.php">Geri Dön</a>
    </div>
</body>
</

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

// Ödevin ID'sini al
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

// Dosya yükleme işlemi
if (isset($_FILES["file"])) {
    $file_name = $_FILES["file"]["name"];
    $file_tmp = $_FILES["file"]["tmp_name"];
    $file_error = $_FILES["file"]["error"];

    if ($file_error === 0) {
        $upload_path = "uploads/" . $file_name;

        if (move_uploaded_file($file_tmp, $upload_path)) {
            $student_username = $_SESSION["student_username"];

            // Yükleme bilgilerini veritabanına kaydet
            $sql = "INSERT INTO submissions (student_username, assignment_id, file_name) VALUES ('$student_username', $assignment_id, '$file_name')";
            if ($conn->query($sql) === TRUE) {
                echo "Dosya başarıyla yüklendi ve veritabanına kaydedildi.";
            } else {
                echo "Veritabanına kayıt yapılırken bir hata oluştu: " . $conn->error;
            }
        } else {
            echo "Dosya yüklenirken bir hata oluştu.";
        }
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $onay_durumu = $_POST["onay_durumu"];
    
        // Veritabanına onay durumunu kaydetme işlemi
        $updateSql = "UPDATE assignments SET onay_durumu = '$onay_durumu' WHERE id = $assignment_id";
    
        if ($conn->query($updateSql) === TRUE) {
            echo "Ödev durumu güncellendi.";
        } else {
            echo "Hata: " . $conn->error;
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $assignment_id = $_POST["assignment_id"];
        $onay_durumu = $_POST["onay_durumu"];
    
        // Veritabanına onay durumunu kaydetme işlemi
        $updateSql = "UPDATE assignments SET onay_durumu = '$onay_durumu' WHERE id = $assignment_id";
    
        if ($conn->query($updateSql) === TRUE) {
            echo "Ödev onay durumu başarıyla güncellendi.";
        } else {
            echo "Hata: " . $updateSql . "<br>" . $conn->error;
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Ödev Detayları</title>
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
    <td><strong>Onay Durumu:</strong></td>
    <td><?php echo isset($onay_durumu) ? $onay_durumu : 'Beklemede'; ?></td>
</tr>


                <tr>
            </tbody>
        </table>

        <h2>Dosya Yükle</h2>
        <form action="assignment_details.php?assignment_id=<?php echo $assignment_id; ?>" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" value="Yükle">
        </form>

        <a href="student_dashboard.php">Geri Dön</a>
    </div>
</body>
</html>

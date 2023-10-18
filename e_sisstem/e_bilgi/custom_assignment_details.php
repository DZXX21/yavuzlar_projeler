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

    // Öğrencinin ödev yükleme tarihini, dosya adını ve adını al
    $student_username = $_SESSION["student_username"];
    $submission_query = "SELECT file_name, submission_date FROM submissions WHERE assignment_id = $assignment_id AND student_username = '$student_username'";
    $submission_result = $conn->query($submission_query);

    if ($submission_result->num_rows == 1) {
        $submission_row = $submission_result->fetch_assoc();
        $file_name = $submission_row["file_name"];
        $submission_date = $submission_row["submission_date"];
    }
}

// Öğrencinin adını ve soyadını veritabanından çek
$student_username = $_SESSION["student_username"];
$student_info_query = "SELECT isim, soyisim FROM students WHERE student_username = '$student_username'";
$student_info_result = $conn->query($student_info_query);

if ($student_info_result->num_rows == 1) {
    $student_info_row = $student_info_result->fetch_assoc();
    $student_name = $student_info_row["isim"];
    $student_surname = $student_info_row["soyisim"];
} else {
    $student_name = "Bilinmiyor";
    $student_surname = "Bilinmiyor";
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
    <td><strong>Onay Durumu:</strong></td>
    <td><?php echo isset($onay_durumu) ? $onay_durumu : 'Beklemede'; ?></td>
</tr>

                <tr>
                    <td><strong>Yükleme Tarihi:</strong></td>
                    <td><?php echo isset($submission_date) ? $submission_date : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Öğrenci İsmi:</strong></td>
                    <td><?php echo isset($student_name) ? $student_name : 'Bilinmiyor'; ?></td>
                </tr>
                <tr>
                    <td><strong>Öğrenci Soyismi:</strong></td>
                    <td><?php echo isset($student_surname) ? $student_surname : 'Bilinmiyor'; ?></td>
                </tr>
            </tbody>
        </table>

        <h2>Ödev Onaylama / Reddetme</h2>
<form action="" method="post">
    <label for="onay_durumu">Onay Durumu:</label>
    <select name="onay_durumu" id="onay_durumu">
        <option value="Onaylandı">Onaylandı</option>
        <option value="Reddedildi">Reddedildi</option>
        <option value="Beklemede">Beklemede</option>
    </select>
    <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>">
    <input type="submit" value="Kaydet">
</form>


        <a href="student_assignments.php">Geri Dön</a>
    </div>
</body>
</html>

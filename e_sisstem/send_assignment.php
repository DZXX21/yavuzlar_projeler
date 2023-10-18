<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "e_sistem";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

if (!isset($_SESSION["teacher_logged_in"]) || $_SESSION["teacher_logged_in"] !== true) {
    header("Location: teacher_login.php");
    exit;
}

$teacher_username = $_SESSION["teacher_username"];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["teacher_class"])) {
    $teacher_class = $_POST["teacher_class"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["assignment"])) {
    $student_id = $_POST["student_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $deadline = $_POST["deadline"];

    // Öğrenciye ödevi veritabanına ekle
    $sql = "INSERT INTO assignments (teacher_id, student_id, title, description, deadline, status) VALUES ('$teacher_username', '$student_id', '$title', '$description', '$deadline', 'Not Submitted')";

    if ($conn->query($sql) === true) {
        echo "Ödev başarıyla gönderildi.";
    } else {
        echo "Ödev gönderme sırasında bir hata oluştu: " . $conn->error;
    }
}

$sql = "SELECT DISTINCT sinif FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğretmen Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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

        form {
            margin: 0;
            padding: 0;
        }

        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ödev Gönderme</h2>
        <form method="post" action="teacher.php">
            <label for="teacher_class">Sınıf Seçin:</label>
            <select name="teacher_class">
                <?php
                while ($row = $result->fetch_assoc()) {
                    $sinif = $row["sinif"];
                    echo "<option value='$sinif'>$sinif</option>";
                }
                ?>
            </select>
            <input type="text" name="title" placeholder="Ödev Başlığı" required>
            <textarea name="description" placeholder="Ödev Açıklaması" required></textarea>
            <input type="date" name="deadline" required>
            <input type="submit" name="assignment" value="Gönder">
        </form>
        <a href="teacher_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>

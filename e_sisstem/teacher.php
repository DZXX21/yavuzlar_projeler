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

if (!isset($_SESSION["teacher_logged_in"]) || $_SESSION["teacher_logged_in"] !== true) {
    header("Location: teacher_login.php");
    exit;
}

$teacher_username = $_SESSION["teacher_username"];
$teacher_class = "7/a"; // Varsayılan sınıf

// Kullanıcının seçtiği sınıfı al
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["teacher_class"])) {
    $teacher_class = $_POST["teacher_class"];
}

// Ödev gönderme işlemi
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

// Sınıf listesini sorgula
$sql = "SELECT DISTINCT sinif FROM students";
$class_result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğretmen Sayfası</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            max-width: 1000px; /* Sayfa genişliği artırıldı */
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
    </style>
</head>
<body>
    <div class="container">
        <!-- Sınıf Seçim Formu -->
        <form method="post">
            <label for="teacher_class">Sınıf Seçin:</label>
            <select name="teacher_class" onchange="this.form.submit()">
                <?php
                while ($class_row = $class_result->fetch_assoc()) {
                    $sinif = $class_row["sinif"];
                    echo "<option value='$sinif' " . ($teacher_class == $sinif ? 'selected' : '') . ">$sinif</option>";
                }
                ?>
            </select>
        </form>

        <!-- Öğrenci Listesi -->
        <h2>Öğrenci Listesi (Sınıf: <?php echo $teacher_class; ?>)</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>İsim</th>
                    <th>Soyisim</th>
                    <th>Numara</th>
                    <th>TC Kimlik</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sınıf seçildikten sonra öğrenci listesini sorgula
                $sql = "SELECT * FROM students WHERE sinif = '$teacher_class'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["isim"] . "</td>";
                        echo "<td>" . $row["soyisim"] . "</td>";
                        echo "<td>" . $row["numara"] . "</td>";
                        echo "<td>" . $row["tc_kimlik"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Sınıfta kayıtlı öğrenci bulunmamaktadır.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Öğrencilere Ödev Gönderme Formu -->
        <h2>Ödev Gönderme</h2>
        <form method='post'>
            <input type='text' name='student_id' placeholder='Öğrenci ID' required>
            <input type='text' name='title' placeholder='Ödev Başlığı' required>
            <textarea name='description' placeholder='Ödev Açıklaması' required></textarea>
            <input type='date' name='deadline' required>
            <input type='submit' name='assignment' value='Gönder'>
        </form>

        <a href="teacher_logout.php">Çıkış Yap</a>
    </div>
</body>
</html>

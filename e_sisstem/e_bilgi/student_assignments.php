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

// Öğrencinin yüklediği ödevleri veritabanından çek
$sql = "SELECT A.id AS assignment_id, A.title, A.description, A.deadline, S.file_name
        FROM assignments A
        LEFT JOIN submissions S ON A.id = S.assignment_id
        WHERE A.student_id = (SELECT id FROM students WHERE student_username = '$student_username')";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Öğrencinin Gönderdiği Ödevler</title>
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
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 13ch;
        }

        th {
            background-color: #f2f2f2;
        }

        .download-button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            border-radius: 4px;
        }

        .download-button:hover {
            background-color: #005b84;
        }

        .detail-link {
            color: #008CBA;
            text-decoration: underline;
            cursor: pointer;
        }

        .detail-link:hover {
            color: #005b84;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Öğrencinin Gönderdiği Ödevler</h2>
        <table>
            <thead>
                <tr>
                    <th>Ödev ID</th>
                    <th>Başlık</th>
                    <th>Açıklama</th>
                    <th>Son Teslim Tarihi</th>
                    <th>Dosya Adı</th>
                    <th>İndir</th>
                    <th>Detay</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["assignment_id"] . "</td>";
                        echo "<td>" . (strlen($row["title"]) > 13 ? substr($row["title"], 0, 13) . "..." : $row["title"]) . "</td>";
                        echo "<td>" . (strlen($row["description"]) > 13 ? substr($row["description"], 0, 13) . "..." : $row["description"]) . "</td>";
                        echo "<td>" . $row["deadline"] . "</td>";
                        echo "<td>" . ($row["file_name"] ? (strlen($row["file_name"]) > 13 ? substr($row["file_name"], 0, 13) . "..." : $row["file_name"]) : "Yüklenmedi") . "</td>";
                        if ($row["file_name"]) {
                            echo "<td><a class='download-button' href='uploads/" . $row["file_name"] . "' download>İndir</a></td>";
                        } else {
                            echo "<td></td>";
                        }
                        echo "<td><span class='detail-link' onclick='showAssignmentDetail(" . $row["assignment_id"] . ")'>Detay</span></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Henüz öğrenci tarafından gönderilmiş ödev bulunmamaktadır.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="student_dashboard.php">Geri Dön</a>
    </div>

    <script>
    function showAssignmentDetail(assignmentId) {
        // Öğrencinin ödevin detaylarını görüntülemesi için yeni bir sayfaya yönlendirebilirsiniz.
        // Aşağıdaki örnek, assignment_detail.php adında bir sayfaya yönlendirme yapar.
        window.location.href = "custom_assignment_details.php?assignment_id=" + assignmentId;
    }
</script>

</body>
</html>

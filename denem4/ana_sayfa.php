<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: login.html");
    exit();
}

if (isset($_POST['new-task'])) {
    $taskText = $_POST['new-task'];
    $userId = $_SESSION["kullanici_id"];

    $insertQuery = "INSERT INTO tasks (user_id, task_text, completed) VALUES ($userId, '$taskText', 0)";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Görev başarıyla eklendi.";
    } else {
        echo "Görev eklenirken bir hata oluştu: " . mysqli_error($conn);
    }
}

if (isset($_POST['delete-task'])) {
    $taskId = $_POST['delete-task'];
    $userId = $_SESSION["kullanici_id"];

    $deleteQuery = "DELETE FROM tasks WHERE id = $taskId AND user_id = $userId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Görev başarıyla silindi.";
    } else {
        echo "Görev silinirken bir hata oluştu: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM tasks WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);

$tasks = array();
while ($row = mysqli_fetch_assoc($result)) {
    $tasks[] = $row;
}

echo json_encode($tasks);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="header">
        <h1>Görev Listesi</h1>
        <a href="logout.php">Çıkış Yap</a>
    </div>
    
    <div id="container">
        <form id="task-form">
            <input type="text" id="new-task" placeholder="Görev ekleyin...">
            <button type="submit">Ekle</button>
        </form>
        <div id="search-bar">
            <input type="text" id="search-input" placeholder="Görev arayın...">
            <button id="clear-search-button">Arama Temizle</button>
        </div>
        <ul id="task-list">
          
        </ul>
    </div>

    <script src="script.js"></script>
    
</body>
</html>

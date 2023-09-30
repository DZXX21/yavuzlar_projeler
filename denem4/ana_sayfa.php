<?php
session_start();

// Oturumu kontrol et
if (!isset($_SESSION["kullanici_adi"])) {
 
    header("Location: login.php");
    exit();
}

// Veritabanı bağlantısı ve diğer konfigürasyon ayarları
$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}

// Görev eklemek için POST isteğini işle
if (isset($_POST['new-task'])) {
    $taskText = $_POST['new-task'];

    $insertQuery = "INSERT INTO tasks (task_text, completed) VALUES ('$taskText', 0)";
    if (mysqli_query($conn, $insertQuery)) {
        echo "Görev başarıyla eklendi.";
    } else {
        echo "Görev eklenirken bir hata oluştu: " . mysqli_error($conn);
    }
}

// Görevi silmek için POST isteğini işle
if (isset($_POST['delete-task'])) {
    $taskId = $_POST['delete-task'];

    $deleteQuery = "DELETE FROM tasks WHERE id = $taskId";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "Görev başarıyla silindi.";
    } else {
        echo "Görev silinirken bir hata oluştu: " . mysqli_error($conn);
    }
}
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
        <p>Hoş geldiniz, <?php echo $_SESSION["kullanici_adi"]; ?></p> <!-- Kullanıcı adını görüntülemek için bu satırı ekledik -->
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

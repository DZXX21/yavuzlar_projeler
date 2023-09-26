<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

// MySQL veritabanına bağlan
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// GET isteği: Tüm görevleri sorgula
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM tasks";
    $result = $conn->query($sql);
    $tasks = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }
    echo json_encode($tasks);
}

// POST isteği: Yeni görev ekle
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $taskName = $data["task_name"];
    $sql = "INSERT INTO tasks (task_name) VALUES ('$taskName')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev eklendi"]);
    } else {
        echo json_encode(["error" => "Görev eklenirken hata oluştu"]);
    }
}

// PUT isteği: Görev durumunu güncelle
if ($_SERVER["REQUEST_METHOD"] === "PUT" && isset($_GET["id"])) {
    $taskId = $_GET["id"];
    $sql = "UPDATE tasks SET task_status = NOT task_status WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev durumu güncellendi"]);
    } else {
        echo json_encode(["error" => "Görev durumu güncellenirken hata oluştu"]);
    }
}

// PUT isteği: Görevi güncelle
if ($_SERVER["REQUEST_METHOD"] === "PUT" && isset($_GET["task_name"])) {
    $taskName = $_GET["task_name"];
    $newTaskName = json_decode(file_get_contents("php://input"))->new_task_name;
    $sql = "UPDATE tasks SET task_name = '$newTaskName' WHERE task_name = '$taskName'";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev güncellendi"]);
    } else {
        echo json_encode(["error" => "Görev güncellenirken hata oluştu"]);
    }
}

// DELETE isteği: Görevi sil
if ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET["id"])) {
    $taskId = $_GET["id"];
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev silindi"]);
    } else {
        echo json_encode(["error" => "Görev silinirken hata oluştu"]);
    }
}

// Veritabanı bağlantısını kapat
$conn->close();
?>

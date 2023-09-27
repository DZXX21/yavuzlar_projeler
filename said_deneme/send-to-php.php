<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "todolist";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

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
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $taskName = $data["task_name"];
    $sql = "INSERT INTO tasks (task_name) VALUES ('$taskName')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev eklendi"]);
    } else {
        echo json_encode(["error" => "Görev eklenirken hata oluştu"]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "PUT" && isset($_GET["id"])) {
    // This block is for updating task status
    $taskId = $_GET["id"];
    // Toggle the is_completed field between 1 and 0 using a conditional update
    $sql = "UPDATE tasks SET is_completed = CASE WHEN is_completed = 1 THEN 0 ELSE 1 END WHERE id = $taskId";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev durumu güncellendi"]);
    } else {
        echo json_encode(["error" => "Görev durumu güncellenirken hata oluştu"]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "DELETE" && isset($_GET["id"])) {
    $taskId = $_GET["id"];
    $sql = "DELETE FROM tasks WHERE id = $taskId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Görev silindi"]);
    } else {
        echo json_encode(["error" => "Görev silinirken hata oluştu"]);
    }
}

$conn->close();
?>

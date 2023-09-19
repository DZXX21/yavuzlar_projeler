<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // AJAX isteğinden gelen kullaniciID'yi alın
    $kullaniciID = $_POST["kullaniciID"];

    // Kullanıcı ID'sini kullanarak istediğiniz işlemi yapabilirsiniz, örneğin veritabanında güncelleme yapabilirsiniz.
    // Örnek:
    
    // Veritabanına bağlanma
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ecrt";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Örnek bir güncelleme sorgusu
    $sql = "UPDATE kullanici SET secili = 1 WHERE id = $kullaniciID";

    if ($conn->query($sql) === TRUE) {
        echo "Kullanıcı başarıyla seçildi.";
    } else {
        echo "Hata: " . $conn->error;
    }

    $conn->close();
}
?>

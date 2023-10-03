<!DOCTYPE html>
<html>
<head>
    <title>Ödevler</title>
    <style>
        /* Genel stil ayarları (önceki kod ile aynı) */
        /* ... */
    </style>
</head>
<body>
    <div class="container">
        <h2>Ödevler</h2>
        <?php
        // Veritabanı bağlantısı ve diğer kodları buraya ekleyin
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Öğrenci ID</th>
                <th>Ödev Adı</th>
                <th>Tamamlandı</th>
            </tr>
            <?php
            // Verileri döngüyle çekerek tabloya ekleyin
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["ogrenci_id"] . "</td>";
                    echo "<td>" . $row["odev_adi"] . "</td>";
                    echo "<td>" . ($row["odev_tamamlandi"] ? "Evet" : "Hayır") . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Öğrenci ödevi bulunmuyor.</td></tr>";
            }
            ?>
        </table>

        <!-- Öğrenci Ödevi Sorgulama Formu -->
        <div class="form-container">
            <h3>Öğrenci Ödevi Sorgula</h3>
            <form action="odevler.php" method="POST">
                <label for="ogrenci_id">Öğrenci ID:</label>
                <input type="number" name="ogrenci_id" required><br>

                <input type="submit" name="sorgula" value="Sorgula">
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Veritabanı bağlantısı (önceki kod ile aynı)
// ...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Öğrenci ödevini sorgulama işlemi
    if (isset($_POST["sorgula"])) {
        $ogrenciID = $_POST["ogrenci_id"];

        // Öğrencinin ödevlerini sorgula
        $sql = "SELECT id, odev_adi, odev_tamamlandi FROM ogrenci_odevleri WHERE ogrenci_id = $ogrenciID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Öğrenci ödevleri varsa, tabloyu göster
            // ...
        } else {
            echo "<p>Öğrenciye ait ödev bulunmuyor.</p>";
        }
    }

    // Öğrenci ödevi ekleme işlemi
    if (isset($_POST["ekle"])) {
        $ogrenciID = $_POST["ogrenci_id"];
        $odevAdi = $_POST["odev_adi"];
        $odevTamamlandi = isset($_POST["odev_tamamlandi"]) ? 1 : 0;

        // Öğrenciye ödevi ekle
        $sql = "INSERT INTO ogrenci_odevleri (ogrenci_id, odev_adi, odev_tamamlandi) VALUES ($ogrenciID, '$odevAdi', $odevTamamlandi)";
        if ($conn->query($sql) === TRUE) {
            echo "Ödev başarıyla eklendi.";
        } else {
            echo "Ödev eklenirken hata oluştu: " . $conn->error;
        }
    }
}

// Diğer kodları buraya ekleyin
?>


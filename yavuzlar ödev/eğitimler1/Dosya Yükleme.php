<!DOCTYPE html>
<html>
<head>
    <title>Dosya Yükleme</title>
</head>
<body>
    <form method="POST" action="" enctype="multipart/form-data">
        Dosya Seçin: <input type="file" name="dosya"><br>
        <input type="submit" value="Yükle">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $dosya_adi = $_FILES["dosya"]["name"];
        $gecici_dosya = $_FILES["dosya"]["tmp_name"];
        move_uploaded_file($gecici_dosya, "uploads/" . $dosya_adi);
        echo "Dosya yüklendi: $dosya_adi";
    }
    ?>
</body>
</html>

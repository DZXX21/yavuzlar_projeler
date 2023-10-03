<!DOCTYPE html>
<html>
<head>
    <title>Yönetici Paneli</title>
    <style>
        /* Genel stil ayarları */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        /* Tablo stillemesi */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007BFF;
            color: #fff;
        }

        /* Ekleme ve Silme Formları */
        .form-container {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Hata mesajları */
        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kayıtlı Kişiler</h2>
        <?php
        // Veritabanı bağlantısı ve diğer kodları buraya ekleyin
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>İsim</th>
                <th>Soyisim</th>
                <th>Rol</th>
                <th>İşlemler</th>
            </tr>
            <?php
            // Verileri döngüyle çekerek tabloya ekleyin
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["isim"] . "</td>";
                    echo "<td>" . $row["soyisim"] . "</td>";
                    echo "<td>" . $row["rol"] . "</td>";
                    echo "<td><a href='admin_yonetim.php?sil=" . $row["id"] . "'>Sil</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Kayıtlı kişi bulunmuyor.</td></tr>";
            }
            ?>
        </table>

        <!-- Ekleme Formu -->
        <div class="form-container">
            <h3>Kişi Ekle</h3>
            <form action="admin_yonetim.php" method="POST">
                <label for="isim">İsim:</label>
                <input type="text" name="isim" required><br>

                <label for="soyisim">Soyisim:</label>
                <input type="text" name="soyisim" required><br>

                <label for="rol">Rol:</label>
                <input type="text" name="rol" required><br>

                <input type="submit" name="ekle" value="Ekle">
            </form>
        </div>

        <!-- Silme Formu -->
        <div class="form-container">
            <h3>Kişi Sil</h3>
            <form action="admin_yonetim.php" method="POST">
                <label for="kisi_id">Kişi ID:</label>
                <input type="number" name="kisi_id" required><br>

                <input type="submit" name="sil" value="Sil">
            </form>
        </div>
    </div>
</body>
</html>

<?php
session_start();

include("baglanti.php");

if(isset($_POST['todo_ekle'])){
    $icerik = $_POST['todo_icerik'];
    $kullanici_adi = $_SESSION['kullanici_adi'];
    
    $query = $db->prepare("INSERT INTO notlar (kullanici_adi, icerik) VALUES (:kullanici, :icerik)");
    $query->execute([
        'kullanici' => $kullanici_adi,
        'icerik' => $icerik,
    ]);
    
    echo "Görev başarıyla eklendi.";
}

if(isset($_GET['sil_id'])){
    $sil_id = $_GET['sil_id'];
    $kullanici_adi = $_SESSION['kullanici_adi'];
    
    $sil = "DELETE FROM notlar WHERE id = $sil_id AND kullanici_adi = '$kullanici_adi'";
    $calistirsil = mysqli_query($baglanti, $sil);
    
    if ($calistirsil) {
        echo "Görev başarıyla silindi.";
    } else {
        echo "Görev silinirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}

if(isset($_POST['duzenle_icerik'])){
    $duzenle_id = $_POST['duzenle_id'];
    $duzenle_icerik = $_POST['duzenle_icerik'];
    $kullanici_adi = $_SESSION['kullanici_adi'];
    
    $duzenle = "UPDATE notlar SET icerik = '$duzenle_icerik' WHERE id = $duzenle_id AND kullanici_adi = '$kullanici_adi'";
    $calistirduzenle = mysqli_query($baglanti, $duzenle);
    
    if ($calistirduzenle) {
        echo "Görev başarıyla düzenlendi.";
    } else {
        echo "Görev düzenlenirken bir hata oluştu: " . mysqli_error($baglanti);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Todo Listesi</title>

   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<h1 class="text-center">Hoş Geldin: <?php echo $_SESSION['kullanici_adi']?></h1>
   <div class="container">
   
      <form method="post" class="todo_form">
         <h1 class="todo_title">Todo Listesi</h1>
         <div class="todo_div">
            <input type="text" class="form-control mb-2" placeholder="Görev ekle..." name="todo_icerik">
            <button type="submit" name="todo_ekle" class="btn btn-primary">Ekle</button>
            <a href="login.php" class="btn btn-light">Çıkış Yap</a> <!-- Çıkış bağlantısı -->
         </div>
      </form>
      <input type="text" class="form-control mt-3" placeholder="Görevleri filtrele..." onkeyup="filterTodos()">
      <div class="todo_container">
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">İçerik</th>
                    <th scope="col">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $kullanici_adi = $_SESSION['kullanici_adi'];
                $todos = $db->query("SELECT * FROM notlar WHERE kullanici_adi='$kullanici_adi' ")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($todos as $todo) {
                    echo "<tr>";
                    echo "<td>" . $todo["icerik"] . "</td>";
                    echo "<td><button onclick='editTodo(" . $todo["id"] . ")' class='btn btn-info'>Düzenle</button></td>";
                    echo "<td><a href='?sil_id=" . $todo["id"] . "' class='btn btn-danger'>Sil</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
      </div>
   </div>

<!-- Bootstrap JS ve jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function filterTodos() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.querySelector(".form-control.mt-3");
  filter = input.value.toUpperCase();
  table = document.querySelector("table");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function editTodo(id) {
  var content = prompt("Yeni içeriği girin:");
  if (content !== null) {
    var formData = new FormData();
    formData.append("duzenle_id", id);
    formData.append("duzenle_icerik", content);

    fetch(window.location.href, {
      method: "POST",
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      alert(data);
      window.location.reload();
    })
    .catch(error => {
      console.error("Düzenleme hatası:", error);
    });
  }
}
</script>
</body>
</html>

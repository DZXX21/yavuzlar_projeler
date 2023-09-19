<?php


$db_usernmae = "icardi";
$db_password = "12345";


/*if($sonuc = $db_usernmae =="icardi" and  $db_password == "1234"){
    //true bloğu calışır

    echo "aşkın olayım hoşgeldin ";


}else{
    //false bloğu çalsıır


    echo "icardi nerede   username ve sifre  yanlış";
}



*/

/*
if($db_usernmae=="icardi"){
    if($db_password==1234){
        echo "giris başarılı";
    }else{
        echo "kullnacı adı hatalı";
    }

}else{
    echo "username yanlış";
}

*/

if($db_usernmae != "icardi"){
    echo "username yanlış";
}elseif($db_password!="12345") {
    echo "parola yanlış";
}else {
    echo "giris yapıldı";
}
    





?>

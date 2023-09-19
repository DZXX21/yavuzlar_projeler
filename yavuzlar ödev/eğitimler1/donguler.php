<?php



  
/*for($i = 1; $i < 100 ; $i+=4){
    echo $i."<br>";
}

?>*/


//$isimler = ["ali","efe","meye"];

//for(i=0  )ü




$urunler = [
    ["iphone 14",10000],
    ["iphone 15",10000],
    ["iphone 16",10000],
];

for ($i=0;$i <count($urunler);$i++){
    echo $urunler[$i][0]." ".$urunler[$i][1]."<br>";
}
?>
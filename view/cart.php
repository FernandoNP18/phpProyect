<?php
// session_start();
// unset($_SESSION["cart"]);
session_start();
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"]=[""];
}
// $file=fopen("../CART/cart".$_GET['us'].".txt",'w+');
// $content=filesize("../CART/cart".$_GET['us'].".txt")>0?explode("<br>",fread($file,filesize("../CART/cart".$_GET['us'].".txt"))):array();
// print_r($content);
// echo "<br>";
// fclose($file);

function addToCart($id){
    // unlink("../CART/cart".$_GET['us'].".txt");
    // $f=fopen("../CART/cart".$_GET['us'].".txt",'w+');
    // print_r($content);
    // array_push($content,"$id<br>");
    // print_r($content);
    // fwrite($f,implode("<br>",$content));
    // fclose($f);
array_push($_SESSION["cart"],$id);
}
function deleteFromCart($id){
    // unlink("../CART/cart".$_GET['us'].".txt");
    // $f=fopen("../CART/cart".$_GET['us'].".txt",'w+');
    // if (($key = array_search($id, $c)) !== false) {
    //     unset($c[$key]);
    // }
    // fwrite($f,implode("<br>",$c));
    // fclose($f);
    $isFount=false;
    $dumb=$_SESSION["cart"];
    $_SESSION["cart"]=array();
    foreach($dumb as $i){
        if($i!=$id && !$isFount){
            array_push($_SESSION["cart"],$i);
        }else{
            $isFount=true;
        }
    }
}
if(isset($_GET["i"])){
    addToCart($_GET["i"]);
}
if(isset($_GET["d"])){
    deleteFromCart($_GET["d"]);
}
print_r($_SESSION["cart"]);
//header("location: searchDisk.php");
?>
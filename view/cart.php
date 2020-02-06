<?php
// session_start();
// unset($_SESSION["cart".$_GET["us"]]);
session_start();
if(!isset($_SESSION["cart".$_GET["us"]])){
    $_SESSION["cart".$_GET["us"]]=array();
}
function addToCart($id){
array_push($_SESSION["cart".$_GET["us"]],$id);
}
function deleteFromCart($id){
    $isFound=false;
    $dumb=$_SESSION["cart".$_GET["us"]];
    $_SESSION["cart".$_GET["us"]]=array();
    foreach($dumb as $i){
        if($i==$id && !$isFound){
            $isFound=true;
        }else{
            array_push($_SESSION["cart".$_GET["us"]],$i);
        }
    }
}
if(isset($_GET["i"])){
    addToCart($_GET["i"]);
}
if(isset($_GET["d"])){
    deleteFromCart($_GET["d"]);
}
if(isset($_GET["save"])){
    if(!empty($_SESSION["cart".$_GET["us"]])){
        $file=fopen("../CART/".$_GET["us"].".txt","w+");
        fwrite($file,implode("<br>",$_SESSION["cart".$_GET["us"]]));
        require_once("../controller/diskController.php");
        require_once("../model/Disk.php");
        $diskController=new DiskController();
        $diskController->update(new Disk(),$_SESSION["cart".$_GET["us"]]);
        sleep(10);
        $_SESSION["errores"]="COMPRA REALIZADA";
        $_SESSION["cart".$_GET["us"]]=array();
    }

}
//header("location: searchDisk.php?us=".$_GET["us"]);
?>
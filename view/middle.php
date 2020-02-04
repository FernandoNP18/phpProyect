<?php
require_once("../controller/DiskController.php");
require_once("../model/Disk.php");
$diskController= new DiskController();
$disk=new Disk($_POST["name"],$_POST["image"],$_POST["genre"],$_POST["author"],$_POST["prize"],$_POST["songs"],$_POST["stock"]);
if(!empty($disk)&&$disk!=null){
    session_start();
    $_SESSION["errores"]="Datos introducidos con éxito";
    $diskController->insert($disk);
    header("location: createDisk.php");
}
?>
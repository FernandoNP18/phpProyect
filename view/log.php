<?php
require_once("../controller/userController.php");
require_once("../model/User.php");
$route="location: searchDisk.php?us=".$_POST['username'];
$user= new User();
$userController= new userController();
if(!$userController->select($user,$_POST["username"],$_POST["password"])){
    $route="location: login.php";
    session_start();
    $_SESSION["errores"]="No existe en nuestra base de datos, registrese";
}
header($route);
?>
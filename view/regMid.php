<?php
require_once("../controller/UserController.php");
require_once("../model/User.php");
$userController= new UserController();
$user=new User($_POST["dni"],$_POST["name"],$_POST["username"],$_POST["surname"],$_POST["password"],$_POST["email"]);
if(!empty($user)&&$user!=null){
    session_start();
    $_SESSION["errores"]="Datos introducidos con éxito";
    $userController->insert($user);
    header("location: register.php");
}
?>
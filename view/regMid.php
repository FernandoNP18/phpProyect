<?php
require_once("../controller/UserController.php");
require_once("../model/User.php");
$userController= new UserController();
$user=new User($_POST["dni"],$_POST["name"],$_POST["username"],$_POST["surname"],$_POST["password"],$_POST["email"]);
echo $userController->getName($user);
if(!empty($userController->getName($user))){
     session_start();
     $_SESSION["errores"]="Datos introducidos con éxito";
     echo "Insertado?";
    $userController->insert($user);
     //header("location: register.php");
}
?>
<?php
function contactDB($server,$bbdd,$username,$passwd){
    try{
        $dsn="mysql:host=$server;dbname=$bbdd";
        //if there is no password, there is no need to write it over
        if($passwd!=""){
            $bd= new pdo($dsn,$username,$passwd);
        }else{
            $bd= new pdo($dsn,$username);
        }
        $bd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $bd->exec("set names utf8mb4");
        return $bd;
    }catch(pdoexception $pdoe){
        session_start();
        $_SESSION["errores"]="NO SE HA PODIDO ACCEDER A LA BASE DE DATOS, PRUEBE MÁS TARDE";
        header("location: error.php");
    }
    echo "Estoy en el conector";
}
?>
<?php
class User{
    private $dni;
    private $name;
    private $username;
    private $surname;
    private $password;
    private $email;
    private $db=$this->contactDB("localhost","USER","root","");

   public function __construct(){}
   public function __construct($dni,$name,$username,$surname,$password,$email){
    //Check if the new user is correct
    if($this->checkDni($dni) && $this->checkEmail(50,$email) && $this->checkUser(30,$username)&& $this->checkUser(40,$password) && $this->checkName(50,$surname) && $this->checkName(30,$name)){
        $this->dni=$dni;
        $this->name=$name;
        $this->username=$username;
        $this->surname=$surname;
        $this->email=$email;
        $this->password=$password;
    }else{
       session_start();
       $_SESSION["errores"]="Error al introducir los datos";
        header("location: register.php");
    }
   }
   //Insert into db the new user
   public function insert(){
    $insert=$this->db->prepare("INSERT INTO USERS (DNI,NAME,SURNAME,USERNAME,PASSWORD,EMAIL) VALUES('$this->dni','$this->name','$this->surname','$this->username','$this->password','$this->email')");
    $insert->execute();
    header("location: searchDisk.php");
   }
    //Check if the user exists
    public function checkUserExists($name,$password){
        return $this->db->query("SELECT NAME, PASSWORD FROM USERS WHERE '$name'=NAME AND '$password'=PASSWORD")==1;
       }
   //Check dni
   private function checkDni($dni){
       return !empty($dni) && strlen($dni)==9 &&
        preg_match("/\d{8}[A-Z-a-z]/",$dni) &&
        strtoupper(substr($dni,-1,1))=="TRWAGMYFPDXBNJZSQVHLCKE"[intval(substr($dni,0))%23] &&
        $this->dniExist($dni);
   }
   //check names and usernames
   private function checkName($len,$name){
       return !empty($name) && strlen($name)<=$len && preg_match("/[a-zA-Z ]+/",$name);
   }
   //verify email
   private function checkEmail($len,$email){
    return !empty($email) && strlen($email)<=$len && filter_var($email, FILTER_VALIDATE_EMAIL);
   }
   //check usernames or passwords
   private function checkUser($len,$us){
       return !empty($us) && strlen($us)<=$len && preg_match("/[a-zA-Z0-9%_$]+/",$us);
    }
   //Check if the dni already exist on the db
   private function dniExist($dni){
    return $this->db->query("SELECT DNI FROM USERS WHERE DNI='$dni'")==0; 
   }
   private function contactDB($server,$bbdd,$username,$passwd){
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
}
}
?>
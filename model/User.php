<?php
@ require_once("../controller/connectorDB.php");
class User{
    private $dni;
    private $name;
    private $username;
    private $surname;
    private $password;
    private $email;
    private $db;
   function __construct($dni,$name,$username,$surname,$password,$email){
    //Check if the new user is correct
    if($this->checkDni($dni) && $this->checkEmail(50,$email) && $this->checkUser(30,$username)&& $this->checkUser(40,$password) && $this->checkName(50,$surname) && $this->checkName(30,$name)){
        $this->dni=$dni;
        $this->name=$name;
        $this->username=$username;
        $this->surname=$surname;
        $this->email=$email;
        $this->password=$password;
        //Conect to the DB
        $this->db=contactDB("localhost","USER","root","");
    }else{
        echo "<script>alert('Error al introducir los datos')</script>";
    }
   }
   //Insert into db the new user
   public function insert(){
    $insert=$this->db->prepare("INSERT INTO USERS VALUES('$this->dni','$this->name','$this->surname','$this->username','$this->password','$this->email')");
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
       return !empty($us) && strlen($us)<=$len && preg_match("/[a-zA-Z0-9%_$+/",$us);
    }
   //Check if the dni already exist on the db
   private function dniExist($dni){
    return $this->db->query("SELECT DNI FROM USERS WHERE DNI='$dni'")==0; 
   }
    //Check if the user exists
   public static function checkUserExists($name,$password){
    return $this->db->query("SELECT NAME, PASSWORD FROM USERS WHERE '$name'=NAME AND '$password'=PASSWORD")==1;
   }
}
?>
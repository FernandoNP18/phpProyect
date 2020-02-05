<?php
require("../controller/controller.php");
class User{
    private $dni;
    private $name;
    private $username;
    private $surname;
    private $password;
    private $email;
    private $db;

    public function __construct(){
        //Get the arguments from the constructor
        $params = func_get_args();
        //Num of arguments
        $num_params = func_num_args();
        $funcion_constructor ='__construct'.$num_params;
        //Call a function with a regex
        if (method_exists($this,$funcion_constructor)) {
            call_user_func_array(array($this,$funcion_constructor),$params);
        }
    }
 //Constructors
   public function __construct0(){
    $this->db=contactDB("localhost","TRABAJO","root","");
   }
   public function __construct6($dni,$name,$username,$surname,$password,$email){
    //Check if the new user is correct
    $this->db=contactDB("localhost","TRABAJO","root","");
    if($this->checkDni($dni) && $this->checkExistUser($username) && $this->checkEmail(50,$email) && $this->checkUser(30,$username)&& $this->checkUser(40,$password) && $this->checkName(50,$surname) && $this->checkName(30,$name)){
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
   }
   private function checkExistUser($name){
       echo $this->db->query("SELECT USERNAME FROM USERS WHERE '$name'=USERNAME")->rowCount()==0?"True":"False";
    return $this->db->query("SELECT USERNAME FROM USERS WHERE '$name'=USERNAME")->rowCount()==0;
   }
    //Check if the user exists
    public function checkUserExists($name,$password){
        return $this->db->query("SELECT USERNAME, PASSWORD FROM USERS WHERE '$name'=USERNAME AND '$password'=PASSWORD")->rowCount()==1;
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
    return $this->db->query("SELECT DNI FROM USERS WHERE DNI='$dni'")->rowCount()==0; 
   }
   public function getName(){
       return $this->name;
   }
}
?>
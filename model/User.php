<?php
class User{
    private $dni;
    private $name;
    private $username;
    private $surname;
    private $password;
    private $email;
    private $db;
   function __construct($dni,$name,$username,$surname,$password,$email){
    
   }
   public function getUser($dni){

   }
   public function insert(){
    $insert=$this->db->prepare('INSERT INTO USERS VALUES(:dni,:name,:surname,:username,:password,:email)');
   }
   private function checkDni($dni){
       return !empty($dni) && strlen($dni)==9 && preg_match("/\d{8}[A-Z-a-z]/",$dni) && strtoupper(substr($dni,-1,1))=="TRWAGMYFPDXBNJZSQVHLCKE"[intval(substr($dni,0))%23];
   }
   private function checkName($len,$name){
       return !empty($name) && strlen($name)<=$len && preg_match("/[a-zA-Z ]+/",$name);
   }
   private function checkEmail($len,$email){
    return !empty($email) && strlen($email)<=$len && filter_var($email, FILTER_VALIDATE_EMAIL);
   }
   private function checkUser($len,$us){
       return !empty($us) && strlen($us)<=$len && preg_match("/[a-zA-Z0-9%_$+/",$us);
   }
   public static function checkUserExists($name,$password){
   
   }
   private function dniExist($dni){
   
    }
}
?>
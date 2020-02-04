<?php
require_once("../controller/connectorDB.php");
class Disk{
    private $image;
    private $name;  
    private $genre;
    private $author;
    private $prize;
    private $songs;
    private $stock;
    private $db=$this->contactDB("localhost","TRABAJO","root","");
    public function __construct(){}
    public function __construct($name,$image,$genre,$author,$prize,$songs,$stock)
    {
        //Verify if the data is correct in the db
        if(is_float($prize) && is_int($stock) && $this->checkName(30,$name)&&$this->checkName(30,$genre)&&$this->checkName(30,$author)&&$this->checkName(100,$songs)&&
                $prize>0 && $prize<=50.00 && $stock>0){
                $this->name="'".strtoupper($name)."'";
                $this->genre="'".strtoupper($genre)."'";
                $this->author="'".strtoupper($author)."'";
                $this->prize=floatval($prize);
                $this->songs="'".strtoupper($songs)."'";
                $this->stock=intval($stock);
                $this->image="'../CSS/IMG/$image'";
            }else{
                session_start();
                $_SESSION["errores"]="Error al introducir los datos";
                header("location: createDisk.php");
            }
    }

    private function checkName($len,$name){
        return !empty($name) && strlen($name)<=$len && preg_match("/[a-zA-Z ]+/",$name);
    }
    //Search for a disk using the params
    public function searchFor($name,$author,$genre,$prize){
        $where="";
        $name=str_replace(" ","",trim(strtoupper($name)));
        $author=str_replace(" ","",trim(strtoupper($author)));
        $genre=str_replace(" ","",trim(strtoupper($genre)));
        if(!empty($name) && $name!="")
        {
            $where.="NAME LIKE '%$name%' ";
        }
        if(!empty($author)&& $author!=""){
            $where.="AUTHOR LIKE '%$author%' ";
        }
        if(!empty($genre) && $genre!=""){
            $where.="GENRE LIKE '%$genre%' ";
        }
        if(!empty($prize) && is_float($prize)){
            $where.="PRIZE= ".floatval($prize);
        }
        if($where!=""){
            $where="WHERE".$where;
        }
        $select=$this->db->prepare("SELECT * FROM DISKS $where");
        $select->execute();
        return $select;
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
    //Insert
    public function insert(){
        $insert=$this->db->prepare("INSERT INTO DISKS VALUES(ID,IMAGE,NAME,GENRE,AUTHOR,PRIZE,SONGS,STOCK) 
                                        VALUES(NULL,$this->image,$this->name,$this->genre,$this->author,$this->prize,$this->songs,$this->stock)");
        $insert->execute();
    }
    //Update stock and delete if there is no more
    public function update($id,$dumb){
        $update=$this->db->prepare("UPDATE DISKS SET STOCK=intval($dumb)-1 WHERE ID='$id'");
        $update->execute();
        $del=$this->db->prepare("DELETE FROM DISK WHERE STOCK=0");
        $del->execute();
    }
}
?>
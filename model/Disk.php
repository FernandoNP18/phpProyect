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
    private $db;
    public function __construct($name,$image,$genre,$author,$prize,$songs,$stock)
    {
        //Verify if the data is correct in the db
        if(is_float($prize) && is_int($stock) && $this->checkName(30,$name)&&$this->checkName(30,$genre)&&$this->checkName(30,$author)&&$this->checkName(100,$songs)&&
                $prize>0 && $prize<=50.00 && $stock>0){
                $this->name="'$name'";
                $this->genre="'$genre'";
                $this->author="'$author'";
                $this->prize=floatval($prize);
                $this->songs="'$songs'";
                $this->stock=intval($stock);
                $this->image="'../CSS/IMG/$image'";
                $this->db=contactDB("localhost","USER","root","");
            }else{
                echo "<script>alert('Error al introducir los datos')</script>";
            }
    }

    private function checkName($len,$name){
        return !empty($name) && strlen($name)<=$len && preg_match("/[a-zA-Z ]+/",$name);
    }
    public function searchFor($name,$author,$genre,$prize){
        $sql="";
        $where="";
        if(!empty($name)){
            $sql.="NAME ";
            $where.="NAME LIKE '%$name%' ";
        }
        if(!empty($author)){
            $sql.="AUTHOR ";
            $where.="AUTHOR LIKE '%$author%' ";
        }
        if(!empty($genre)){
            $sql.="GENRE ";
            $where.="GENRE LIKE '%$genre%' ";
        }
        if(!empty($genre)){
            $sql.="PRIZE ";
            $where.="PRIZE=$prize' ";
        }
        $sql=str_replace(" ",",",trim($sql));
        $where=str_replace(" ","AND",trim($where));
        if($sql=""){
            header("location: searchDisk.php");
        }else{
            $select=$this->db->prepare("SELECT $sql FROM DISK WHERE $where");
            $select->execute();
        }
    }
}
?>
<?php
require("../controller/controller.php");
class Disk{
    private $image;
    private $name;  
    private $genre;
    private $author;
    private $prize;
    private $songs;
    private $stock;
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
    //Construct
    public function __construct0(){
    $this->db=contactDB("localhost","TRABAJO","root","");
    }
    public function __construct7($name,$image,$genre,$author,$prize,$songs,$stock)
    {
        echo floatval($prize)<=50.00?"True":"False";
        //Verify if the data is correct in the db
        if(is_float(floatval($prize)) && is_int(intval($stock)) && $this->checkName(30,$name)&&$this->checkName(30,$genre)
                    &&$this->checkName(30,$author)&&$this->checkName(100,$songs)&&
                    floatval($prize)>0 && floatval($prize)<=50.00 && intval($stock)>0){
                $this->name=strtoupper($name);
                $this->genre=strtoupper($genre);
                $this->author=strtoupper($author);
                $this->prize=floatval($prize);
                $this->songs=strtoupper($songs);
                $this->stock=intval($stock);
                $this->image="../CSS/IMG/$image";
                echo "Datos insertados correctamente";
            }else{
                 session_start();
                 $_SESSION["errores"]="Error al introducir los datos";
                 header("location: createDisk.php");
            }
            $this->db=contactDB("localhost","TRABAJO","root","");
    }

    private function checkName($len,$name){
        return !empty($name) && strlen($name)<=$len && preg_match("/[a-zA-Z0-9 ]+/",$name);
    }
    //Search for a disk using the params
    public function searchFor($name,$author,$genre,$prize){
        $where=[];
        $name=str_replace(" ","",trim(strtoupper($name)));
        $author=str_replace(" ","",trim(strtoupper($author)));
        $genre=str_replace(" ","",trim(strtoupper($genre)));
        $prizeF=floatval($prize);
        if(!empty($name) && $name!="")
        {
            array_push($where,"NAME LIKE '%$name%' ");
        }
        if(!empty($author) && $author!=""){
            array_push($where," AUTHOR LIKE '%$author%' ");
        }
        if(!empty($genre) && $genre!=""){
            array_push($where," GENRE LIKE '%$genre%' ");
        }
        if(!empty($prizeF)){
            array_push($where," PRIZE= ".floatval($prizeF));
        }
        if(!empty($where)){
            $where="WHERE ".implode("AND",$where);
        }
        @$select=$this->db->prepare("SELECT * FROM DISKS $where");
        @$select->execute();
        return $select;
        }
    //Insert
    public function insert(){
        $dumb=$this->db;
        echo "INSERT INTO DISKS (ID,IMAGE,NAME,GENRE,AUTHOR,PRIZE,SONGS,STOCK) 
        VALUES(NULL,'$this->image',
        '$this->name',
        '$this->genre',
        '$this->author'
        ,$this->prize,
        '$this->songs',$this->stock);";
        try{
        $insert=$dumb->prepare("INSERT INTO DISKS (ID,IMAGE,NAME,GENRE,AUTHOR,PRIZE,SONGS,STOCK) 
                                        VALUES(NULL,\"$this->image\",
                                        \"$this->name\",
                                        \"$this->genre\",
                                        \"$this->author\"
                                        ,$this->prize,
                                        \"$this->songs\",$this->stock);");
        $insert->execute();
        echo "Se ha insertado";
        }catch(PDOException $e){
            echo "Conexion fallida".$e->getMessage();
        }
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
<?php
$_COOKIE["list"]=[];
class DiskController{
    public function __construct(){}
    private function show($listOfDisks){
        $l=array("name","genre","author","prize","songs","stock");
        if(empty($listOfDisks)){
            echo"<h2>No hay ningún disco que coincida</h2>";
        }else{
           $table="<table class'table table-dark'><thead><th scope='col'>Imagen</th>";
           $table.="<th scope='col'>Nombre</th><th scope='col'>Género</th>";
           $table.="<th scope='col'>Autor</th><th scope='col'>Precio</th>";
           $table.="<th scope='col'>Canciones</th><th scope='col'>Stock</th>";
           $table.="</thead><tbody>";
           foreach($listOfDisks as $disk){
               $table.="<tr class''><td><img src='".$disk['image']."'></td>";
               foreach($l as $dumb){
                   $table.="<td><p>".$disk['$dumb']."</p></td>";
               }
               $table.="<td><button type='button' class='btn btn-primary' onclick=".addToCart($disk['id'],$disk['stock']).")";
               $table.=">Añadir</button><button type='button' class='btn btn-danger' onclick='".deleteFromCart($disk['id'])."'>Quitar</button>";
               $table.="</td></tr>";
           }
           echo $table;
        }
    }
    public function select($d,$n,$a,$g,$p){
        $this->show($d->searchFor($n,$a,$g,$p));
    }
    public function insert($d){
        $d->insert();
    }
    public function update($d,$i,$u){
        $d->update($i,$u);
    }
}
//Functions for events
function addToCart($n,$quantity){
    $_COOKIE["list"]=array_push($_COOKIE["list"],"$n $quantity");
}
function deleteFromCart($id){
    $l=[];
    for($i=0;$i<count($_COOKIE["list"]);$i++){
        if(explode(" ",$_COOKIE["list"][$i])[0]!=$id){
            array_push($l,$_COOKIE["list"][$i]);
        }else{
            break;
        }
    }
    for($i=$i+1;$i<count($_COOKIE["list"]);$i++){
        array_push($l,$_COOKIE["list"][$i]);
    }
}
?>
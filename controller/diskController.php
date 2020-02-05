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
               $table.="<tr class''><td><img src='";
               $table.=$disk[7];
               $table.="'></td>";
               $table.="<td><p>".$disk[1]."</p></td>";
               $table.="<td><p>".$disk[2]."</p></td>";
               $table.="<td><p>".$disk[3]."</p></td>";
               $table.="<td><p>".$disk[5]."</p></td>";
               $table.="<td><p>".$disk[4]."</p></td>";
               $table.="<td><p>".$disk[6]."</p></td>";
               $id=$disk[0];
               $stock=$disk[6];
               $table.="<td><button type='button' class='btn btn-primary' onclick='addToCart($id,$stock);')";
               $table.=">Añadir</button><button type='button' class='btn btn-danger' onclick='deleteFromCart($id);'>Quitar</button>";
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
?>
<script>
//Functions for events
function addToCart($n,$quantity){<?php
    $_COOKIE["list"]=array_push($_COOKIE["list"],"$n $quantity");
    echo "<script>alert('Añadido al carrito')</script>";
    ?>
}
function deleteFromCart($id){<?php
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
    echo "<script>alert('Eliminado del carrito')</script>";
    ?>
}
</script>


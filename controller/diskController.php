<?php
class DiskController{
    public function __construct(){}
    private function show($listOfDisks){
           $table="<table class='table table-dark'><thead><th scope='col'>Imagen</th>";
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
               $table.="<td><a role='button' class='btn btn-primary' aria-disabled='false'
               href='cart.php?i=$id&us=".$_GET['us']."'>";
               $table.="Añadir</a><td><a role='button' class='btn btn-danger' aria-disabled='false'
               href='cart.php?d=$id&us=".$_GET['us']."'>Quitar</a>";
               $table.="</td></tr>";
           }
           echo $table;
    }
    public function select($d,$n,$a,$g,$p){
        $this->show($d->searchFor($n,$a,$g,$p));
    }
    public function insert($d){
        $d->insert();
    }
    public function update($d,$i){
        $d->update($i);
    }
}
?>
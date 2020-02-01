<?php
class userController{
    public function __construct(){}
    public function select($d,$n,$p){
        return $d->checkUserExists($n,$p);
    }
    public function insert($d){
        $d->insert();
    }
}
?>
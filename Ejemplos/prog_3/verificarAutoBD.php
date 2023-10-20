<?php
require_once("./clases/autoBD.php");
use VasquezYober\AutoBD;

$obj_auto = isset($_POST["obj_auto"]) ? $_POST["obj_auto"] : "sin obj_auto";
$auto_bd = json_decode($obj_auto);
$neumatico = new AutoBD($auto_bd->patente);


$array_neumaticos = AutoBD::Traer();
$retorno = "{}";
if($neumatico->Existe($array_neumaticos)){
    $item = $neumatico->traerUno();
    if($item != null){        
        $retorno = $item->ToJSON();
    }
}

echo $retorno;
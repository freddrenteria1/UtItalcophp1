<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$arrayId = explode("-", $id);

$cant = count($arrayId);

for($i = 0; $i<$cant; $i++){

    $idb = $arrayId[$i];
    
    $sql = "SELECT * FROM ordenentrada Where id=$idb";
    $exito = mysqli_query($conexion, $sql);

    $enc = mysqli_num_rows($exito);

    if($enc != 0){
        $obj = mysqli_fetch_object($exito);
        
        $datos[] = array(
            'id'=>$obj->id,
            'fecha'=>$obj->fecha,
            'items'=>$obj->items,
            'msn'=>'Ok'
        );
    }

}

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql = "SELECT * FROM devherramientasp Order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $items = json_decode($obj->items);
    $cant = count($items);

    for($i=0; $i<$cant; $i++){
        $datos[] = array(
            'id'=>$obj->id,
            'fecha'=>$obj->fecha,
            'ods'=>$obj->ods,
            'ubicacion'=>$obj->ubicacion,
            'cant'=>$items[$i]->cant,
            'cod'=>$items[$i]->cod,
            'item'=>$items[$i]->item
        );

    }

}

echo json_encode($datos);
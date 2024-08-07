<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$ced = $_POST["ced"];

if($ods == '' || $ods == 'Todos'){
    $query = "SELECT * FROM salidaconsumibles Where ced='$ced' order by fecha DESC";
    $eje = mysqli_query($conexion, $query);

}else{
    $query = "SELECT * FROM salidaconsumibles Where ods='$ods' AND ced='$ced' order by fecha DESC";
    $eje = mysqli_query($conexion, $query);

}

while($obj = mysqli_fetch_object($eje)){

    $nombres = $obj->nombres;

    $items = json_decode($obj->items);
    $fecha = $obj->fecha;
    $cant = count($items);

    for($i=0; $i<$cant; $i++){
        $datos[] = array(
            'nombres'=>$nombres,
            'fecha'=>$fecha,
            'cant'=>$items[$i]->cant,
            'cod'=>$items[$i]->cod,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}


if($ods == '' || $ods == 'Todos'){
    $query = "SELECT * FROM salidadotaciones Where ced='$ced'";
    $eje = mysqli_query($conexion, $query);

}else{
    $query = "SELECT * FROM salidadotaciones Where ods='$ods' AND ced='$ced'";
    $eje = mysqli_query($conexion, $query);

}


while($obj = mysqli_fetch_object($eje)){

    $nombres = $obj->nombres;

    $items = json_decode($obj->items);
    $fecha = $obj->fecha;
    $cant = count($items);

    for($i=0; $i<$cant; $i++){
        $datos[] = array(
            'nombres'=>$nombres,
            'fecha'=>$fecha,
            'cant'=>$items[$i]->cant,
            'cod'=>$items[$i]->cod,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}

echo json_encode($datos);
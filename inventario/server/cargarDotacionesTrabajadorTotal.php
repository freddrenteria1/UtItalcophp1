<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$inicio = $_POST["inicio"];
$fin = $_POST["fin"];


$query = "SELECT * FROM salidadotaciones WHERE ods = '$ods' AND fecha between '$inicio' AND '$fin' order by fecha DESC";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $nombres = $obj->nombres;
    $ced = $obj->ced;

    $items = json_decode($obj->items);
    $fecha = $obj->fecha;
    $cant = count($items);

    for($i=0; $i<$cant; $i++){
        $datos[] = array(
            'nombres'=>$nombres,
            'cargo'=>$obj->cargo,
            'ced'=>$ced,
            'ods'=>$obj->ods,
            'ubicacion'=>"Logística Central",
            'fecha'=>$fecha,
            'cant'=>$items[$i]->cant,
            'cod'=>$items[$i]->cod,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}




echo json_encode($datos);
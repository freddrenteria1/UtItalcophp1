<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["cod"];
$ods = $_POST["ods"];

$sql = "SELECT * FROM devherramientasp  order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $items = json_decode($obj->items);
    $cant = count($items);

    for($i=0;$i<$cant;$i++){
        if($items[$i]->cod == $cod){

            $datos[] =  array(
                'orden'=>$obj->id,
                'fecha'=>$obj->fecha,
                'ods'=>$obj->ods,
                'ubicacion'=>$obj->ubicacion,
                'cant'=>$items[$i]->cant
            ); 

        }
    }
}
   

echo json_encode($datos);
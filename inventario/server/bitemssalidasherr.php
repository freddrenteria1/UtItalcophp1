<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["cod"];
$ods = $_POST["ods"];
$almacen = $_POST["alm"];
$ubicacion = $_POST["ubicacion"];

$sql = "SELECT * FROM salidaherramientas Where ods = '$ods' And ubicacion = '$ubicacion' order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $items = json_decode($obj->items);
    $cant = count($items);

    for($i=0;$i<$cant;$i++){
        if($items[$i]->cod == $cod){

            //verifica cuantos ha devuelto

            $datos[] =  array(
                'orden'=>$obj->id,
                'fecha'=>$obj->fecha,
                'ced'=>$obj->ced,
                'nombres'=>$obj->nombres,
                'cant'=>$items[$i]->cant
            ); 

        }
    }
}
   

echo json_encode($datos);
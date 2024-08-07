<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sum=0;

$ods = $_POST["ods"];
$almacen = $_POST["almacen"];
$ubicacion = $_POST["ubicacion"];

$origen = $almacen . " ODS " . $ods . " " . $ubicacion;

$sum=0;


$sql = "SELECT * FROM traslados Where ods = 'LOGISTICA CENTRAL' AND origen = '$origen' order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $id = $obj->id;

    //busca el id si ya fue registrado en devoluciones anteriores
    $query = "SELECT * FROM devherramientasp WHERE numtras = '$id'";
    $eje = mysqli_query($conexion, $query);

    $cont = mysqli_num_rows($eje);
    if($cont == 0){

        $items = json_decode($obj->items);
        $cant = count($items);

        for($i=0; $i<$cant; $i++){

            $datos[] = array(
                'id'=>$obj->id,
                'fecha'=>$obj->fecha,
                'ods'=>$obj->ods,
                'cant'=>$items[$i]->cant,
                'cod'=>$items[$i]->cod,
                'item'=>$items[$i]->item
            );

            
        }
    }
}


echo json_encode($datos);
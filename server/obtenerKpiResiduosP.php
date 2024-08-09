<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = '015';
// $fecha = '31/03/2021';

//$hito = $_POST["hito"];
$ods = $_POST["ods"];

$sql="SELECT sum(cant) as totcant, ods, codigo, tipo, unidad FROM residuos WHERE ods like '%$ods%' Group by codigo";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'tipo' => $row->tipo,
        'unidad' => $row->unidad,
        'cant' => $row->totcant,
    );
}

echo json_encode($datos);
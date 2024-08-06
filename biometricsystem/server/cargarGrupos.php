<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];

$query = "SELECT * FROM grupos Where ods='$ods'";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=> $row->id,
        'frentetrab'=>$row->frentetrab,
        'grupo' => $row->grupo,
        'supervisor' => $row->supervisor,
        'doc'=>$row->doc
    );
}

echo json_encode($datos);
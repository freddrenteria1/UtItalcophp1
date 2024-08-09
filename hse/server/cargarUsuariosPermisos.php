<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM userspermisos";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'nombres'=>$row->name,
        'cargo'=>$row->cargo,
        'email'=>$row->email,
        'clave'=>$row->clave,
        'numods'=>$row->numods,
        'ods'=>$row->ods,
        'fase'=>$row->fase,
        'odsant'=>$row->odsant
    );
}

echo json_encode($datos);
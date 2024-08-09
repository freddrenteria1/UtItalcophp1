<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM proveedores ORDER BY empresa";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'empresa'=>$obj->empresa
    );
}

echo json_encode($datos);
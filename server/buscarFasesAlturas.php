<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$ods = $_POST["ods"];

$sql="SELECT * FROM consalturasfases WHERE ods='$ods' order by nombre";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'doc' => $row->cedula,
        'nombres'=>$row->nombre,
        'cargo'=>$row->cargo,
        'fase1'=>$row->fase1,
        'fechaf1'=>$row->ffase1,
        'fase2'=>$row->fase2,
        'fechaf2'=>$row->ffase2,
        'fase3'=>$row->fase3,
        'fechaf3'=>$row->ffase3
    );

}  

echo json_encode($datos);
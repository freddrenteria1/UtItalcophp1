<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["cod"];

$sql = "SELECT * FROM invactivos Where codigo='$cod' order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    

    $datos[] =  array(
        'orden'=>$obj->numorden,
        'fecha'=>$obj->fecha,
        'ced'=>$obj->ced,
        'ods'=>$obj->ods,
        'nombres'=>$obj->nombres,
        'cant'=>$obj->cant
    ); 

      
}
   

echo json_encode($datos);
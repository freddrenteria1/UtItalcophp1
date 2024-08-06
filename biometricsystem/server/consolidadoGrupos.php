<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$frente = $_POST["frente"];
$ods = $_POST["ods"];

$sql="SELECT * FROM grupos Where frentetrab = '$frente' AND ods='$ods' ORDER BY grupo";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant !=0){

    while ($row = mysqli_fetch_object($exito)){
         
        $datos[] = array(
            'grupo'=>$row->grupo,
            'docsup'=>$row->doc
        );
    }

}

echo json_encode($datos);
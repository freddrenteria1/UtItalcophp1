<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

// $ods = '16';
// $fecha = '2021-05-07';

$sql="SELECT * FROM personalodsproy WHERE ods='$ods' GROUP BY frente";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant !=0){

    while ($row = mysqli_fetch_object($exito)){
         
        $datos[] = array(
            'frente'=>$row->frente
        );
    }

  

}
 

echo json_encode($datos);
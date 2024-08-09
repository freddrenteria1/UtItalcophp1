<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
$planta = $_POST["planta"];
$fecha = $_POST["fecha"];
$estampe = $_POST["estampe"];
$soldador = $_POST["soldador"];

$datos = json_decode($_POST["datos"]);

foreach($datos as $fila) {
     
    $sk = $fila->sk;
    $detjunta1 = $fila->detjunta1;
    $detjunta2 = $fila->detjunta2;
    $numjunta = $fila->numjunta;
    $pulgadas = $fila->pulgadas;
    $proceso = $fila->proceso;
    $aporte = $fila->aporte;

    $sql="INSERT INTO soldador VALUES('', '$ods','$planta','$fecha','$soldador','$estampe','$sk','$detjunta1','$detjunta2','$numjunta','$pulgadas','$proceso','$aporte')";
    $exito=mysqli_query($conexion, $sql);

    //Actualiza el estado de la junta en el weldbook
    $query = "UPDATE junta SET estado = 'Realizada' Where ods='$ods' and sk='$sk' and juntanum = $numjunta";
    $eje = mysqli_query($conexion, $query);

    
    
}


$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$fecha = $_POST["fecha"];

$fecha = date("d/m/Y", strtotime($fecha));

$est = $_POST["est"];

$sql = "SELECT * FROM soldadores WHERE estampe = '$est'";
$cons = mysqli_query($conexion, $sql);
$fila = mysqli_fetch_object($cons);

$nombre = $fila->nombre;


$buscar="SELECT  *, SUM(pulgdiam) as totpg, COUNT(numjunta) as totjt FROM datoswp WHERE estw1 = '$est' GROUP BY fecha";   
$ejeb = mysqli_query($conexion, $buscar);

while( $obj = mysqli_fetch_object($ejeb)){


    $datos[] = array(
        'nombre'=>$nombre,
        'est'=>$est,
        'fecha'=>$obj->fecha,
        'especialidad'=>$obj->especialidad,
        'equipo'=>$obj->equipo,
        'pulg'=>$obj->totpg,
        'jtas'=>$obj->totjt
    );
     


}

echo json_encode($datos);


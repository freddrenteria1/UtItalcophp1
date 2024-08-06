<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM info";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$dias = $obj->dias;
$finicio = $obj->finicio;

$date1 = new DateTime($finicio);
$date2 = new DateTime($fecha);

$diff = $date1->diff($date2);

$diferencia_en_dias = $diff->days ;

$diastrans = $diferencia_en_dias;

$diasfaltantes = $dias - $diastrans;

$porcdias = intval(($diastrans/$dias)*100);


$datos = array(
    'id'=>$obj->id,
    'finicio'=>$obj->finicio,
    'dias'=>$obj->dias,
    'diastrans'=>$diastrans,
    'diasfaltantes'=>$diasfaltantes,
    'porcdias'=>$porcdias,
    'avanceprog'=>$obj->avanceprog,
    'avanceeje'=>$obj->avanceeje,
    'avancedesv'=>$obj->avancedesv,
    'rutaprog'=>$obj->rutaprog,
    'rutaeje'=>$obj->rutaeje,
    'rutadesv'=>$obj->rutadesv
);


echo json_encode($datos);
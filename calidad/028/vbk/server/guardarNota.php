<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ccontrol = $_POST["ccontrol"];
$fecha = $_POST["fecha"];
$nota = $_POST["nota"];

$query = "SELECT * FROM notas WHERE cuadro = '$ccontrol' AND fecha = '$fecha'";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont == 0){
    $sql="INSERT INTO notas VALUES('', '$ccontrol', '$nota', '$fecha')";
    $exito=mysqli_query($conexion, $sql);
}else{
    $sql = "UPDATE notas SET nota = '$nota' WHERE fecha='$fecha' AND cuadro = '$ccontrol'";
    $exito=mysqli_query($conexion, $sql);
}


if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);
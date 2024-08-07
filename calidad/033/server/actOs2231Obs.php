<?php
// header('Content-type: application/json; charset=utf8');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];
$lazo = $_POST["lazo"];

$datos = $_POST["datos"];
$msn = 'Ok';

$sql1="SELECT * FROM obsLazos WHERE ods='$ods' AND isometrico = '$tag' AND lazo = '$lazo'";
$exito1=mysqli_query($conexion, $sql1);

$enc = mysqli_num_rows($exito1);

if($enc != 0){
    $sql = "UPDATE obsLazos SET observaciones = '$datos' WHERE ods='$ods' AND isometrico = '$tag' AND lazo = '$lazo' ";
    $exito=mysqli_query($conexion, $sql);
    if(!$exito){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "INSERT INTO obsLazos VALUES('', '$ods','$tag', '$lazo', '$datos', '')";
    $exito=mysqli_query($conexion, $sql);
    if(!$exito){
        $msn = mysqli_error($conexion);
    }
}



$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);
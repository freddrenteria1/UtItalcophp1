<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$turno = $_POST["turno"];
$frente = $_POST["frente"];
$grupo = $_POST["grupo"];
$ods = $_POST["ods"];
$user = $_POST["user"];

if($frente == 'Todos'){
    $query = "UPDATE trabajadores SET turno = '$turno' Where ods = '$ods'";
    $eje = mysqli_query($conexion, $query);

    $sql = "INSERT INTO bitacorabio VALUES('', '$fecha', '$user', 'Todos', 'Todos', '$turno', '$frente', '', '$ods','$ip')";
    $exito = mysqli_query($conexion, $sql);

}else{
    $query = "UPDATE trabajadores SET turno = '$turno' Where frentetrab = '$frente' And frente = '$grupo' And ods = '$ods'";
    $eje = mysqli_query($conexion, $query);

    $sql = "INSERT INTO bitacorabio VALUES('', '$fecha', '$user', 'Todos', 'Todos', '$turno', '$frente', '', '$ods','$ip')";
    $exito = mysqli_query($conexion, $sql);
}


if(!$eje){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos[] = array(
    'msn'=>$msn,
);

echo json_encode($datos);
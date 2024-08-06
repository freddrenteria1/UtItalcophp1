<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$fecha = $_POST["fecha"];
$ods = $_POST["ods"];
$frente = $_POST["frente"];

if($frente == 'Todos'){
    $sql = "SELECT * FROM trabajadores Where ods ='$ods' and estado='Activo'";
    $exito = mysqli_query($conexion, $sql);
}else{
    $sql = "SELECT * FROM trabajadores Where ods ='$ods' and frentetrab = '$frente' and estado='Activo'";
    $exito = mysqli_query($conexion, $sql);
}


while($fila = mysqli_fetch_object($exito)){

    $codigo = $fila->contrato;
    $doc = $fila->cedula;
    $nombres = $fila->nombres . ' ' . $fila->apellidos;
    $grupo = $fila->frente;
    $cargo = $fila->cargo;

    $query = "INSERT INTO novepersonal VALUES('', '$fecha', '$codigo', '$doc', '$nombres', '$cargo', '$grupo', 'Descanso', '$ods')";
    $eje = mysqli_query($conexion, $query);

}

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);
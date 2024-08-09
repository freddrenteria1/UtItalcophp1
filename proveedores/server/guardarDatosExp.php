<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$clienteexp1 = $_POST["clienteexp1"];
$objexp1 = $_POST["objexp1"];
$diasexp1 = $_POST["diasexp1"];
$finicioexp1 = $_POST["finicioexp1"];
$ffinexp1 = $_POST["ffinexp1"];
$valorexp1 = $_POST["valorexp1"];
$clienteexp2 = $_POST["clienteexp2"];
$objexp2 = $_POST["objexp2"];
$diasexp2 = $_POST["diasexp2"];
$finicioexp2 = $_POST["finicioexp2"];
$ffinexp2 = $_POST["ffinexp2"];
$valorexp2 = $_POST["valorexp2"];
$clienteexp3 = $_POST["clienteexp3"];
$objexp3 = $_POST["objexp3"];
$diasexp3 = $_POST["diasexp3"];
$finicioexp3 = $_POST["finicioexp3"];
$ffinexp3 = $_POST["ffinexp3"];
$valorexp3 = $_POST["valorexp3"];


//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM infoexperiencia WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO infoexperiencia VALUES('', '$user', '$clienteexp1','$objexp1', $diasexp1, '$finicioexp1', '$ffinexp1',  '$valorexp1', '$clienteexp2','$objexp2', $diasexp2, '$finicioexp2', '$ffinexp2',  '$valorexp2', '$clienteexp3','$objexp3', $diasexp3, '$finicioexp3', '$ffinexp3',  '$valorexp3')";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "UPDATE infoexperiencia SET cliente1 = '$clienteexp1', contratoc1 = '$objexp1', plazoc1 = $diasexp1, finicioc1 = '$finicioexp1', ffinc1 = '$ffinexp1', valorc1 = '$valorexp1', cliente2 = '$clienteexp2', contratoc2 = '$objexp2', plazoc2 = $diasexp2, finicioc2 = '$finicioexp2', ffinc2 = '$ffinexp2', valorc2 = '$valorexp2', cliente3 = '$clienteexp3', contratoc3 = '$objexp3', plazoc3 = $diasexp3, finicioc3 = '$finicioexp3', ffinc3 = '$ffinexp3', valorc3 = '$valorexp3' WHERE user='$user'";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
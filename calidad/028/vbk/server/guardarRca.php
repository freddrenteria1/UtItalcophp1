<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$idplanta = $_POST["planta"];
$unidad = $_POST["unidad"];
$esp = $_POST["esp"];
$equipo = $_POST["equipo"];
$alcance = $_POST["alcance"];
$formato = $_POST["formato"];
$tipo = $_POST["tipo"];
$tipos = $_POST["tipos"];
$tag = $_POST["tag"];

$user = $_POST["user"];

//SE BUSCA LA PLANTA POR EL ID

$query="SELECT * FROM plantascalidad WHERE id=$idplanta";
$eje=mysqli_query($conexion, $query);
$obj = mysqli_fetch_object($eje);

$planta = $obj->planta;


$sql="INSERT INTO rcacalidad VALUES('', '$fecha', '$ods', '$planta', '$unidad', '$esp', '$equipo', '$tipos', '$alcance', '$formato', '$tipo', '$tag', 'Elaborado', '$user')";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $componentes = json_decode($_POST["componentes"]);
// $criterios = json_decode($_POST["criterios"]);

$componentes = $_POST["componentes"];
$criterios = $_POST["criterios"];

$evaluador = $_POST["evaluador"];
$elemento = $_POST["elemento"];
$marca = $_POST["marca"];
$serial = $_POST["serial"];
$fechainsp = $_POST["fechainsp"];
$fechafab = $_POST["fechafab"];
$numprecant = $_POST["numprecant"];
$numprecact = $_POST["numprecact"];
$colorprec = $_POST["colorprec"];
$estado = $_POST["estado"];
$mantenimiento = $_POST["mantenimiento"];
$obs = $_POST["observaciones"];

$ip = $_SERVER['REMOTE_ADDR'];
 
$cadena = 'adjinsp-' . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = '../../archivos/';

// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

if(isset($_FILES['foto'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$cadena.$nombre);
    $archivo=$cadena.$nombre;
}else{
    $archivo = '';
}

$sql="INSERT INTO insp VALUES('','$fechainsp','$elemento','$marca','$serial','$fechafab','$numprecant','$numprecact','$colorprec','$estado','$mantenimiento','$componentes','$criterios','$obs','$archivo','$evaluador')";

$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn,
    'datos'=>$items
);

echo json_encode($datos);
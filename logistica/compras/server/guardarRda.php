<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$datos = json_decode($_POST["datos"]);
$items = $_POST["items"];

$obs = $_POST["observaciones"];
$tiporda = $_POST["tipo"];

$ip = $_SERVER['REMOTE_ADDR'];
 
$nombres = $datos->nombres;
$ods = $_POST["ods"];
$cod = $datos->codigo;
$cedula = $datos->cedula;
$solicitada = $_POST["solicitada"];
$aprobada = $_POST["aprobada"];
$estado = 'Aprobado';

$cadena = 'adjrda-' . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = '../../archivos/';

// Recibo los datos de la imagen
$nombre = $_FILES['adjunto']['name'];
$tipo = $_FILES['adjunto']['type'];
$tamano = $_FILES['adjunto']['size'];

if(isset($_FILES['adjunto'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['adjunto']['tmp_name'],$directorio.$cadena.$nombre);
    $archivo=$cadena.$nombre;
}else{
    $archivo = '';
}

$sql="INSERT INTO rda VALUES('','$fecha','$ods','$items','$solicitada','','','','','','','$aprobada','','','$fecha','$obs','$archivo','','$estado')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok',
    'datos'=>$items
);

echo json_encode($datos);
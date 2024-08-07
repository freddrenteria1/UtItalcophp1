<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$item = $_POST["item"];

$cadena = 'caminata' . $ods . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = './';
// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$cadena.$nombre);
$foto=$cadena.$nombre;

$query = "INSERT INTO fotoscaminata VALUES('', '$item', '$foto', '$ods')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}

$msn = 'Realizado...';

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
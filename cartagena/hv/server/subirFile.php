<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$tipodocumento = $_POST["tipodocumento"];
$nombredoc = $_POST["nombredoc"];


// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';
// Recibo los datos de la imagen
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];

$nombre = $doc . '_'  . $nombre;

// temporal al directorio definitivo
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
$archivo=$nombre;

$query = "INSERT INTO documentos VALUES ('', '$fecha', '$nombredoc', '$tipodocumento', '$archivo', '$doc')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);
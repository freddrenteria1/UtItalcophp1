<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];
$id = $_POST["id"];

$directorio = '../firmas/';

// Recibo los datos de la imagen
$nombre = $_FILES['file']['name'];
$tipo = $_FILES['file']['type'];
$tamano = $_FILES['file']['size'];

if(isset($_FILES['file'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file']['tmp_name'],$directorio.$nombre);
    $archivo=$nombre;
}else{
    $archivo = '';
}



$datos[] = array(
    'msn'=>'Ok'
);

echo json_encode($datos);
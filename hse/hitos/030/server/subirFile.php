<?php
header('Content-type: application/json');
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');


include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

// Ruta donde se guardar?n las im?genes
$directorio = '../archivos/';
// Recibo los datos de la imagen
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
$archivo=$nombre;

$sql="SELECT * FROM hitoshse WHERE id=$id";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

if($obj->doc != ""){
    $docs = json_decode($obj->doc);
}

$docs[] = array(
    'doc'=>$archivo
);

$docs =  json_encode($docs, JSON_UNESCAPED_UNICODE);

$query = "UPDATE hitoshse SET doc = '$docs' WHERE id=$id";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$nombre
);

echo json_encode($datos);

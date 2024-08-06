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

$im = new imagick($archivo);

$imageprops = $im->getImageGeometry();

// reconocimiento de la altura y ancho de la imagen
$width = $imageprops['width'];
$height = $imageprops['height'];


// Nueva altura y ancho
if($width > $height){
    $newHeight = 70;
    $newWidth = (200 / $height) * $width;
}else{
    $newWidth = 200;
    $newHeight = (70 / $width) * $height;
}

$im->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
$im->cropImage (200,70,0,0);
// Escribimos la nueva imagen redimensionada
$im->writeImage($archivo);


$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");



$cadena = 'regfotosup' . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = './';
// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$cadena.$nombre);
$foto=$cadena.$nombre;

$im = new imagick($foto);

$imageprops = $im->getImageGeometry();

// reconocimiento de la altura y ancho de la imagen
$width = $imageprops['width'];
$height = $imageprops['height'];



// Nueva altura y ancho
if($width > $height){
    $newHeight = 420;
    $newWidth = (500 / $height) * $width;
}else{
    $newWidth = 500;
    $newHeight = (420 / $width) * $height;
}

$im->resizeImage($newWidth,$newHeight, imagick::FILTER_LANCZOS, 0.9, true);
$im->cropImage ($newWidth,$newHeight,0,0);
// Escribimos la nueva imagen redimensionada
$im->writeImage($foto);


$msn = 'Ok';


$datos = array(
    'msn' => $msn,
    'foto'=>$foto
);

 
echo json_encode($datos);
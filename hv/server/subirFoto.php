<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$archivo = $_POST["archivo"];

// // Ruta donde se guardar?n las im?genes
// $directorio = 'archivos/';
// // Recibo los datos de la imagen
// $nombre = $_FILES['archivo']['name'];
// $tipo = $_FILES['archivo']['type'];
// $tamano = $_FILES['archivo']['size'];

// $nombre = $doc . '_'  . $nombre;

// // temporal al directorio definitivo
// move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
// $archivo=$nombre;

$sql = "SELECT * FROM fotos WHERE doc = '$doc'";
$exito = mysqli_query($conexion, $sql);
$enc = mysqli_num_rows($exito);

if($enc != 0){
    $query = "UPDATE fotos SET foto = '$archivo' WHERE doc = '$doc'";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "INSERT INTO fotos VALUES ('', '$doc','$archivo')";
    $eje = mysqli_query($conexion, $query);
}


if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);
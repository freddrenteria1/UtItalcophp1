<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$placa = $_POST["placa"];
$fecha = $_POST["fecha"];
$documento = $_POST["documento"];
$conductor = $_POST["conductor"];
$ods = $_POST["ods"];
$planta = $_POST["planta"];
$kilo = $_POST["kilo"];

$items = $_POST["items"];

$firma = $_POST["firma"];

$fotoPD = $_POST["fotoPD"];
$fotoPP = $_POST["fotoPP"];
$fotoLD = $_POST["fotoLD"];
$fotoLI = $_POST["fotoLI"];

$observaciones = $_POST["observaciones"];

//se guardan las fotos

// Ruta donde se guardar?n las im?genes
$directorio = './fotos/';

// Recibo los datos de la imagen
$nombre = $_FILES['fotoPD']['name'];
$tipo = $_FILES['fotoPD']['type'];
$tamano = $_FILES['fotoPD']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['fotoPD']['tmp_name'],$directorio.$nombre);
$nfotoPD=$nombre;

// Recibo los datos de la imagen
$nombre = $_FILES['fotoPP']['name'];
$tipo = $_FILES['fotoPP']['type'];
$tamano = $_FILES['fotoPP']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['fotoPP']['tmp_name'],$directorio.$nombre);
$nfotoPP=$nombre;

// Recibo los datos de la imagen
$nombre = $_FILES['fotoLD']['name'];
$tipo = $_FILES['fotoLD']['type'];
$tamano = $_FILES['fotoLD']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['fotoLD']['tmp_name'],$directorio.$nombre);
$nfotoLD=$nombre;

// Recibo los datos de la imagen
$nombre = $_FILES['fotoLI']['name'];
$tipo = $_FILES['fotoLI']['type'];
$tamano = $_FILES['fotoLI']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['fotoLI']['tmp_name'],$directorio.$nombre);
$nfotoLI=$nombre;


$sql="INSERT INTO inspecciones VALUES('', '$fecha', '$placa', '$documento', '$conductor', '$ods', '$planta', '$kilo', '$items', '$firma', '$nfotoPD', '$nfotoPP', '$nfotoLD', '$nfotoLI', '$observaciones')";
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
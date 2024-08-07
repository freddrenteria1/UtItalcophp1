<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$motivo = $_POST["motivo"];
$fechapcr = $_POST["fechapcr"];
$asistencia = $_POST["asistencia"];
$resultado = $_POST["resultado"];

$cadena = 'resulpcr-' . $doc;

// Ruta donde se guardar?n las im?genes
$directorio = './pruebapcr/';

// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$cadena.$nombre);
$foto=$cadena.$nombre;

if($nombre == ''){
    $foto = '';
}

$query = "INSERT INTO pruebaspcr VALUES('', '$fecha', '$ods', '$nombres', $doc, '$asistencia', '$motivo', '$resultado', '$fechapcr', '$foto')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}

$msn = 'Ok';

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
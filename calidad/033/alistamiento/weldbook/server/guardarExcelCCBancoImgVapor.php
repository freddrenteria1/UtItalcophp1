<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fechamod=date("Y-m-d h:m:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$fechacargue = $_POST["fecha"];

if($fechacargue == ''){
    $fechacargue = $fecha;
}

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$nombre);
$foto=$nombre;


$msn = 'Realizado...';


$sql = "SELECT * FROM imgbanco WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exit);

if($enc == 0){
    $query = "INSERT INTO imgbanco VALUES('', '$fechacargue', '', '$foto', '')";
    $eje = mysqli_query($conexion, $query);
    
    if(!$eje){
        $msn = mysqli_error($conexion);
    }
}else{
    $query = "UPDATE imgbanco SET vapor = '$foto' WHERE fecha = '$fechacargue'";
    $eje = mysqli_query($conexion, $query);
    
    if(!$eje){
        $msn = mysqli_error($conexion);
    }
}


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
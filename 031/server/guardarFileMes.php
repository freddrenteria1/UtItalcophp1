<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$archivo = $_POST["archivo"];
$mes = $_POST["mes"];

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';
// Recibo los datos de la imagen
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
$doc=$nombre;

$sql = "SELECT * FROM filesmes Where mes = '$mes'";
$exito = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc != 0){
    $obj = mysqli_fetch_object($exito);
    
    $query = "UPDATE filesmes SET archivo = '$doc' WHERE mes='$mes'";
    $eje=mysqli_query($conexion, $query);
    
    if(!$eje){
        $msn = mysqli_error($conexion);
    }else{
        $msn = 'Ok';
    }
}else{
    $query = "INSERT INTO filesmes VALUES('', '$fecha', '$mes', '$doc')";
    $eje=mysqli_query($conexion, $query);
    
    if(!$eje){
        $msn = mysqli_error($conexion);
    }else{
        $msn = 'Ok';
    }
}


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
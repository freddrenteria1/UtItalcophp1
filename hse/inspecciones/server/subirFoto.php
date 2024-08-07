<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $componentes = json_decode($_POST["componentes"]);
// $criterios = json_decode($_POST["criterios"]);

$id = $_POST["id"];
 
$cadena = 'adjinsp-' . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = '../../archivos/';

// Recibo los datos de la imagen
$nombre = $_FILES['foto']['name'];
$tipo = $_FILES['foto']['type'];
$tamano = $_FILES['foto']['size'];

if(isset($_FILES['foto'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['foto']['tmp_name'],$directorio.$cadena.$nombre);
    $archivo=$cadena.$nombre;
}else{
    $archivo = '';
}

$sql="UPDATE insp SET foto = '$archivo' Where id=$id";
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
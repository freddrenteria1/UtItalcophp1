<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];
$archivo = $_POST["archivo"];

$cadena = $fecha . '-';

// Ruta donde se guardar?n las im?genes
$directorio = './archivos/';
// Recibo los datos de la imagen
$nombre = $_FILES['archivo']['name'];
$tipo = $_FILES['archivo']['type'];
$tamano = $_FILES['archivo']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$cadena.$nombre);
$foto=$cadena.$nombre;


$sql = "SELECT * FROM os131 Where ods='$ods' AND tag = '$tag'";
$exito = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc != 0){
    $obj = mysqli_fetch_object($exito);
    $archivos = json_decode($obj->fotofinal);

    $archivos[] = array(
        'archivo'=>$foto
    );

    $docs =  json_encode($archivos, JSON_UNESCAPED_UNICODE);
    
    $query = "UPDATE os131 SET fotofinal = '$docs' WHERE ods='$ods' AND tag = '$tag'";
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
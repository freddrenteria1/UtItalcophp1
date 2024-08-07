<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];

$arrayS1 = $_POST["arrayS1"];
$arrayS2 = $_POST["arrayS2"];
$arrayS3 = $_POST["arrayS3"];
$arrayS4 = $_POST["arrayS4"];
$arrayS5 = $_POST["arrayS5"];
$arrayS6 = $_POST["arrayS6"];
$arrayL1 = $_POST["arrayL1"];
$arrayL2 = $_POST["arrayL2"];
$arrayL3 = $_POST["arrayL3"];

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';

// Recibo los datos de la imagen
$nombre1 = $_FILES['file']['name'];
$tipo1 = $_FILES['file']['type'];
$tamano1 = $_FILES['file']['size'];

if(isset($_FILES['file'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file']['tmp_name'],$directorio.$nombre1);
    $archivo1=$nombre1;
}else{
    $archivo1 = '';
}

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM anexoa WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO anexoa VALUES('', '$user', '$arrayS1','$arrayS2', '$arrayS3', '$arrayS4', '$arrayS5',  '$arrayS6', '$arrayL1', '$arrayL2',  '$arrayL3','$archivo1')";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    if($archivo1 != ""){
        $sql = "UPDATE anexoa SET s1 = '$arrayS1', s2 = '$arrayS2', s3 = '$arrayS3', s4 = '$arrayS4', s5 = '$arrayS5', s6 = '$arrayS6', l1 = '$arrayL1', l2 = '$arrayL2', l3 = '$arrayL3', archivo = '$archivo1' WHERE user='$user'";
        $guardar = mysqli_query($conexion, $sql);
    }else{
        $sql = "UPDATE anexoa SET s1 = '$arrayS1', s2 = '$arrayS2', s3 = '$arrayS3', s4 = '$arrayS4', s5 = '$arrayS5', s6 = '$arrayS6', l1 = '$arrayL1', l2 = '$arrayL2', l3 = '$arrayL3' WHERE user='$user'";
        $guardar = mysqli_query($conexion, $sql);
    }

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';

// Recibo los datos de la imagen
$nombre1 = $_FILES['file1']['name'];
$tipo1 = $_FILES['file1']['type'];
$tamano1 = $_FILES['file1']['size'];

if(isset($_FILES['file1'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file1']['tmp_name'],$directorio.$nombre1);
    $archivo1=$nombre1;
}else{
    $archivo1 = '';
}

$nombre2 = $_FILES['file2']['name'];
$tipo2 = $_FILES['file2']['type'];
$tamano2 = $_FILES['file2']['size'];

if(isset($_FILES['file2'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file2']['tmp_name'],$directorio.$nombre2);
    $archivo2=$nombre2;
}else{
    $archivo2 = '';
}

$nombre3 = $_FILES['file3']['name'];
$tipo3 = $_FILES['file3']['type'];
$tamano3 = $_FILES['file3']['size'];

if(isset($_FILES['file3'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file3']['tmp_name'],$directorio.$nombre3);
    $archivo3=$nombre3;
}else{
    $archivo3 = '';
}

$nombre4 = $_FILES['file4']['name'];
$tipo4 = $_FILES['file4']['type'];
$tamano4 = $_FILES['file4']['size'];

if(isset($_FILES['file4'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file4']['tmp_name'],$directorio.$nombre4);
    $archivo4=$nombre4;
}else{
    $archivo4 = '';
}

$nombre5 = $_FILES['file5']['name'];
$tipo5 = $_FILES['file5']['type'];
$tamano5 = $_FILES['file5']['size'];

if(isset($_FILES['file5'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file5']['tmp_name'],$directorio.$nombre5);
    $archivo5=$nombre5;
}else{
    $archivo5 = '';
}

$nombre6 = $_FILES['file6']['name'];
$tipo6 = $_FILES['file6']['type'];
$tamano6 = $_FILES['file6']['size'];

if(isset($_FILES['file6'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['file6']['tmp_name'],$directorio.$nombre6);
    $archivo6=$nombre6;
}else{
    $archivo6 = '';
}

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si ya tiene documentos y actualzia

$consulta = "SELECT * FROM infoexperiencia WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){

    $sql = "INSERT INTO docprov VALUES('','$user','$archivo1','$archivo2','$archivo3','$archivo4','$archivo5','$archivo6')";
    $guardar = mysqli_query($conexion, $sql);

}else{
    $sql = "UPDATE docprov SET file1='$archivo1', file2='$archivo2', file3='$archivo3', file4='$archivo4', file5='$archivo5', file6='$archivo6' WHERE user = '$user'";
    $guardar = mysqli_query($conexion, $sql);
}

if(!$guardar){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
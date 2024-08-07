<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

/* Getting file name */
$filename = $_FILES['file']['name'];
$tipo = $_FILES['file']['type'];

  
/* Location */
$location = "../archivos/".$filename;
$uploadOk = 1;
  
if($uploadOk == 0){
    echo 0;
}else{
    /* Upload file */
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        echo $location;
    }else{
        echo 0;
    }
}

$idcatsel = $_POST["idcatsel"];
$nombcat = $_POST["nombcat"];
$idsubcatsel = $_POST["idsubcatsel"];
$nombsubcat = $_POST["nombsubcat"];
$nombarchivo = $_POST["nombarchivo"];
$prefijo = $_POST["prefijo"];
$version = $_POST["version"];

$sql="INSERT INTO sig VALUES('', '$fecha', $idcatsel, $idsubcatsel, '$nombcat', '$nombsubcat', '$tipo', '$prefijo', '$nombarchivo', '$filename', '$version', 0, '$fecha', 'jc')";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    echo mysqli_error($conexion);
}
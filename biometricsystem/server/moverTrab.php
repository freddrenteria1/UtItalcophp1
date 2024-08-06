<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$query1="SELECT * FROM cedula";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){

    $ced = $obj->cedula;

    $sql = "UPDATE trabajadores SET ods = '028' Where cedula =  '$ced'";
    $eje = mysqli_query($conexion, $sql);
    

    if(!$exito){
        echo 'Error ' . mysqli_error($conexion);
    }else{
        echo '<br>';
        echo $ced;
    }

}

echo 'Realizado';
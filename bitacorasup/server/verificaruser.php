<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];

$query = "SELECT * FROM trabajadores WHERE cedula = $doc";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        if($obj->estado == 'Activo'){
            $msn = 'Ok';
            $nombre = $obj->nombres . ' ' . $obj->apellidos;
        }else{
            $msn = 'Trabajador no activo';
            $nombre = '';
        }
         
    }
}else{
    $msn = 'Trabajador sin registro';
    $nombre = '';
}

$datos = array(
    'msn'=>$msn,
    'nombres'=>$nombre
);

echo json_encode($datos);
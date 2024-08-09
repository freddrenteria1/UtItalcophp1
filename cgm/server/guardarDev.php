<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();


$almacen = $_POST["almacen"];
$obs = $_POST["obs"];
$recibido = $_POST["recibido"];
$registro = $_POST["registro"];
$cargo = $_POST["cargo"];

$ods = $_POST["ods"];
$user = $_POST["user"];

$query="SELECT * FROM users WHERE usuario = '$user'";
$eje=mysqli_query($conexion, $query);

$row = mysqli_fetch_object($eje);

$nombres = $row->nombres;
$cargor = $row->cargo;
$doc = $row->doc;
$firma = $row->firma;


$sql="INSERT INTO devoluciones VALUES('','$fecha','$ods', '$almacen', '$obs','$nombres','$doc','$firma','$cargor','$recibido','$registro','$recibido','$cargo')";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $datos = array(
        'num'=>null,
        'msn'=>'Error',
        'error'=>mysqli_error($conexion)
    );
}else{
    $ultimo_id = mysqli_insert_id($conexion); 

    $datos = array(
        'num'=>$ultimo_id,
        'msn'=>'Ok'
    );
}

echo json_encode($datos);
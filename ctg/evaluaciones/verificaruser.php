<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$user = $_POST["user"];
$clave = $_POST["clave"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$sql="SELECT * FROM userevaladmin WHERE email = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $tipo = $row->tipo;
    $msn = 'Ok';
}else{
    $tipo = '';
    $msn = 'Error';
}

$datos = array(
    'msn' => $msn,
    'tipo'=>$tipo
);

echo json_encode($datos);
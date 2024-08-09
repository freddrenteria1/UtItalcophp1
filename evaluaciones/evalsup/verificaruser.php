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

$sql="SELECT * FROM userseval WHERE email = '$user' AND clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $nombres = $row->nombres;
    $cargo = $row->cargo;
    $ods = $row->ods;
    $msn = 'Ok';
}else{
    $nombres = '';
    $ods = '';
    $cargo = '';
    $msn = 'Error';
}

$datos = array(
    'nombres'=>$nombres,
    'ods'=>$ods,
    'cargo'=>$cargo,
    'msn' => $msn
);

echo json_encode($datos);
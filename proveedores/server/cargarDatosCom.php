<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$msn = 'Ok';

$sql = "SELECT * FROM infocomercial WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'formapago' => $obj->formapago,
        'plazo' => $obj->plazo,
        'servicio1' => $obj->servicio1,
        'servicio2' => $obj->servicio2,
        'servicio3' => $obj->servicio3,
        'emp1' => $obj->emp1,
        'servicioemp1' => $obj->servicioemp1,
        'contactoemp1' => $obj->contactoemp1,
        'telcontactoemp1' => $obj->telcontactoemp1,
        'emp2' => $obj->emp2,
        'servicioemp2' => $obj->servicioemp2,
        'contactoemp2' => $obj->contactoemp2,
        'telcontactoemp2' => $obj->telcontactoemp2
    );

}

echo json_encode($datos);
<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

function obtener_edad_segun_fecha($fecha_nacimiento)
{
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    return $diferencia->format("%y");
}


$sql="SELECT * FROM registro";
$exito=mysqli_query($conexion, $sql);

$cantusuarios = mysqli_num_rows($exito);

while($obj = mysqli_fetch_object($exito)){

    $doc = $obj->doc;
    $clave = $obj->clave;
    $nombres = $obj->nombres;
    $nacimiento = $obj->nacimiento;
    $tel = $obj->tel;

    $sql2="UPDATE  infobasicac SET clave='$clave', nombres='$nombres', nacimiento='$nacimiento', tel='$tel' Where doc = '$doc'";
    $exito2=mysqli_query($conexion, $sql2);
    $enc2 = mysqli_num_rows($exito2);
    
    
    $msn = 'Ok;';

    $datos = array(
        'msn'=>$msn
    );
}
 

echo json_encode($datos);
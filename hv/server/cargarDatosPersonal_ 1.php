<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");



$sql="SELECT * FROM infobasicac";
$exito=mysqli_query($conexion, $sql);


while($obj = mysqli_fetch_object($exito)){

    $fecha_nacimiento = $obj->nacimiento;
    
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    $edad = $diferencia->format("%y");

    //$edad = $obj->nacimiento;
    

    $datos[] = array(
        'id'=>$obj->id,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$edad,
        'tel'=>$obj->tel,
        'datospersonales'=>json_decode($obj->datospersonales)
    );
    
    
}
 

echo json_encode($datos);
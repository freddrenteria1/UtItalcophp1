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


$sql="SELECT * FROM infobasica";
$exito=mysqli_query($conexion, $sql);

$cantusuarios = mysqli_num_rows($exito);

while($obj = mysqli_fetch_object($exito)){

    $fecha_nacimiento = $obj->nacimiento;
    
    $nacimiento = new DateTime($fecha_nacimiento);
    $ahora = new DateTime(date("Y-m-d"));
    $diferencia = $ahora->diff($nacimiento);
    $edad = $diferencia->format("%y");

    $edad = obtener_edad_segun_fecha($obj->nacimiento);
    

    $datos[] = array(
        'id'=>$obj->id,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$edad,
        'tel'=>$obj->tel,
        'datospersonales'=>json_decode($obj->datospersonales),
        'datoscontacto'=>json_decode($obj->datoscontacto),
        'domicilio'=>$obj->domicilio,
        'perfil'=>json_decode($obj->perfil),
        'niveleducativo'=>json_decode($obj->niveleducativo),
        'explaboral'=>json_decode($obj->explaboral),
        'edinformal'=>json_decode($obj->edinformal),
        'certificado'=>json_decode($obj->certificados)
    );
    
    $msn = 'Ok;';
}
 

echo json_encode($datos);
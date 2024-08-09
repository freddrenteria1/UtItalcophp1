<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM registro";
$exito=mysqli_query($conexion, $sql);

$cantusuarios = mysqli_num_rows($exito);

while($obj = mysqli_fetch_object($exito)){

    $doc = $obj->doc;

    $sql2="SELECT * FROM infobasica Where doc = '$doc'";
    $exito2=mysqli_query($conexion, $sql2);
    $enc2 = mysqli_num_rows($exito2);
    
    $row = mysqli_fetch_object($exito2);

    

    $datos[] = array(
        'id'=>$obj->id,
        'fechareg'=>$obj->fechareg,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$obj->nacimiento,
        'tel'=>$obj->tel,
        'datospersonales'=>json_decode($row->datospersonales),
        'datoscontacto'=>json_decode($row->datoscontacto),
        'domicilio'=>$row->domicilio,
        'perfil'=>json_decode($row->perfil),
        'niveleducativo'=>json_decode($row->niveleducativo),
        'explaboral'=>json_decode($row->explaboral),
        'edinformal'=>json_decode($row->edinformal),
        'certificado'=>json_decode($row->certificados)
    );
    
    $msn = 'Ok;';
}
 

echo json_encode($datos);
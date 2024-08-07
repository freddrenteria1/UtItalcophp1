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

    $sql2="SELECT * FROM infobasica Where doc = '$doc'";
    $exito2=mysqli_query($conexion, $sql2);
    $enc2 = mysqli_num_rows($exito2);
    
    $row = mysqli_fetch_object($exito2);

    $edad = obtener_edad_segun_fecha($obj->nacimiento);

    $datospersonales = json_decode($row->datospersonales);
    $perfilarray = json_decode($row->perfil);

    $niveledu = json_decode($row->niveleducativo);

        if($datospersonales != null){

        $sexo = $datospersonales->sexo;
        $cargoasp = $datospersonales->cargoasp;
        $postulado = $datospersonales->postulado;
        $emergencia = $datospersonales->emergencia;
        $numemergencia = $datospersonales->numemergencia;

    }else{
        $sexo = '-';
        $cargoasp = '-';
        $postulado = '-';
        $emergencia = '-';
        $numemergencia = '-';
    }

    if($perfilarray != null){
        $perfil = $perfilarray->perfil;
    }else{
        $pefil = '-';
    }
     

    $datos[] = array(
        'id'=>$obj->id,
        'fechareg'=>$obj->fechareg,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$edad,
        'tel'=>$obj->tel,
        'sexo'=>$sexo,
        'cargoasp'=>$cargoasp,
        'postulado'=>$postulado,
        'emergencia'=>$emergencia,
        'numemergencia'=>$numemergencia,
        'perfil'=>$perfil,
        'niveledu'=>$niveledu
    );
    
    $msn = 'Ok;';
}
 

echo json_encode($datos);
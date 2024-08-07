<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["uservcf"];

$sql="SELECT * FROM registro Where doc = '$doc'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $info = array(
        'id'=>$obj->id,
        'fechareg'=>$obj->fechareg,
        'tipodoc'=>$obj->tipodoc,
        'doc'=>$obj->doc,
        'email'=>$obj->email,
        'nombres'=>$obj->nombres,
        'nacimiento'=>$obj->nacimiento,
        'tel'=>$obj->tel
    );

}

$sql2="SELECT * FROM infobasica Where doc = '$doc'";
$exito2=mysqli_query($conexion, $sql2);
$enc2 = mysqli_num_rows($exito2);

if($enc2 != 0){
    $row = mysqli_fetch_object($exito2);

    $infobasica = array(
        'id'=>$row->id,
        'datospersonales'=>$row->datospersonales,
        'datoscontacto'=>$row->datoscontacto,
        'domicilio'=>$row->domicilio,
        'perfil'=>$row->perfil,
        'niveleducativo'=>$row->niveleducativo,
        'explaboral'=>$row->explaboral,
        'edinformal'=>$row->edinformal,
        'certificado'=>$row->certificados
    );
    $msn = 'Ok;';
}else{
    $msn = 'Error';
    $infobasica = null;
}

$sql3="SELECT * FROM documentos Where doc = '$doc'";
$exito3=mysqli_query($conexion, $sql3);
$enc3 = mysqli_num_rows($exito3);

if($enc3 != 0){
    
    while($file = mysqli_fetch_object($exito3)){
        $archvos[] = array(
            'id'=>$file->id,
            'fecha'=>$file->fecha,
            'titulo'=>$file->titulo,
            'clase'=>$file->clase,
            'file'=>$file->file
        );
    }

    $msn = 'Ok;';
}else{
    $msn = 'Error';
    $archvos = null;
}

$sql5="SELECT * FROM fotos Where doc = '$doc'";
$exito5=mysqli_query($conexion, $sql5);

$foto = mysqli_fetch_object($exito5);

    $infofoto = array(
        'id'=>$foto->id,
        'foto'=>$foto->foto,
        'doc'=>$foto->doc
    );

$datos = array(
    'info'=>$info,
    'infobasica'=>$infobasica,
    'archivos'=>$archvos,
    'infofoto'=>$infofoto,
    'msn'=>$msn
);
 

echo json_encode($datos);
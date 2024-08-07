<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$cont = $_POST["cont"];

$sql="SELECT * FROM registro Where doc = '$doc' AND clave = '$cont'";
$exito=mysqli_query($conexion, $sql);
$enc = mysqli_num_rows($exito);

if($enc != 0){
    $obj = mysqli_fetch_object($exito);

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
    $msn = 'Ok;';
}else{
    $msn = 'Error';
    $info = null;
}


$datos = array(
    'info'=>$info,
    'msn'=>$msn
);
 

echo json_encode($datos);
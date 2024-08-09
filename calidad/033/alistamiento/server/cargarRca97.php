<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os97 WHERE ods='$ods' AND tag  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'datosmttoinicial'=>$obj->datosmttoinicial,
        'firmasmttoinicial'=>$obj->firmasmttoinicial,
        'infofin'=>$obj->infofin,
        'datosmttofinal'=>$obj->datosmttofinal,
        'observaciones'=>$obj->observaciones,
        'firmasmttofinal'=>$obj->firmasmttofinal,
        'doc'=>$obj->doc
    );


echo json_encode($datos);
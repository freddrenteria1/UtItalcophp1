<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os38 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tipo'=>$obj->tipo,
        'tag'=>$obj->tag,
        'etipo'=>$obj->etipo,
        'servicio'=>$obj->servicio,
        'num_tubos'=>$obj->num_tubos,
        'dimen_tubos'=>$obj->dimen_tubos,
        'calibre'=>$obj->calibre,
        'material_tubos'=>$obj->material_tubos,
        'permiso'=>$obj->permiso,
        'limp_partes'=>$obj->limp_partes,
        'limp_haz_tubos'=>$obj->limp_haz_tubos,
        'insp_partes'=>$obj->insp_partes,
        'insp_haz_tubos'=>$obj->insp_haz_tubos,
        'lib_partes'=>$obj->lib_partes,
        'lib_haz_tubos'=>$obj->lib_haz_tubos,
        'prueba'=>$obj->prueba,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);
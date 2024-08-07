<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2241 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tag'=>$obj->tag,
        'fabricante'=>$obj->fabricante,
        'serie'=>$obj->serie,
        'tipoactuador'=>$obj->tipoactuador,
        'modelo'=>$obj->modelo,
        'servicio'=>$obj->servicio,
        'permiso'=>$obj->permiso,
        'limpieza_actuador'=>$obj->limpieza_actuador,
        'limpieza_tuberia'=>$obj->limpieza_tuberia,
        'limpieza_bonete'=>$obj->limpieza_bonete,
        'limpieza_componentes'=>$obj->limpieza_componentes,
        'limpieza_int_valvula'=>$obj->limpieza_int_valvula,
        'limpieza_cuerpo_valvula'=>$obj->limpieza_cuerpo_valvula,
        'inspdimencional'=>$obj->inspdimencional,
        'inspgeneral'=>$obj->inspgeneral,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);
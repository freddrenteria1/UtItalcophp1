<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os114 WHERE ods='$ods' AND isometrico = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'equipo_asoc'=>$obj->equ_asociado,
        'tag'=>$obj->isometrico,
        'lazo_corr'=>$obj->lazo_corrosion,
        'cmls'=>$obj->cml_inspeccionados,
        'limp_fac'=>$obj->limp_faci_insp,
        'rec_post_insp'=>$obj->recom_post_inspec,
        'pintura'=>$obj->pintura_aislami_termico,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/html;charset=utf-8");

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$busqueda = "SELECT * FROM tags WHERE rca='OS97'";
$ejeb = mysqli_query($conexion, $busqueda);

while($obj = mysqli_fetch_object($ejeb)){

    $ods = $obj->ods;
    $unidad = $obj->unidad;
    $planta = $obj->planta;
    $fequipo = $obj->fequipo;
    $tag = $obj->tag;
    
    $query2 = "INSERT INTO os97 VALUES('',   '026',   '$tag', '', '', '', '','','','','','' )";
    $eje2 = mysqli_query($conexion, $query2);

    if(!$eje2){
        $msn = mysqli_error($conexion);
    }else{
        $msn = 'Ok';
    }

}      

$datos = array(
    'msn' => $msn
);
 
echo json_encode($msn);
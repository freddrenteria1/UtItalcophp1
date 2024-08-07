<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];
$lazo = $_POST["lazo"];

$query="SELECT * FROM obsMiscTub WHERE ods='$ods' AND isometrico = '$tag'";
$eje=mysqli_query($conexion, $query);

$enc = mysqli_num_rows($eje);

if($enc != 0){
    $obj = mysqli_fetch_object($eje);

    if($obj->observaciones != '' ){
        $observaciones = json_decode($obj->observaciones);
    }else{
        $observaciones = '';
    }

    if($obj->doc != ""){
        $doc = json_decode($obj->doc);
    }else{
        $doc ="";
    }

}else{
    $observaciones = "";
    $doc = "";
}

$sql="SELECT * FROM osMiscTub WHERE ods='$ods' AND isometrico = '$tag' ";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[]= array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'lazo'=>$obj->lazo,
        'isometrico'=>$obj->isometrico,
        'item'=>$obj->item,
        'item1'=>$obj->item1,
        'item2'=>$obj->item2,
        'item3'=>$obj->item3,
        'actividad'=>$obj->actividad,
        'firmas'=>$obj->firmas
    );

}

$info = array(
    'datos'=>$datos,
    'observaciones'=>$observaciones,
    'doc'=>$doc
);



echo json_encode($info);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$id = $_POST["id"];

//SE VERIFICA QUE EL ID NO ESTÉ REGISTRADO EN LAS ENTRADAS

$query = "SELECT * FROM pruebas WHERE doc = '$doc' AND id = $id";
$eje = mysqli_query($conexion, $query);
$cont = mysqli_num_rows($eje);

if($cont != 0){

    $obj = mysqli_fetch_object($eje);

    $msn = 'Ok';

    $datos = array(
        'id'=>$obj->id,
        'fecha_a'=>$obj->fecha_a,
        'nombre'=>$obj->nombre,
        'cargo'=>$obj->cargo,
        'doc'=>$obj->doc
    );
    
}else{
   $msn = 'Sin registros';
   $datos = null;
}


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
//$fecha=date("Y-m-d H:i:s");

$fecha_actual = date("Y-m-d");
//resto 1 día
// $fecha = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 

$ods = $_POST["ods"];
$doc = $_POST["doc"];
$fecha = $_POST["fecha"];

if($fecha_actual == $fecha){

    $query = "SELECT * FROM bitacora Where fecha = '$fecha' And ods='$ods' AND doc=$doc";
    $eje = mysqli_query($conexion, $query);
    
    $enc = mysqli_num_rows($eje);
    
    if($enc != 0){
        $obj = mysqli_fetch_object($eje);
            
        $datos = array(
            'fecha' => $obj->fecha,
            'nombres' => $obj->nombres,
            'doc' => $obj->doc,
            'turno' => $obj->turno,
            'pdir' => $obj->pdir,
            'pindir'=> $obj->pindir,
            'permiso'=> $obj->permiso,
            'equipos' => $obj->equipos,
            'aspectos' => $obj->aspectos,
            'novedades'=>$obj->novedades
        );
        
    }
}


echo json_encode($datos);
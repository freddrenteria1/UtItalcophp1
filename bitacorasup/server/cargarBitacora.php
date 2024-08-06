<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$fecha_actual = date("Y-m-d");
//resto 1 día
$fecha = $_POST["fecha"];

$query = "SELECT * FROM bitacorasup Where fecha = '$fecha' order by supervisor";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'id'=>$obj->id,
            'fecha' => $obj->fecha,
            'supervisor' => $obj->supervisor,
            'doc' => $obj->doc,
            'turno' => $obj->turno,
            'frente' => $obj->frente,
            'numtrab'=> $obj->numtrab,
            'alcance'=> $obj->alcance,
            'actividades'=> $obj->actividades,
            'om'=> $obj->om,
            'op' => $obj->op,
            'estado' => $obj->estado,
            'galeria'=>$obj->galeria,
            'preguntas'=>$obj->preguntas
        );
    }
}

echo json_encode($datos);
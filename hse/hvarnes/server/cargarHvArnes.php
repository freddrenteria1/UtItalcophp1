<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$query = "SELECT * FROM hvarnes Where ods='$ods' order by fecha desc ";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'fecha' => $obj->fecha,
            'nombres' => $obj->nombres,
            'doc' => $obj->doc,
            'especialidad' => $obj->especialidad,
            'marca_a' => $obj->marca_a,
            'referencia_a'=> $obj->referencia_a,
            'serie_a'=> $obj->serie_a,
            'fecha_a' => $obj->fecha_fab_a,
            'lote_a' => $obj->lote_a,
            'estado_a'=>$obj->estado_a,
            'marca_e' => $obj->marca_e,
            'referencia_e'=> $obj->referencia_e,
            'serie_e'=> $obj->serie_e,
            'fecha_e' => $obj->fecha_fab_e,
            'lote_e' => $obj->lote_e,
            'estado_e'=>$obj->estado_e,
            'notas'=>$obj->notas
        );
    }
}

echo json_encode($datos);
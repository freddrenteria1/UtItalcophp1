<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

// $fechab = '2022-11-10';
// $ods ='026';
// $turno = 'E';

$fechab = $_POST["fecha"];
$ods = $_POST["ods"];
$turno = $_POST["turno"];
//$frente=$_POST["frente"];

$query = "SELECT * FROM trabajadores Where ods='$ods' and estado='Activo' and turno='$turno'";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){

    $doc = $row->cedula;
    $id = $row->id;
    $nombres = $row->nombres . ' ' . $row->apellidos;
    $cargo = $row->cargo;

    
    $trab[] = array(
        'id'=>$row->id,
        'contrato'=>$row->contrato,
        'cedula'=>$row->cedula,
        'nombres'=>$nombres,
        'tiponomina'=>$row->tiponomina,
        'cargo'=>$cargo,
        'fecha'=>$fechab,
        'grupo'=>$row->frente,
        'frentetrab'=>$row->frentetrab,
        'supervisor'=>$row->supervisor
    );

}

$sql = "SELECT * FROM marcaciones Where fecha='$fechab' ";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $hora = $obj->hora;
    $tipo = $obj->tipo;
    $doc = $obj->doc;
    $fecha = $obj->fecha;

    $marca[] = array(
        'idmarca'=>$obj->id,
        'doc'=>$doc,
        'hora'=>$hora,
        'tipo'=>$tipo,
        'fecha'=>$fecha
    );


}

$datos = array(
    'trabajadores'=>$trab,
    'marcaciones'=>$marca
);



echo json_encode($datos);
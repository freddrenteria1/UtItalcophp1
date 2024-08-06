<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_GET["f"];

//busca personal programado

$sql = "SELECT * FROM programados Where finicio = '$fecha' And estado='Programado'";
$eje = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($eje)){

    $id = $obj->id;
    $doc = $obj->doc;
    $ods = $obj->ods;
    $cargo = $obj->cargo;
    $frente = $obj->frente;
    $turno = $obj->turno;
    $estado = 'Activo';
    $finicio = $obj->finicio;

    //verifica si existe sino lo registra
    $cons = "SELECT * FROM trabajadores Where cedula = '$doc'";
    $rcon = mysqli_query($conexion, $cons);

    $cont = mysqli_num_rows($rcon);

    if($cont != 0){

        $query = "UPDATE trabajadores SET cargo='$cargo', frentetrab='$frente', fingreso='$finicio', turno='$turno', ods='$ods', estado='$estado' WHERE cedula = '$doc'";
        $eje2 = mysqli_query($conexion, $query);

        if(!$eje2){
            $msn = mysqli_error($conexion);
        }

        $act = "UPDATE programados SET estado='Cargado' Where id=$id";
        $ejeact = mysqli_query($conexion, $act);

        if(!$ejeact){
            $msn2 = mysqli_error($conexion);
        }
    }

    echo $msn . '<br>';
    echo $msn2;
   
}

$datos = array(
    'msn'=> $msn
);

echo json_encode($datos);
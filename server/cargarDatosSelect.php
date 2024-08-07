<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

    $sql="SELECT * FROM frentes";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        
        $datosFrentes[] = array(
            'id' => $row->id,
            'frente'=>$row->frente
        );

    } 
    
    $sql="SELECT * FROM concepto";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        
        $datosConcepto[] = array(
            'id' => $row->id,
            'concepto'=>$row->concepto
        );

    } 

    $sql="SELECT * FROM especialidades";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        
        $datosEsp[] = array(
            'id' => $row->id,
            'especialidad'=>$row->especialidad
        );

    } 

    $sql="SELECT * FROM origenpago";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        
        $datosOP[] = array(
            'id' => $row->id,
            'origen'=>$row->origen
        );

    } 

   
    $sql="SELECT * FROM ods order by numods";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        
        $datosOds[] = array(
            'id' => $row->id,
            'ods'=>$row->numods
        );

    }

    $datos = array(
        'ods' => $datosOds,
        'origenpago'=>$datosOP,
        'especialidades'=>$datosEsp,
        'concepto'=>$datosConcepto,
        'frentes'=>$datosFrentes
    );

    

echo json_encode($datos);
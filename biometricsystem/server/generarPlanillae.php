<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];
$grupo = $_POST["grupo"];
$docsup = $_POST["docsup"];
$frentetrab = $_POST["frente"];
$turno = $_POST["turno"];
$clasefirma = $_POST["clasefirma"];

$query1="SELECT * FROM asistencias WHERE  ods='$ods' AND doc = '$docsup' AND turno='$turno' AND frente='$frentetrab'  AND fecha='$fecha'";
$exito1=mysqli_query($conexion, $query1);

$encsup = mysqli_num_rows($exito1);

if($encsup != 0){

    $filas = mysqli_fetch_object($exito1);
    
    $turno = $filas->turno;
    $cedula = $filas->doc;
    $id = $filas->id;

    $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
    $eje = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($eje);

    $horaingreso = $row->entrada;
    $horasalida = $row->salida;
    $hh = $row->th;
    
    $filefirma = '../firmas/'  . $cedula . '.jpg';

    $filefirmapng = '../firmas/'  . $cedula . '.png';
    $filefirmajpg = '../firmas/'  . $cedula . '.jpg';

    if(file_exists($filefirmajpg)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg" height="50px">';
    }

    if(file_exists($filefirmapng)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png" height="50px">';
    }

    if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    }

    if($filas->novedad != ''){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    }
    
        
    
    
        $datosPersonal[] = array(
            'contrato' => $filas->contrato,
            'cedula' => $filas->doc,
            'nombres'=>$filas->nombres . ' ' . $filas->apellidos,
            'cargo'=>$filas->cargo,
            'grupo'=>$grupo,
            'frentetrab'=>$filas->frentetrab,
            'turno'=>$filas->turno,
            'horaingreso'=>$horaingreso,
            'horasalida'=>$horasalida,
            'horastrab'=>$filas->hht,
            'firma'=>$firma,
            'observacion'=>$filas->novedad
        );
    

}    
 
$query="SELECT * FROM asistencias WHERE grupo='$grupo'  AND frente='$frentetrab' AND ods='$ods' AND turno='$turno' AND doc != '$docsup'  AND fecha='$fecha'";
$exito=mysqli_query($conexion, $query);

while ($obj = mysqli_fetch_object($exito)){

    //se busca el horario del turno y se verifica la marcación si fue realiza
    $turno = $obj->turno;
    $cedula = $obj->doc;
    $id = $obj->id;

    $sql = "SELECT * FROM codturnos WHERE turno = '$turno'";
    $eje = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($eje);

    $horaingreso = $row->entrada;
    $horasalida = $row->salida;
    $hh = $row->th;

    $filefirma = '../firmas/'  . $cedula . '.jpg';

    $filefirmapng = '../firmas/'  . $cedula . '.png';
    $filefirmajpg = '../firmas/'  . $cedula . '.jpg';

    if(file_exists($filefirmajpg)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg" height="50px">';
    }

    if(file_exists($filefirmapng)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png" height="50px">';
    }

    if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    }

    if($obj->novedad != ''){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    }

    $datosPersonal[] = array(
        'contrato' => $obj->contrato,
        'cedula' => $obj->doc,
        'nombres'=>$obj->nombres . ' ' . $obj->apellidos,
        'cargo'=>$obj->cargo,
        'grupo'=>$obj->grupo,
        'frentetrab'=>$obj->frentetrab,
        'turno'=>$obj->turno,
        'horaingreso'=>$horaingreso,
        'horasalida'=>$horasalida,
        'horastrab'=>$obj->hht,
        'firma'=>$firma,
        'observacion'=>$obj->novedad
    );
    
}
 
echo json_encode($datosPersonal);
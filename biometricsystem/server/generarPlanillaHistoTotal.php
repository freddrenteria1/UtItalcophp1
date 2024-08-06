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
$turno = $_POST["turno"];

 
$query="SELECT * FROM histoplanillas WHERE ods='$ods' AND turno='$turno' AND fecha='$fecha' order by grupo";
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

    if($obj->novedad != ""){
        $horaingreso = '';
        $horasalida = '';
        $hh = 0;
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    }

    
    $datosPersonal[] = array(
        'contrato' => $obj->contrato,
        'cedula' => $obj->doc,
        'nombres'=>$obj->nombres,
        'cargo'=>$obj->cargo,
        'grupo'=>$obj->grupo,
        'frentetrab'=>$obj->frente,
        'turno'=>$obj->turno,
        'horaingreso'=>$horaingreso,
        'horasalida'=>$horasalida,
        'horastrab'=>$obj->hht,
        'firma'=>$firma,
        'observacion'=>$obj->novedad
    );
}
 
echo json_encode($datosPersonal);
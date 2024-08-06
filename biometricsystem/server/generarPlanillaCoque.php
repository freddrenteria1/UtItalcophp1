<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$fecha = $_POST["fecha"];
$turno = $_POST["turno"];
$cant = $_POST["cant"];

 
$query="SELECT * FROM coque WHERE turno='$turno' AND ftrab='$fecha' AND cargo='OBRERO A2'";
$exito=mysqli_query($conexion, $query);

while ($obj = mysqli_fetch_object($exito)){

    //se busca el horario del turno y se verifica la marcación si fue realiza
    $turno = $obj->turno;
    $cedula = $obj->cedula;
     

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

    // if($obj->novedad != ""){
    //     $horaingreso = '';
    //     $horasalida = '';
    //     $hh = 0;
    //     $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="50px">';
    // }

    
    $datosPersonal[] = array(
        'contrato' => $obj->contrato,
        'cedula' => $obj->cedula,
        'nombres'=>$obj->nombres,
        'cargo'=>$obj->cargo,
        'frentetrab'=>$obj->frente,
        'turno'=>$obj->turno,
        'horaingreso'=>$horaingreso,
        'horasalida'=>$horasalida,
        'horastrab'=>$obj->horas,
        'firma'=>$firma,
        'observacion'=>$obj->observaciones
    );
}
 
echo json_encode($datosPersonal);
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
$frentetrab = $_POST["frente"];
$turno = $_POST["turno"];
$grupo = $_POST["grupo"];
$personal = $_POST["personal"];


$cant = count($personal);
 
for($i=0; $i<$cant; $i++){

    //se busca el horario del turno y se verifica la marcación si fue realiza
   
    $cedula = $personal[$i]["cedula"];
    $id = $personal[$i]["id"];
     

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
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg" height="30px">';
    }

    if(file_exists($filefirmapng)){
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png" height="30px">';
    }

    if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
        $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="30px">';
    }

    //verifica si realizo la marcación
    $sqlm = "SELECT * FROM marcaciones Where doc='$id' And fecha='$fecha' AND tipo = 'Entrada'";
    $ejem = mysqli_query($conexion, $sqlm);

    $cantm = mysqli_num_rows($ejem);

    
        if($cantm == 0){
            $horaingreso = '';
            $horasalida = '';
            $hh = 0;
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="30px">';
        }
     

    //verifica si el trabajador tiene novedad
    
    $sqlnov = "SELECT * FROM novepersonal Where doc='$cedula'";
    $ejenov = mysqli_query($conexion, $sqlnov);

    $cantnov = mysqli_num_rows($ejenov);

    if($cantnov != 0){
        $rown = mysqli_fetch_object($ejenov);

        if($rown->novedad == 'Tele-Trabajo'){
            $observacion = $rown->novedad;
        }else{
           
            $observacion = $rown->novedad;
            $horaingreso = '';
            $horasalida = '';
            $hh = 0;
            $firma = '<img src="https://utitalco.com/biometricsystem/firmas/firmab.jpg" height="30px">';
        }
    }else{
        $observacion = '';
    }

    
    $datosPersonal[] = array(
        'contrato' => $personal[$i]["contrato"],
        'cedula' => $personal[$i]["cedula"],
        'nombres'=>$personal[$i]["nombres"],
        'cargo'=>$personal[$i]["cargo"],
        'grupo'=>$grupo,
        'frentetrab'=>$frente,
        'turno'=>$turno,
        'horaingreso'=>$horaingreso,
        'horasalida'=>$horasalida,
        'horastrab'=>$hh,
        'firma'=>$firma,
        'observacion'=>$observacion
    );
}
 
echo json_encode($datosPersonal);
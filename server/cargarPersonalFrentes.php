<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = '017';
// $fecha = '2021-05-20';

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$frente = substr($ods, 4);
$odsg = substr($ods, 0, 3);




$sql="SELECT turno, SUM(directo) as totdir, SUM(indirecto) as totindir, SUM(total) as totp, SUM(hdir) as hdir, SUM(hindir) as hindir, SUM(thh) as tothh FROM turnosdiarios WHERE  frente like '%$frente%' AND fecha = '$fecha' AND ods = '$odsg' GROUP BY turno";
$exito=mysqli_query($conexion, $sql);




while($obj = mysqli_fetch_object($exito)){
        
    $personalfrentes[] = array(
        'turno'=>$obj->turno,
        'directos'=>intval($obj->totdir),
        'indirectos'=>intval($obj->totindir),
        'total'=>intval($obj->totp),
        'hhtdirectos'=>intval($obj->hdir),
        'hhtindirectos'=>intval($obj->hindir),
        'totHH'=>intval($obj->tothh)
    );
}

$query = "SELECT SUM(hdir) as totdir, SUM(hindir) as totindir, SUM(thh) as tothh From turnosdiarios Where frente like '%$frente%' And fecha <= '$fecha' AND ods = '$odsg'";
$eje = mysqli_query($conexion, $query);

$row = mysqli_fetch_object($eje);

$sql2="SELECT * FROM hcap WHERE  ods = '$ods'";
$exito2=mysqli_query($conexion, $sql2);

while($fila = mysqli_fetch_object($exito2)){
    if($fila->fase == 'FASE I'){
        $fase1=$fila->horas;
    }
    if($fila->fase == 'FASE II'){
        $fase2=$fila->horas;
    }
    if($fila->fase == 'FASE III'){
        $fase3=$fila->horas;
    }
    if($fila->fase == 'OTROS'){
        $otros=$fila->horas;
    }
}

$query3 = "SELECT SUM(total) as totp From turnosdiarios Where frente like '%$frente%' AND ods = '$odsg'";
$eje3 = mysqli_query($conexion, $query3);

$rowf = mysqli_fetch_object($eje3);

$totp = $rowf->totp;

$hcap = ($totp * 15)/60;

$datos = array(
    'personalfrentes'=>$personalfrentes,
    'acumHDirectos' => intval($row->totdir),
    'acumHIndirectos' => intval($row->totindir),
    'acumHHTotal' => intval($row->tothh),
    'totConv'=>0,
    'fase1'=>intval($fase1),
    'fase2'=>intval($fase2),
    'fase3'=>intval($fase3),
    'otros'=>intval($otros),
    'hcap'=>$hcap
    
);

echo json_encode($datos);
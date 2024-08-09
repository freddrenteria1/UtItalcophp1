<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta PUNTOS DE INSPECCIÓN
$totalpuntosec = 2;
$totalpuntosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os97f";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$sql="SHOW COLUMNS FROM `os97f`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os97f WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os97f WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalpuntoseceje = $sumfirmaec;
$totalpuntosuteje = $sumfirmaut;


//consulta INGENIERÍAS
$totalingec = 1;
$totalingut = 1;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os95";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantingenierias = $cant;


$totalingec = $totalingec * $cant;
$totalingut = $totalingut * $cant;

$sql="SHOW COLUMNS FROM `os95`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os95 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os95 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalingeceje = $sumfirmaec;
$totalinguteje = $sumfirmaut;


//consulta LAZOS
$totallazosec = 1;
$totallazosut = 1;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os96";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlazos = $cant;


$totallazosec = $totallazosec * $cant;
$totallazosut = $totallazosut * $cant;

$sql="SHOW COLUMNS FROM `os96`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os96 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os96 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totallazoseceje = $sumfirmaec;
$totallazosuteje = $sumfirmaut;

//consulta MISCELANEOS TUBERIAS
$totalmisctubec = 2;
$totalmisctubut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os97";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantmiscelaneostuberias = $cant;


$totalmisctubec = $totalmisctubec * $cant;
$totalmisctubut = $totalmisctubut * $cant;

$sql="SHOW COLUMNS FROM `os97`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os97 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os97 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalmisctubeceje = $sumfirmaec;
$totalmisctubuteje = $sumfirmaut;


$totalmisceceje = $totalmisctubeceje;
$totalmiscuteje = $totalmisctubuteje;



$os94 = array(
    'totalpuntosec'=>$totalpuntosec,
    'totalpuntosut'=> $totalpuntosut,
    'totalpuntoseceje'=>$totalpuntoseceje,
    'totalpuntosuteje'=>$totalpuntosuteje,
    'totalfirmas'=>$totalpuntosec+$totalpuntosut,
    'totalfirmaseje'=>$totalpuntoseceje + $totalpuntosuteje ,
    'cantpuntos'=>$cantpuntos
);

$os95 = array(
    'totalingec'=>$totalingec,
    'totalingut'=> $totalingut,
    'totalingeceje'=>$totalingeceje,
    'totalinguteje'=>$totalinguteje,
    'totalfirmas'=>$totalingec+$totalingut,
    'totalfirmaseje'=>$totalingeceje + $totalinguteje,
    'cantingenierias'=>$cantingenierias
);

$os96 = array(
    'totallazosec'=>$totallazosec,
    'totallazosut'=> $totallazosut,
    'totallazoseceje'=>$totallazoseceje,
    'totallazosuteje'=>$totallazosuteje,
    'totalfirmas'=>$totallazosec+$totallazosut,
    'totalfirmaseje'=>$totallazoseceje + $totallazosuteje ,
    'cantlazos'=>$cantlazos
);

$os97 = array(
    'totalmisctubec'=>$totalmisctubec,
    'totalmisctubut'=> $totalmisctubut,
    'totalmisctubeceje'=>$totalmisctubeceje,
    'totalmisctubuteje'=>$totalmisctubuteje,
    'totalfirmas'=>$totalmisctubec+$totalmisctubut,
    'totalfirmaseje'=>$totalmisctubeceje + $totalmisctubuteje,
    'cantmiscelaneostuberias'=>$cantmiscelaneostuberias
);

$totalequipos = $cantpuntos + $cantingenierias + $cantlazos + $cantmiscelaneostuberias;
$totalitalcoplan = $totalpuntosut + $totalingec + $totallazosut + $totalmisctubut;  
$totalecoplan = $totalpuntosec + $totaltorresec + $totallazosec + $totalmisctubec;
$totalitalcoeje = $totalpuntosuteje + $totalinguteje + $totallazosuteje + $totalmisctubuteje; 
$totalecoeje = $totalpuntoseceje + $totalingeceje + $totallazoseceje + $totalmisctubeceje;

$totalfirmasplan = $totalitalcoplan + $totalecoplan;
$totalfirmaseje = $totalitalcoeje + $totalecoeje;
$firmasfaltantes = $totalfirmasplan - $totalfirmaseje;

$consolidado = array(
    'totalequipos'=>$totalequipos,
    'totalitalcoplan'=>$totalitalcoplan,
    'totalecoplan'=>$totalecoplan,
    'totalitalcoeje'=>$totalitalcoeje,
    'totalecoeje'=>$totalecoeje,
    'totalfirmasplan'=>$totalfirmasplan,
    'totalfirmaseje'=>$totalfirmaseje,
    'firmasfaltantes'=>$firmasfaltantes
);

$datos = array(
    'os94'=>$os94,
    'os95'=>$os95,
    'os96'=>$os96,
    'os97'=>$os97,
    'consolidado'=>$consolidado
);

echo json_encode($datos);

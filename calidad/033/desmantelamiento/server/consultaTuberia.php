<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta PUNTOS DE INSPECCIÓN
$totalpuntosec = 3;
$totalpuntosut = 3;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os114";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$sql="SHOW COLUMNS FROM `os114`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os114 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os114 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalpuntoseceje = $sumfirmaec;
$totalpuntosuteje = $sumfirmaut;


//consulta INGENIERÍAS
$totalingec = 7;
$totalingut = 6;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os115";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantingenierias = $cant;


$totalingec = $totalingec * $cant;
$totalingut = $totalingut * $cant;

$sql="SHOW COLUMNS FROM `os115`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons2 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalingeceje = $sumfirmaec;
$totalinguteje = $sumfirmaut;


//consulta LAZOS
$totallazosec = 1;
$totallazosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM osLazos";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlazos = $cant;


$totallazosec = $totallazosec * $cant;
$totallazosut = $totallazosut * $cant;

$sql="SHOW COLUMNS FROM `osLazos`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM osLazos WHERE " . $campo . " LIKE '%\"firmasup\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons3 = "SELECT * FROM osLazos WHERE " . $campo . " LIKE '%\"firmaq\":\"data:image/png;%'";
    $ejec3 = mysqli_query($conexion, $cons3);
    $enc3 = mysqli_num_rows($ejec3);

    $sumfirmaut += $enc3;

    $cons2 = "SELECT * FROM osLazos WHERE " . $campo . " LIKE '%\"firmaecp\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totallazoseceje = $sumfirmaec;
$totallazosuteje = $sumfirmaut;

//consulta MISCELANEOS TUBERIAS
$totalmisctubec = 1;
$totalmisctubut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM osMiscTub";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantmiscelaneostuberias = $cant;


$totalmisctubec = $totalmisctubec * $cant;
$totalmisctubut = $totalmisctubut * $cant;

$sql="SHOW COLUMNS FROM `osMiscTub`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM osMiscTub WHERE " . $campo . " LIKE '%\"firmasup\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons3 = "SELECT * FROM osMiscTub WHERE " . $campo . " LIKE '%\"firmaq\":\"data:image/png;%'";
    $ejec3 = mysqli_query($conexion, $cons3);
    $enc3 = mysqli_num_rows($ejec3);

    $sumfirmaut += $enc3;

    $cons2 = "SELECT * FROM osMiscTub WHERE " . $campo . " LIKE '%\"firmaecp\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalmisctubeceje = $sumfirmaec;
$totalmisctubuteje = $sumfirmaut;

//consulta MISCELANEOS INSTRUMENTACIÓN
$totalmiscinstec = 1;
$totalmiscinstut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM 	osMiscInst";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantmiscelaneosinstrumentacion = $cant;


$totalmiscinstec = $totalmiscinstec * $cant;
$totalmiscinstut = $totalmiscinstut * $cant;

$sql="SHOW COLUMNS FROM `osMiscInst`";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
   
    $campo = $row->Field;

    $cons1 = "SELECT * FROM osMiscInst WHERE " . $campo . " LIKE '%\"firmasup\":\"data:image/png;%'";
    $ejec1 = mysqli_query($conexion, $cons1);
    $enc1 = mysqli_num_rows($ejec1);

    $sumfirmaut += $enc1;

    $cons3 = "SELECT * FROM osMiscInst WHERE " . $campo . " LIKE '%\"firmaq\":\"data:image/png;%'";
    $ejec3 = mysqli_query($conexion, $cons3);
    $enc3 = mysqli_num_rows($ejec3);

    $sumfirmaut += $enc3;

    $cons2 = "SELECT * FROM osMiscInst WHERE " . $campo . " LIKE '%\"firmaecp\":\"data:image/png;%'";
    $ejec2 = mysqli_query($conexion, $cons2);
    $enc2 = mysqli_num_rows($ejec2);

    $sumfirmaec += $enc2;
}

$totalmiscinsteceje = $sumfirmaec;
$totalmiscinstuteje = $sumfirmaut;

$totalmisceceje = $totalmisctubeceje + $totalmiscinsteceje;
$totalmiscuteje = $totalmisctubuteje + $totalmiscinstuteje;



$puntos = array(
    'totalpuntosec'=>$totalpuntosec,
    'totalpuntosut'=> $totalpuntosut,
    'totalpuntoseceje'=>$totalpuntoseceje,
    'totalpuntosuteje'=>$totalpuntosuteje,
    'totalfirmas'=>$totalpuntosec+$totalpuntosut,
    'totalfirmaseje'=>$totalpuntoseceje + $totalpuntosuteje ,
    'cantpuntos'=>$cantpuntos
);

$ingenierias = array(
    'totalingec'=>$totalingec,
    'totalingut'=> $totalingut,
    'totalingeceje'=>$totalingeceje,
    'totalinguteje'=>$totalinguteje,
    'totalfirmas'=>$totalingec+$totalingut,
    'totalfirmaseje'=>$totalingeceje + $totalinguteje,
    'cantingenierias'=>$cantingenierias
);

$lazos = array(
    'totallazosec'=>$totallazosec,
    'totallazosut'=> $totallazosut,
    'totallazoseceje'=>$totallazoseceje,
    'totallazosuteje'=>$totallazosuteje,
    'totalfirmas'=>$totallazosec+$totallazosut,
    'totalfirmaseje'=>$totallazoseceje + $totallazosuteje ,
    'cantlazos'=>$cantlazos
);

$miscelaneostub = array(
    'totalmisctubec'=>$totalmisctubec,
    'totalmisctubut'=> $totalmisctubut,
    'totalmisctubeceje'=>$totalmisctubeceje,
    'totalmisctubuteje'=>$totalmisctubuteje,
    'totalfirmas'=>$totalmisctubec+$totalmisctubut,
    'totalfirmaseje'=>$totalmisctubeceje + $totalmisctubuteje,
    'cantmiscelaneostuberias'=>$cantmiscelaneostuberias
);

$miscelaneosinst = array(
    'totalmiscinstec'=>$totalmiscinstec,
    'totalmiscinstut'=> $totalmiscinstut,
    'totalmiscinsteceje'=>$totalmiscinsteceje,
    'totalmiscinstuteje'=>$totalmiscinstuteje,
    'totalfirmas'=>$totalmiscinstec+$totalmiscinstut,
    'totalfirmaseje'=>$totalmiscinsteceje + $totalmiscinstuteje,
    'cantmiscelaneosinstrumentacion'=>$cantmiscelaneosinstrumentacion
);

$totalequipos = $cantpuntos + $cantingenierias + $cantlazos + $cantmiscelaneostuberias + $cantmiscelaneosinstrumentacion;
$totalitalcoplan = $totalpuntosut + $totalingec + $totallazosut + $totalmisctubut + $totalmiscinstut ;
$totalecoplan = $totalpuntosec + $totaltorresec + $totallazosec + $totalmisctubec + $totalmiscinstec ;
$totalitalcoeje = $totalpuntosuteje + $totalinguteje + $totallazosuteje + $totalmisctubuteje + $totalmiscinstuteje;
$totalecoeje = $totalpuntoseceje + $totalingeceje + $totallazoseceje + $totalmisctubeceje + $totalmiscinsteceje;

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
    'puntos'=>$puntos,
    'ingenierias'=>$ingenierias,
    'lazos'=>$lazos,
    'miscelaneostub'=>$miscelaneostub,
    'miscelaneosinst'=>$miscelaneosinst,
    'consolidado'=>$consolidado
);

echo json_encode($datos);

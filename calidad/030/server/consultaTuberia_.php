<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta PUNTOS DE INSPECCIÓN
$totalpuntosec = 3;
$totalpuntosut = 3;
$totalpuntosec1 = 3;
$totalpuntosut1 = 3;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os114";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$cons3 = "SELECT * FROM os114";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->isometrico;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os114`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os114 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND isometrico = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os114 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND isometrico = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

     

    $tagspuntos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalpuntosut1,
        'totalfirmasecpplan'=>$totalpuntosec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalpuntosut1 + $totalpuntosec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalpuntosut1 + $totalpuntosec1)-($sumfirmaut+$sumfirmaec)
    );

}


//consulta INGENIERÍAS
$totalingec = 7;
$totalingut = 6;
$totalingec1 = 7;
$totalingut1 = 6;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os115";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantingenierias = $cant;

$totalingec = $totalingec * $cant;
$totalingut = $totalingut * $cant;

$cons3 = "SELECT * FROM os115";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($obj = mysqli_fetch_object($ejec3)){

    $tag = $obj->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $sql="SHOW COLUMNS FROM `os115`";
    $exito=mysqli_query($conexion, $sql);

    while($row = mysqli_fetch_object($exito)){
    
        $campo = $row->Field;

        $cons1 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons1 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmautsup\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons1 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmautqaqc\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons2 = "SELECT * FROM os115 WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'" . " AND tag = '$tag'" ;
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);

        $sumfirmaec += $enc2;
    }

     

    $tagsingenierias[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalingut1,
        'totalfirmasecpplan'=>$totalingec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalingut1 + $totalingec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalingut1 + $totalingec1)-($sumfirmaut+$sumfirmaec)
    );

}

//consulta LAZOS
$totallazosec = 1;
$totallazosut = 2;
$totallazosec1 = 0;
$totallazosut1 = 0;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM osLazos ";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlazos = $cant;

$totallazosec = $totallazosec * $cant;
$totallazosut = $totallazosut * $cant;

$cons3 = "SELECT * FROM osLazos GROUP BY  isometrico";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

$cadenasup = '"firmasup":"data:image/png;base64';
$cadenaq = '"firmaq":"data:image/png;base64';
$cadenaec = '"firmaecp":"data:image/png;base64';

while($obj = mysqli_fetch_object($ejec3)){

    
    $tag = $obj->isometrico;
    $sumfirmaut = 0;
    $sumfirmaec = 0;
   
    $totallazosec1 = 0;
    $totallazosut1 = 0;  

        $cons1 = "SELECT * FROM osLazos WHERE  isometrico = '$tag' "  ;
        $ejec1 = mysqli_query($conexion, $cons1);

        while($fila = mysqli_fetch_object($ejec1)){

            $totallazosec1 += 1;
            $totallazosut1 += 2;

            $firma = $fila->firmas;

            $encontrado = strpos($firma, $cadenasup);
            if($encontrado != false){
                $sumfirmaut++;
            }

            $encontrado = strpos($firma, $cadenaq);
            if($encontrado != false){
                $sumfirmaut++;
            }

            $encontrado = strpos($firma, $cadenaec);
            if($encontrado != false){
                $sumfirmaec++;
            }


        }
 
     
    
    $tagslazos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totallazosut1,
        'totalfirmasecpplan'=>$totallazosec1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totallazosut1 + $totallazosec1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totallazosut1 + $totallazosec1)-($sumfirmaut+$sumfirmaec)
    );

}

 
    




$datos = array(
    'puntos'=>$tagspuntos,
    'ingenierias'=>$tagsingenierias,
    'lazos'=>$tagslazos
);

echo json_encode($datos);

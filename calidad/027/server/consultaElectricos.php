<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();



$tablas[] = array(
    'familia'=>'PUESTA A TIERRA',
    'tabla'=>'os118',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'MTO TOMAS',
    'tabla'=>'os126',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'AISLAMIENTO Y CONTINUIDAD CABLES POTENCIA',
    'tabla'=>'os175',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'MOTORES ELECTRICOS DE BAJA Y MEDIA TENSIÓN',
    'tabla'=>'os124',
    'planut'=>1,
    'planec'=>2,
    'ejeec'=>0,
    'ejeut'=>0,
);

$sumcant = COUNT($tablas);

for ($i=0; $i<$sumcant;$i++){

    //echo $tablas[$i]["tabla"];

    $tabla = $tablas[$i]["tabla"] ;

    $cons = "SELECT * FROM "  . $tabla ;
    $ejec = mysqli_query($conexion, $cons);
    $canttags = mysqli_num_rows($ejec);

    $sql="SHOW COLUMNS FROM  `"  . $tabla . "`"   ;
    $exito=mysqli_query($conexion, $sql);

    $sumfirmaut = 0;
    $sumfirmaec = 0;

    
    while($row = mysqli_fetch_object($exito)){
       
        $campo = $row->Field;
    
       $cons1 = "SELECT * FROM "  . $tabla . "  WHERE " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;
    
        $cons2 = "SELECT * FROM "  . $tabla . "  WHERE " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);
    
        $sumfirmaec += $enc2;
    }

    $planut = $tablas[$i]["planut"]  * $canttags;
    $planec = $tablas[$i]["planec"]  * $canttags;

    $totalplanut += $planut;
    $totalplanec += $planec;

    $totejeut += $sumfirmaut;
    $totejeec += $sumfirmaec;

    $tottags += $canttags;

    $tablasFinal[] = array(
        'familia'=>$tablas[$i]["familia"] ,
        'tabla'=>$tablas[$i]["tabla"] ,
        'canttags'=>$canttags,
        'planut'=>$planut ,
        'planec'=>$planec,
        'ejeut'=>$sumfirmaut,
        'ejeec'=>$sumfirmaec ,
    );

}

$totales = array(
    'tottags'=>$tottags,
    'totalplanut'=>$totalplanut,
    'totalplanec'=>$totalplanec,
    'totejeut'=>$totejeut,
    'totejeec'=>$totejeec
);

$datos = array(
    'tablas'=>$tablasFinal,
    'totales'=>$totales
);



echo json_encode($datos);


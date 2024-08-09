<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();



$tablas[] = array(
    'familia'=>'DESMANTELAMIENTO SISTEMA ELÉCTRICO',
    'tabla'=>'os120',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'INSTALACIÓN DE BANDEJAS PORTACABLES',
    'tabla'=>'os148',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'INSTALACIÓN DE TUBERÍA ELÉCTRICO',
    'tabla'=>'os213',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'INSTALACIÓN DE CABLE ELÉCTRICO',
    'tabla'=>'os175',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'INSTALACIÓN LUMINARIAS',
    'tabla'=>'os119',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'PROVISIONALES MTTO TABLEROS U2700',
    'tabla'=>'os214',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SISTEMA DE IGNICIÓN',
    'tabla'=>'os171',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SISTEMA DE IGNICIÓN',
    'tabla'=>'os131',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SISTEMA DE IGNICIÓN',
    'tabla'=>'os170',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TABLEROS DISTRIBUCIÓN',
    'tabla'=>'os127',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SWICHTGEAR',
    'tabla'=>'os122',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'CENTRO DE CONTROL DE MOTORES Y CENTRO DE POTENCIA (CCM-PC)',
    'tabla'=>'os123',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSFORMADORES SECOS',
    'tabla'=>'os130',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'MOTORES BEC',
    'tabla'=>'os124',
    'planut'=>1,
    'planec'=>2,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'PRESERVACIÓN DE MOTORES',
    'tabla'=>'os172',
    'planut'=>1,
    'planec'=>2,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'PRESERVACIÓN DE MOTORES',
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


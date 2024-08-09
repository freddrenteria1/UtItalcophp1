<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();



$tablas[] = array(
    'familia'=>'CAJAS DE CONEXIONADO',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os91',
    'planut'=>4,
    'planec'=>2,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'CAJAS DE CONEXIONADO',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os84',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSMISORES DE PRESIÓN',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os86',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'TRANSMISORES DE PRESIÓN',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os87',
    'planut'=>2,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSMISORES DE NIVEL',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os86',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'TRANSMISORES DE NIVEL',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os87',
    'planut'=>2,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSMISORES DE FLUJO',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os86',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'TRANSMISORES DE FLUJO',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os87',
    'planut'=>2,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSMISORES DE TEMPERATURA',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os99',
    'planut'=>2,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'TRANSMISORES DE TEMPERATURA',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os100',
    'planut'=>1,
    'planec'=>0,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TERMOCUPLAS TIPO TERMOPOZO',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os90',
    'planut'=>4,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'TERMOCUPLAS TIPO TERMOPOZO',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os98',
    'planut'=>2,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);



$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os88',
    'planut'=>2,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os60',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);



$tablas[] = array(
    'familia'=>'PLATINAS DE ORIFICIO',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os82',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);
$tablas[] = array(
    'familia'=>'PLATINAS DE ORIFICIO',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os83',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);


$sumcant = COUNT($tablas);

for ($i=0; $i<$sumcant;$i++){

    //echo $tablas[$i]["tabla"];

    $tabla = $tablas[$i]["tabla"] ;
    $familia = $tablas[$i]["familia"] ;
    $tipo = $tablas[$i]["tipo"] ;

    if($tabla != 'os84' ){
        $cons = "SELECT * FROM "  . $tabla  .  " WHERE familia = '" . $familia  . "'" ;
        $ejec = mysqli_query($conexion, $cons);
        $canttags = mysqli_num_rows($ejec);
    }else {
        # code...
        $cons = "SELECT * FROM "  . $tabla  ;
        $ejec = mysqli_query($conexion, $cons);
        $canttags = mysqli_num_rows($ejec);
    }


    $sql="SHOW COLUMNS FROM  `"  . $tabla . "`"   ;
    $exito=mysqli_query($conexion, $sql);

    $sumfirmaut = 0;
    $sumfirmaec = 0;

    
    while($row = mysqli_fetch_object($exito)){
       
        $campo = $row->Field;
    
       $cons1 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaut\":\"data:image/png;%'";
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;
    
        $cons2 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
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
        'tipo'=>$tablas[$i]["tipo"] ,
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
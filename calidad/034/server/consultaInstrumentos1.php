<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL SERVOMOTOR',
    'tipo'=>'',
    'tabla'=>'os89',
    'planut'=>4,
    'planec'=>4,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL ON-OFF',
    'tipo'=>'',
    'tabla'=>'os160',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'TRANSMISORES',
    'tipo'=>'',
    'tabla'=>'os86',
    'planut'=>5,
    'planec'=>5,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'JB',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os91',
    'planut'=>2,
    'planec'=>4,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'JB',
    'tipo'=>'PRUEBA',
    'tabla'=>'os92',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'PLATINAS DE ORIFICIO',
    'tipo'=>'',
    'tabla'=>'os82',
    'planut'=>4,
    'planec'=>4,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SWITCHES',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os112',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'SWITCHES',
    'tipo'=>'PRUEBA',
    'tabla'=>'os161',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'LAZO DE TEMPERATURA',
    'tipo'=>'',
    'tabla'=>'os90',
    'planut'=>7,
    'planec'=>4,
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

    

    // echo $cons;
    // echo '<br>';


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

        $cons1 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaut1\":\"data:image/png;%'";
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

        $cons1 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaut2\":\"data:image/png;%'";
        $ejec1 = mysqli_query($conexion, $cons1);
        $enc1 = mysqli_num_rows($ejec1);

        $sumfirmaut += $enc1;

       
    
        $cons2 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaec\":\"data:image/png;%'";
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);
    
        $sumfirmaec += $enc2;

        $cons2 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaec1\":\"data:image/png;%'";
        $ejec2 = mysqli_query($conexion, $cons2);
        $enc2 = mysqli_num_rows($ejec2);
    
        $sumfirmaec += $enc2;

        $cons2 = "SELECT * FROM "  . $tabla . "  WHERE familia =   '" . $familia . "'  AND  " . $campo . " LIKE '%\"firmaec2\":\"data:image/png;%'";
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
        'planut'=>$planut,
        'planec'=>$planec,
        'ejeut'=>$sumfirmaut,
        'ejeec'=>$sumfirmaec,
        'totplan'=>$planut + $planec,
        'toteje'=>$sumfirmaut + $sumfirmaec
    );

}

$consolidado = array(
    'tottags'=>$tottags,
    'totalplanut'=>$totalplanut,
    'totalplanec'=>$totalplanec,
    'totejeut'=>$totejeut,
    'totejeec'=>$totejeec,
    'totplan'=>$totalplanut + $totalplanec,
    'toteje'=>$totejeut + $totejeec
);

$datos = array(
    'tablas'=>$tablasFinal,
    'consolidado'=>$consolidado
);

echo json_encode($datos);
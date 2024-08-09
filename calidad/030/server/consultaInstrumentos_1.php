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
    'planut'=>3,
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
    'planut'=>3,
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
    'planut'=>3,
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
    'planut'=>3,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);



$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os88',
    'planut'=>3,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL',
    'tipo'=>'CALIBRACIÓN',
    'tabla'=>'os176',
    'planut'=>2,
    'planec'=>2,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'VÁLVULAS DE CONTROL',
    'tipo'=>'PRUEBA DE LAZO',
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


$tablas[] = array(
    'familia'=>'TERMOCUPLAS TIPO PIEL DE PARED',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os90',
    'planut'=>4,
    'planec'=>3,
    'ejeec'=>0,
    'ejeut'=>0,
);

$tablas[] = array(
    'familia'=>'SERVOMOTORES',
    'tipo'=>'PRUEBA DE LAZO',
    'tabla'=>'os60',
    'planut'=>1,
    'planec'=>1,
    'ejeec'=>0,
    'ejeut'=>0,
);


$tablas[] = array(
    'familia'=>'SERVOMOTORES',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os89',
    'planut'=>2,
    'planec'=>2,
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
    'familia'=>'VÁLVULAS SOLENOIDE',
    'tipo'=>'CUSTODIA',
    'tabla'=>'os160',
    'planut'=>3,
    'planec'=>3,
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
    'totejeec'=>$totejeec,
    'totplan'=>$totalplanut + $totalplanec,
    'toteje'=>$totejeut + $totejeec
);

 

//consulta CAJAS CUSTODIA OS91
$totalecp = 2;
$totalut = 4;

$cons = "SELECT * FROM os91";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os91";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os91 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec1 != ""){
                $sumfirmaec++;
            }
            if($estadoinicial[0]->nombreec2 != ""){
                $sumfirmaec++;
            }
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec1 != ""){
                $sumfirmaec++;
            }
            if($estadofinal[0]->nombreec2 != ""){
                $sumfirmaec++;
            }
        }
    
    }

    $tagsCajas[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consCajas = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta CAJAS CALIBRACIÓN OS84
$totalecp = 1;
$totalut = 1;

$cons = "SELECT * FROM os84";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons33 = "SELECT * FROM os84";
$ejec33 = mysqli_query($conexion, $cons33);
$enc33 = mysqli_num_rows($ejec33);

while($row = mysqli_fetch_object($ejec33)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os84 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmasverificacion != ""){
            $firmasverificacion =  json_decode($obj->firmasverificacion);

            if($firmasverificacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasverificacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsCajasCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consCajasCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta TRANSMISORES DE PRESIÓN CUSTODIA OS86
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE PRESIÓN'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE PRESIÓN'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os86 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE PRESIÓN'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->firmaitems != ""){
            $firmaitems =  json_decode($obj->firmaitems);

            if($firmaitems[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmaitems[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsTransPresCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransPresCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE PRESIÓN CALIBRACIÓN OS87
$totalecp = 1;
$totalut = 3;

$cons = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE PRESIÓN'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE PRESIÓN'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os87 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE PRESIÓN'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->datoscal != ""){
            $datoscal =  json_decode($obj->datoscal);

            if($datoscal[0]->nombreut1 != ""){
                $sumfirmaut++;
            }
            if($datoscal[0]->nombreut2 != ""){
                $sumfirmaec++;
            }
        }

        if($obj->datosprueba != ""){
            $datosprueba =  json_decode($obj->datosprueba);

            if($datosprueba[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($datosprueba[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
         
    
    }

    $tagsTransPresCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransPresCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE NIVEL CUSTODIA OS86
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE NIVEL'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE NIVEL'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os86 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE NIVEL'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->firmaitems != ""){
            $firmaitems =  json_decode($obj->firmaitems);

            if($firmaitems[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmaitems[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsTransNivelCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransNivelCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE NIVEL CALIBRACIÓN OS87
$totalecp = 1;
$totalut = 3;

$cons = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE NIVEL'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE NIVEL'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os87 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE NIVEL'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->datoscal != ""){
            $datoscal =  json_decode($obj->datoscal);

            if($datoscal[0]->nombreut1 != ""){
                $sumfirmaut++;
            }
            if($datoscal[0]->nombreut2 != ""){
                $sumfirmaec++;
            }
        }

        if($obj->datosprueba != ""){
            $datosprueba =  json_decode($obj->datosprueba);

            if($datosprueba[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($datosprueba[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
         
    
    }

    $tagsTransNivelCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransNivelCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE FLUJO CUSTODIA OS86
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE FLUJO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os86 WHERE familia = 'TRANSMISORES DE FLUJO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os86 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE FLUJO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->firmaitems != ""){
            $firmaitems =  json_decode($obj->firmaitems);

            if($firmaitems[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmaitems[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsTransFlujoCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransFlujoCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE FLUJO CALIBRACIÓN OS87
$totalecp = 1;
$totalut = 3;

$cons = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE FLUJO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os87 WHERE familia = 'TRANSMISORES DE FLUJO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os87 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE FLUJO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->datoscal != ""){
            $datoscal =  json_decode($obj->datoscal);

            if($datoscal[0]->nombreut1 != ""){
                $sumfirmaut++;
            }
            if($datoscal[0]->nombreut2 != ""){
                $sumfirmaut++;
            }
        }

        if($obj->datosprueba != ""){
            $datosprueba =  json_decode($obj->datosprueba);

            if($datosprueba[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($datosprueba[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
         
    
    }

    $tagsTransFlujoCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransFlujoCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TRANSMISORES DE TEMPERATURA CUSTODIA OS99
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os99 WHERE familia = 'TRANSMISORES DE TEMPERATURA'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os99 WHERE familia = 'TRANSMISORES DE TEMPERATURA'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os99 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE TEMPERATURA'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);

            if($firmas[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmas[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsTransTempCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransTempCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta TRANSMISORES DE TEMPERATURA CALIBRACIÓN OS100
$totalecp = 0;
$totalut = 2;

$cons = "SELECT * FROM os100 WHERE familia = 'TRANSMISORES DE TEMPERATURA'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os100 WHERE familia = 'TRANSMISORES DE TEMPERATURA'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os100 WHERE tag = '$tag' AND familia = 'TRANSMISORES DE TEMPERATURA'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);

            if($firmas[0]->nombreut1 != ""){
                $sumfirmaut++;
            }

            if($firmas[0]->nombreut2 != ""){
                $sumfirmaut++;
            }
            
        }

    
    }

    $tagsTransTempCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTransTempCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta TERMOCUPLAS TIPO TERMOPOZO CUSTODIA OS90
$totalecp = 3;
$totalut = 4;

$cons = "SELECT * FROM os90 WHERE familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os90 WHERE familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os90 WHERE tag = '$tag' AND familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->verificado != ""){
            $verificado =  json_decode($obj->verificado);

            if($verificado[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($verificado[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);

            if($prueba[0]->nombre != ""){
                $sumfirmaut++;
            }
            
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        
    
    }

    $tagsTermTpozoCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTermTpozoCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta TERMOCUPLAS TIPO TERMOPOZO CALIBRACIÓN OS98
$totalecp = 1;
$totalut = 3;

$cons = "SELECT * FROM os98 WHERE familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os98 WHERE familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os98 WHERE tag = '$tag' AND familia = 'TERMOCUPLAS TIPO TERMOPOZO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->verificacion != ""){
            $verificacion =  json_decode($obj->verificacion);

            if($verificacion[0]->nombreut1 != ""){
                $sumfirmaut++;
            }

            if($verificacion[0]->nombreut2 != ""){
                $sumfirmaut++;
            }
            
        }

        if($obj->pruebas != ""){
            $pruebas =  json_decode($obj->pruebas);

            if($pruebas[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pruebas[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

    
    }

    $tagsTermTpozoCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTermTpozoCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);




//consulta VÁLVULAS DE CONTROL CUSTODIA OS88
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os88 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os88 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os88 WHERE tag = '$tag' AND familia = 'VÁLVULAS DE CONTROL'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);

            if($firmas[0]->nombreut != ""){
                $sumfirmaut++;
            }

            if($firmas[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        
    
    }

    $tagsValvulasCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consValvulasCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta VÁLVULAS DE CONTROL CALIBRACIÓN OS176
$totalecp = 2;
$totalut = 2;

$cons = "SELECT * FROM os176 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os176 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os176 WHERE tag = '$tag' AND familia = 'VÁLVULAS DE CONTROL'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmasinsp != ""){
            $firmasinsp =  json_decode($obj->firmasinsp);

            if($firmasinsp[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasinsp[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->entrega != ""){
            $entrega =  json_decode($obj->entrega);

            if($entrega[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($entrega[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        

    
    }

    $tagsValvulasCusto160[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consValvulasCusto160 = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);

//consulta VÁLVULAS DE CONTROL PRUEBA DE LAZO OS60
$totalecp = 1;
$totalut = 1;

$cons = "SELECT * FROM os60 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os60 WHERE familia = 'VÁLVULAS DE CONTROL'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os60 WHERE tag = '$tag' AND familia = 'VÁLVULAS DE CONTROL'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->datoscal != ""){
            $datoscal =  json_decode($obj->datoscal);

            if($datoscal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($datoscal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsValvulasPrueba[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consValvulasPrueba = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta PLATINAS DE ORIFICIO CUSTODIA OS82
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os82 WHERE familia = 'PLATINAS DE ORIFICIO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os82 WHERE familia = 'PLATINAS DE ORIFICIO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os82 WHERE tag = '$tag' AND familia = 'PLATINAS DE ORIFICIO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmachecklist != ""){
            $firmachecklist =  json_decode($obj->firmachecklist);

            if($firmachecklist[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmachecklist[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        
    
    }

    $tagsPlatinasCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consPlatinasCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta PLATINAS DE ORIFICIO CALIBRACIÓN OS983
$totalecp = 1;
$totalut = 1;

$cons = "SELECT * FROM os83 WHERE familia = 'PLATINAS DE ORIFICIO'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os83 WHERE familia = 'PLATINAS DE ORIFICIO'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os83 WHERE tag = '$tag' AND familia = 'PLATINAS DE ORIFICIO'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);

            if($firmas[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmas[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

    
    }

    $tagsPlatinasCal[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consPlatinasCal = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta TERMOCUPLAS TIPO PIEL DE PARED CUSTODIA OS90
$totalecp = 3;
$totalut = 4;

$cons = "SELECT * FROM os90 WHERE familia = 'TERMOCUPLAS TIPO PIEL DE PARED'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os90 WHERE familia = 'TERMOCUPLAS TIPO PIEL DE PARED'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os90 WHERE tag = '$tag' AND familia = 'TERMOCUPLAS TIPO PIEL DE PARED'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->verificado != ""){
            $verificado =  json_decode($obj->verificado);

            if($verificado[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($verificado[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);

            if($prueba[0]->nombre != ""){
                $sumfirmaut++;
            }
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        
    
    }

    $tagsTermParedCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consTermParedCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta SERVOMOTORES PRUEBA DE LAZO OS60
$totalecp = 1;
$totalut = 1;

$cons = "SELECT * FROM os60 WHERE familia = 'SERVOMOTORES'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os60 WHERE familia = 'SERVOMOTORES'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os60 WHERE tag = '$tag' AND familia = 'SERVOMOTORES'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->datoscal != ""){
            $datoscal =  json_decode($obj->datoscal);

            if($datoscal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($datoscal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsServoPrueba[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consServoPrueba = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);



//consulta SERVOMOTORES CUSTODIA OS89
$totalecp = 2;
$totalut = 2;

$cons = "SELECT * FROM os89 WHERE familia = 'SERVOMOTORES'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os89 WHERE familia = 'SERVOMOTORES'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os89 WHERE tag = '$tag' AND familia = 'SERVOMOTORES'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsServoCusto89[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consServoCusto89 = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);

//consulta SERVOMOTORES CUSTODIA OS160
// $totalecp = 3;
// $totalut = 3;

// $cons = "SELECT * FROM os160 WHERE familia = 'SERVOMOTORES'";
// $ejec = mysqli_query($conexion, $cons);
// $cant = mysqli_num_rows($ejec);

// $cantrca = $cant;
// $totfirmas = $totfirmas * $cant;

// $sumtotalecp = $totalecp * $cant;
// $sumtotalut = $totalut * $cant;

// $sumfirmaut = 0;
// $sumfirmaec = 0;

// $sumtotalecpeje = 0;
// $sumtotaluteje = 0;

// $cons3 = "SELECT * FROM os160 WHERE familia = 'SERVOMOTORES'";
// $ejec3 = mysqli_query($conexion, $cons3);
// $enc3 = mysqli_num_rows($ejec3);

// while($row = mysqli_fetch_object($ejec3)){

//     $tag = $row->tag;
//     $sumfirmaut = 0;
//     $sumfirmaec = 0;

//     $cons4 = "SELECT * FROM os160 WHERE tag = '$tag' AND familia = 'SERVOMOTORES'";
//     $ejec4 = mysqli_query($conexion, $cons4);

//     while($obj = mysqli_fetch_object($ejec4)){

//         if($obj->firmadatos != ""){
//             $firmadatos =  json_decode($obj->firmadatos);
            
//             if($firmadatos[0]->nombreut != ""){
//                 $sumfirmaut++;
//             }

//             if($firmadatos[0]->nombreec != ""){
//                 $sumfirmaec++;
//             }
            
//         }

//         if($obj->estadoinicial != ""){
//             $estadoinicial =  json_decode($obj->estadoinicial);

//             if($estadoinicial[0]->nombreut != ""){
//                 $sumfirmaut++;
//             }
//             if($estadoinicial[0]->nombreec != ""){
//                 $sumfirmaec++;
//             }
            
//         }

//         if($obj->estadofinal != ""){
//             $estadofinal =  json_decode($obj->estadofinal);

//             if($estadofinal[0]->nombreut != ""){
//                 $sumfirmaut++;
//             }
//             if($estadofinal[0]->nombreec != ""){
//                 $sumfirmaec++;
//             }
            
//         }
    
//     }

//     $tagsServoCusto160[] = array(
//         'tag'=>$tag,
//         'totalfirmasutplan'=>$totalut,
//         'totalfirmasecpplan'=>$totalecp,
//         'totalfimasuteje'=>$sumfirmaut,
//         'totalfirmaseceje'=> $sumfirmaec,
//         'totalfirmasplan'=>$totalut + $totalecp,
//         'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
//         'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
//     );


//     $sumtotalecpeje += $sumfirmaec;
//     $sumtotaluteje += $sumfirmaut;
     

// }

// $consServoCusto160 = array(
//     'totalecplan'=> $sumtotalecp,
//     'totalutplan'=> $sumtotalut,
//     'totaleceje'=> $sumtotalecpeje,
//     'totaluteje'=>  $sumtotaluteje,
//     'totalplan'=>$sumtotalecp+$sumtotalut,
//     'totaleje'=>$sumtotalecpeje+$sumtotaluteje
// );

//consulta SWITCHES CUSTODIA OS112
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os112 WHERE familia = 'SWITCHES'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os112 WHERE familia = 'SWITCHES'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os112 WHERE tag = '$tag' AND familia = 'SWITCHES'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);
            
            if($firmas[0]->nombreut != ""){
                $sumfirmaut++;
            }

            if($firmas[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }
    
    }

    $tagsSwitchCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consSwitchCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);


//consulta VÁLVULAS SOLENOIDE CUSTODIA OS160
$totalecp = 3;
$totalut = 3;

$cons = "SELECT * FROM os160 WHERE familia = 'VÁLVULAS SOLENOIDE'";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantrca = $cant;
$totfirmas = $totfirmas * $cant;

$sumtotalecp = $totalecp * $cant;
$sumtotalut = $totalut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$sumtotalecpeje = 0;
$sumtotaluteje = 0;

$cons3 = "SELECT * FROM os160 WHERE familia = 'VÁLVULAS SOLENOIDE'";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os160 WHERE tag = '$tag' AND familia = 'VÁLVULAS SOLENOIDE'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmadatos != ""){
            $firmadatos =  json_decode($obj->firmadatos);

            if($firmadatos[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmadatos[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadoinicial != ""){
            $estadoinicial =  json_decode($obj->estadoinicial);

            if($estadoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

        if($obj->estadofinal != ""){
            $estadofinal =  json_decode($obj->estadofinal);

            if($estadofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($estadofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }

    
    }

    $tagsValvulasSolCusto[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirmaut+$sumfirmaec)
    );


    $sumtotalecpeje += $sumfirmaec;
    $sumtotaluteje += $sumfirmaut;
     

}

$consValvulasSolCusto = array(
    'totalecplan'=> $sumtotalecp,
    'totalutplan'=> $sumtotalut,
    'totaleceje'=> $sumtotalecpeje,
    'totaluteje'=>  $sumtotaluteje,
    'totalplan'=>$sumtotalecp+$sumtotalut,
    'totaleje'=>$sumtotalecpeje+$sumtotaluteje
);





$datos = array(
    'tagsCajas'=>$tagsCajas,
    'consCajas'=>$consCajas,
    'tagsCajasCal'=>$tagsCajasCal,
    'consCajasCal'=>$consCajasCal,
    'tagsTransPresCusto'=>$tagsTransPresCusto,
    'consTransPresCusto'=>$consTransPresCusto,
    'tagsTransPresCal'=>$tagsTransPresCal,
    'consTransPresCal'=>$consTransPresCal,
    'tagsTransNivelCusto'=>$tagsTransNivelCusto,
    'consTransNivelCusto'=>$consTransNivelCusto,
    'tagsTransNivelCal'=>$tagsTransNivelCal,
    'consTransNivelCal'=>$consTransNivelCal,
    'tagsTransFlujoCusto'=>$tagsTransFlujoCusto,
    'consTransFlujoCusto'=>$consTransFlujoCusto,
    'tagsTransFlujoCal'=>$tagsTransFlujoCal,
    'consTransFlujoCal'=>$consTransFlujoCal,
    'tagsTransTempCusto'=>$tagsTransTempCusto,
    'consTransTempCusto'=>$consTransTempCusto,
    'tagsTransTempCal'=>$tagsTransTempCal,
    'consTransTempCal'=>$consTransTempCal,
    'tagsTermTpozoCusto'=>$tagsTermTpozoCusto,
    'consTermTpozoCusto'=>$consTermTpozoCusto,
    'tagsTermTpozoCal'=>$tagsTermTpozoCal,
    'consTermTpozoCal'=>$consTermTpozoCal,
    'tagsValvulasCusto'=>$tagsValvulasCusto,
    'consValvulasCusto'=>$consValvulasCusto,
    'tagsValvulasCusto160'=>$tagsValvulasCusto160,
    'consValvulasCusto160'=>$consValvulasCusto160,
    'tagsValvulasPrueba'=>$tagsValvulasPrueba,
    'consValvulasPrueba'=>$consValvulasPrueba,
    'tagsPlatinasCusto'=>$tagsPlatinasCusto,
    'consPlatinasCusto'=>$consPlatinasCusto,
    'tagsPlatinasCal'=>$tagsPlatinasCal,
    'consPlatinasCal'=>$consPlatinasCal,
    'tagsTermParedCusto'=>$tagsTermParedCusto,
    'consTermParedCusto'=>$consTermParedCusto,
    'tagsServoPrueba'=>$tagsServoPrueba,
    'consServoPrueba'=>$consServoPrueba,
    'tagsServoCusto89'=>$tagsServoCusto89,
    'consServoCusto89'=>$consServoCusto89,
    'tagsSwitchCusto'=>$tagsSwitchCusto,
    'consSwitchCusto'=>$consSwitchCusto,   
    'tagsValvulasSolCusto'=>$tagsValvulasSolCusto,
    'consValvulasSolCusto'=>$consValvulasSolCusto,     

    'totales'=>$totales
);

echo json_encode($datos);
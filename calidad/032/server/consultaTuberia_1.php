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

// $totalpuntosec = $totalpuntosec * $cant;
// $totalpuntosut = $totalpuntosut * $cant;


while($row = mysqli_fetch_object($ejec)){

    $tag = $row->isometrico;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os114 WHERE isometrico = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->limp_faci_insp != ""){
            $limp_faci_insp =  json_decode($obj->limp_faci_insp);
            if($limp_faci_insp[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($limp_faci_insp[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }

        if($obj->recom_post_inspec != ""){
            $recom_post_inspec =  json_decode($obj->recom_post_inspec);
            if($recom_post_inspec[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($recom_post_inspec[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }

        if($obj->pintura_aislami_termico != ""){
            $pintura_aislami_termico =  json_decode($obj->pintura_aislami_termico);
            if($pintura_aislami_termico[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura_aislami_termico[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }

    }

    $tagspuntos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalpuntosut,
        'totalfirmasecpplan'=>$totalpuntosec,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalpuntosut + $totalpuntosec,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalpuntosut + $totalpuntosec)-($sumfirmaut+$sumfirmaec)
    );
 

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


// $totalingec = $totalingec * $cant;
// $totalingut = $totalingut * $cant;

while($row = mysqli_fetch_object($ejec)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os115 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->permiso != ""){
            $permiso =  json_decode($obj->permiso);
            if($permiso[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($permiso[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
    
        if($obj->ejecucion != ""){
            $ejecucion =  json_decode($obj->ejecucion);
            if($ejecucion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }


        if($obj->liberacion != ""){
            $liberacion =  json_decode($obj->liberacion);
        
            $cant = COUNT($liberacion);
        
            for($i=0; $i<$cant;$i++){
                if($liberacion[$i]->nombreutsup != ""){
                    $sumfirmaut++;
                }
                if($liberacion[$i]->nombreutqaqc != ""){
                    $sumfirmaut++;
                }
                
                if($liberacion[$i]->nombreec != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    

        if($obj->prueba != ""){
            $prueba =  json_decode($obj->prueba);
            if($prueba[0]->nombreec != ""){
                $sumfirmaec++;
            }
            
        }    

        if($obj->terminacion != ""){
            $terminacion =  json_decode($obj->terminacion);
            if($terminacion[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($terminacion[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }

        if($obj->pintura != ""){
            $pintura =  json_decode($obj->pintura);
            if($pintura[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($pintura[0]->nombreec != ""){
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

    $tagsingenierias[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalingut,
        'totalfirmasecpplan'=>$totalingec,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalingut + $totalingec,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalingut + $totalingec)-($sumfirmaut+$sumfirmaec)
    );

}

$totalingeceje = $sumfirmaec;
$totalinguteje = $sumfirmaut;


//consulta LAZOS
$totallazosec = 1;
$totallazosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM osLazos GROUP BY isometrico";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantlazos = $cant;

// $totallazosec = $totallazosec * $cant;
// $totallazosut = $totallazosut * $cant;

while($row = mysqli_fetch_object($ejec)){

    $tag = $row->isometrico;
    $sumfirmaut = 0;
    $sumfirmaec = 0;
    $totallazosec = 1;
    $totallazosut = 2;

    $cons4 = "SELECT * FROM osLazos WHERE isometrico = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);
    $cant = mysqli_num_rows($ejec4);

    $totallazosec = $totallazosec * $cant;
    $totallazosut = $totallazosut * $cant;

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);
        
            $cant = COUNT($firmas);
        
            for($i=0; $i<$cant;$i++){
                if($firmas[$i]->nombresup != ""){
                    $sumfirmaut++;
                }
                if($firmas[$i]->nombreq != ""){
                    $sumfirmaut++;
                }
                
                if($firmas[$i]->nombreecp != ""){
                    $sumfirmaec++;
                }
            }
        
        }
    }

    $tagslazos[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totallazosut,
        'totalfirmasecpplan'=>$totallazosec,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totallazosut + $totallazosec,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totallazosut + $totallazosec)-($sumfirmaut+$sumfirmaec)
    );

}



$datos = array(
    'puntos'=>$tagspuntos,
    'ingenierias'=>$tagsingenierias,
    'lazos'=>$tagslazos
);

echo json_encode($datos);

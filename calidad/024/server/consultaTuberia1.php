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

while($obj = mysqli_fetch_object($ejec)){

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

while($obj = mysqli_fetch_object($ejec)){

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

while($obj = mysqli_fetch_object($ejec)){

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

while($obj = mysqli_fetch_object($ejec)){

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

while($obj = mysqli_fetch_object($ejec)){

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
$totalitalcoplan = $totalpuntosut + $totalingut + $totallazosut + $totalmisctubut + $totalmiscinstut ;
$totalecoplan = $totalpuntosec + $totalingec + $totallazosec + $totalmisctubec + $totalmiscinstec ;
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

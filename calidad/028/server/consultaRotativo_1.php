<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta os94
$totalpuntosec = 2;
$totalpuntosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os94";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os94";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os94 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmasini != ""){
            $firmasini =  json_decode($obj->firmasini);
            if($firmasini[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasini[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->firmasfin != ""){
            $firmasfin =  json_decode($obj->firmasfin);
            if($firmasfin[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
    
    }

    $tagsRotativo[] = array(
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

//consulta os96
$totalpuntosec = 2;
$totalpuntosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os96";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os96";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os96 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmasini != ""){
            $firmasini =  json_decode($obj->firmasini);
            if($firmasini[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasini[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->firmasfin != ""){
            $firmasfin =  json_decode($obj->firmasfin);
            if($firmasfin[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
    
    }

    $tagsRotativo[] = array(
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

//consulta os97
$totalpuntosec = 2;
$totalpuntosut = 2;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os97";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

$totalpuntosec = $totalpuntosec * $cant;
$totalpuntosut = $totalpuntosut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os97";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os97 WHERE tag = '$tag'";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmasini != ""){
            $firmasini =  json_decode($obj->firmasini);
            if($firmasini[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasini[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        if($obj->firmasfin != ""){
            $firmasfin =  json_decode($obj->firmasfin);
            if($firmasfin[0]->nombreut != ""){
                $sumfirmaut++;
            }
        }
    
    
    }

    $tagsRotativo[] = array(
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

echo json_encode($tagsRotativo);
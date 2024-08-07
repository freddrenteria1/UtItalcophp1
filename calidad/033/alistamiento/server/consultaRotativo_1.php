<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta os95
$totalpuntosec = 1;
$totalpuntosut = 1;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os95";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

// $totalpuntosec = $totalpuntosec * $cant;
// $totalpuntosut = $totalpuntosut * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons3 = "SELECT * FROM os95";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $tag = $row->tag;
    $sumfirmaut = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM os95 WHERE tag = '$tag'";
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

    $tagsRotativo1[] = array(
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
$totalpuntosec = 1;
$totalpuntosut = 1;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os96";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantpuntos = $cant;

// $totalpuntosec = $totalpuntosec * $cant;
// $totalpuntosut = $totalpuntosut * $cant;

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

    $tagsRotativo2[] = array(
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

// $totalpuntosec = $totalpuntosec * $cant;
// $totalpuntosut = $totalpuntosut * $cant;

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

        if($obj->firmasmttoinicial != ""){
            $firmasmttoinicial =  json_decode($obj->firmasmttoinicial);
            if($firmasmttoinicial[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasmttoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
        
        if($obj->firmasmttofinal != ""){
            $firmasmttofinal =  json_decode($obj->firmasmttofinal);
            if($firmasmttofinal[0]->nombreut != ""){
                $sumfirmaut++;
            }
            if($firmasmttofinal[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
    
    
    }

    $tagsRotativo3[] = array(
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

$datos = array(
    'tagsRotativo1'=>$tagsRotativo1,
    'tagsRotativo2'=>$tagsRotativo2,
    'tagsRotativo3'=>$tagsRotativo3
);

echo json_encode($datos);
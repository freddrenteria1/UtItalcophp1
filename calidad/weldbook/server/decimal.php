<?php

$string = ' 1/2 ';
$string = trim($string);

$buscar   = ' ';
$posicion = strpos($string, $buscar);

if ($posicion === false) {

    echo 'No Encontro espacio <br>'; 

    $buscar   = '/';
    $posicion = strpos($string, $buscar);

    if ($posicion === false) {
        $pulg = number_format($string, 2);
    }else{
        $porc = explode("/", $string);
        $pulg = $porc[0] / $porc[1];
        $pulg = number_format($pulg, 2);
    }


    
}else{

    echo 'Encontro espacio <br>'; 

    $porc = explode(" ", $string);
    $parte1 = $porc[0];

    $parte2 = $porc[1];

    $buscar   = '/';
    $posicion = strpos($parte2, $buscar);

    if ($posicion === false) {
        $pulg = number_format($parte2, 2);
    }else{
        $porc = explode("/", $parte2);
        $pulg = $porc[0] / $porc[1];
        $pulg = number_format($pulg, 2);
    }

    $pulg = $parte1 + $pulg;
     
}


if($pulg == ''){
    $pulg = 0;
}

echo $pulg;

$sumjet = 0;
$sumjpt = 2;

$ajt = $sumjet/$sumjpt;

echo 'Avance ' . $ajt;


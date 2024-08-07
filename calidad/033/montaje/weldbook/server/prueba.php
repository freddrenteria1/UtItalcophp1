<?php

$cadena = "RECHAZADA X";
$busq = "X";

$enc = strpos($cadena, $busq);

echo $enc;
echo '<br>';

if($enc !== false){
    echo 'Encontrado';
}
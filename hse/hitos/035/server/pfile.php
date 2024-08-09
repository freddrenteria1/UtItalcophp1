<?php
header('Content-type: application/json');
header('Content-type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');

$archivo = "pruebañ ción.pdf";

$docs[] = array(
    'doc'=>$archivo
);

//$docs[] = mb_convert_encoding($docs[], 'UTF-8', 'UTF-8');

 

$files = json_encode($docs, JSON_UNESCAPED_UNICODE);


echo $files;


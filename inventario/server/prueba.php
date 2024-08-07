<?php
header('Access-Control-Allow-Origin: *');
if (isset ($_SERVER['HTTP_REFERER'])) { 
    $url = $_SERVER['HTTP_REFERER']; 
    $web = 'https://utitalco.com/';
    $perm = strpos($url, $web);
    if($perm === false){
        echo 'Sin permisos...';
    } else {
        echo 'Permiso garantizado...';
    }
}else{
    echo 'Sin autorización';
}

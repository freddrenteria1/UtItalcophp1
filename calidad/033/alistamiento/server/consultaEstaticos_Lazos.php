<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta Lazos
$totalecp = 1;
$totalut = 2;

$cons = "SELECT * FROM osLazos";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;


$cons3 = "SELECT * FROM osLazos order by lazo";
$ejec3 = mysqli_query($conexion, $cons3);
$enc3 = mysqli_num_rows($ejec3);

while($row = mysqli_fetch_object($ejec3)){

    $lazo = $row->lazo;
    $tag = $row->isometrico;
    $item = $row->item;
    $sumfirma = 0;
    $sumfirmaec = 0;

    $cons4 = "SELECT * FROM osLazos WHERE isometrico = '$tag' AND item = $item";
    $ejec4 = mysqli_query($conexion, $cons4);

    while($obj = mysqli_fetch_object($ejec4)){

        if($obj->firmas != ""){
            $firmas =  json_decode($obj->firmas);
            if($firmas[0]->nombresup != ""){
                $firmasup='OK';
                $sumfirma++;
            }else{
                $firmasup='PTE';
            }
            if($firmas[0]->nombreq != ""){
                $firmaqaqc='OK';
                $sumfirma++;
            }else{
                $firmaqaqc='PTE';
            }
            if($firmas[0]->nombreecp != ""){
                $firmagestor='OK';
                $sumfirma++;
            }else{
                $firmagestor='PTE';
            }
        }else{
            $firmasup='PTE';
            $firmaqaqc='PTE';
            $firmagestor='PTE';
        }
         
         
    
    }

    $tagslazos[] = array(
        'lazo'=>$lazo,
        'tag'=>$tag,
        'item'=>$item,
        'firmasup'=>$firmasup,
        'firmaqaqc'=>$firmaqaqc,
        'firmagestor'=>$firmagestor,
        'totalfirmasutplan'=>$totalut,
        'totalfirmasecpplan'=>$totalecp,
        'totalfirmasplan'=>$totalut + $totalecp,
        'totalfirmaseje'=>$sumfirma,
        'firmasfaltantes'=>($totalut + $totalecp)-($sumfirma)
    );

}

$datos = array(
    'lazos'=>$tagslazos
);

echo json_encode($datos);
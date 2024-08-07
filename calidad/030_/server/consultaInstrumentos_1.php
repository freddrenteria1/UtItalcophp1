<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

//consulta intercambiadores os91
$totalinterecp = 2;
$totalinterut = 4;

$cons = "SELECT * FROM os91";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$cantintercambiadores = $cant;

$totalinter = $totalinter * $cant;

$sumfirmaut = 0;
$sumfirmaec = 0;

$cons = "SELECT * FROM os91";
$ejec = mysqli_query($conexion, $cons);
$cant = mysqli_num_rows($ejec);

$totalinterecp = $totalinterecp * $cant;
$totalinterut = $totalinterut * $cant;

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
            if($estadoinicial[0]->nombreec != ""){
                $sumfirmaec++;
            }
        }
        
     
    
    }

    $tagsinter[] = array(
        'tag'=>$tag,
        'totalfirmasutplan'=>$totalinterut1,
        'totalfirmasecpplan'=>$totalinterecp1,
        'totalfimasuteje'=>$sumfirmaut,
        'totalfirmaseceje'=> $sumfirmaec,
        'totalfirmasplan'=>$totalinterut1 + $totalinterecp1,
        'totalfirmaseje'=>$sumfirmaut + $sumfirmaec,
        'firmasfaltantes'=>($totalinterut1 + $totalinterecp1)-($sumfirmaut+$sumfirmaec)
    );

}

$datos = array(
    'tablas'=>$tablasFinal,
    'totales'=>$totales
);

echo json_encode($datos);
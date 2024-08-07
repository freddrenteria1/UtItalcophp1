<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();


$cons = "SELECT * FROM sumasValvulas  order by fecha";
$ejec = mysqli_query($conexion, $cons);

while($obj = mysqli_fetch_object($ejec)){

    $porc = round(($obj->firmasEje / $obj->firmasPlan) * 100);

    $hitos[] = array(
        'fecha'=>$obj->fecha,
        'firmasPlan'=>$obj->firmasPlan,
        'firmasEje'=>$obj->firmasEje,
        'porc'=>$porc
    );

}

echo json_encode($hitos);

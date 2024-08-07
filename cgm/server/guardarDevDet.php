<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$num = $_POST["num"];
$items = json_decode($_POST["items"]);

$cantreg = count($items);

$msn = 'Ok';

for($i=0; $i<$cantreg; $i++){

    $item = $items[$i]->item;
    $deta = $items[$i]->deta;
    $descripcion = $items[$i]->descripcion;
    $cm = $items[$i]->cm;
    $reserva = $items[$i]->reserva;
    $posres = $items[$i]->posres;
    $numdoc = $items[$i]->numdoc;
    $ubicatec = $items[$i]->ubicatec;
    $cantdev = $items[$i]->cantdev;
    $unidad = $items[$i]->unidad;
    
    $sql="INSERT INTO detallesdev VALUES('', $num, '$fecha', $item, '$descripcion', '$cm', '$reserva', $posres, '$numdoc', '$ubicatec', '$unidad', $cantdev)";

    $exito=mysqli_query($conexion, $sql);

    if(!$exito){
        $msn = mysqli_error($conexion);
    }

    
}


$datos = array(
    'msn'=>$msn,
    'cantreg'=>$cantreg
);

echo json_encode($datos);
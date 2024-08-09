<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$num = $_POST["num"];
$fecha = $_POST["fecha"];
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
    $ordenmtto = $items[$i]->ordenmtto;
    $numdoc = $items[$i]->numdoc;
    $equipo = $items[$i]->equipo;
    $cantreq = $items[$i]->cantreq;
    $cantrec = $items[$i]->cantrec;
    $saldo = $items[$i]->saldo;
    $unidad = $items[$i]->unidad;
    $obsadicional = $items[$i]->obsadicional;
    $fechareserva = $items[$i]->fechareserva;
    
    $sql="INSERT INTO detallesent VALUES('', $num, '$fecha', '$fechareserva', $item, '$descripcion', '$cm', '$reserva', $posres, '$ordenmtto', '$equipo', $cantreq, $cantrec, $saldo, '$unidad', '$obsadicional','$numdoc')";

    $exito=mysqli_query($conexion, $sql);

    if(!$exito){
        $msn = mysqli_error($conexion);
    }

    $query = "UPDATE bdmateriales SET documento = '$numdoc' WHERE cm = '$cm' AND reserva = '$reserva' AND posres = '$posres'";
    $eje = mysqli_query($conexion, $query);
    
}


$datos = array(
    'msn'=>$msn,
    'cantreg'=>$cantreg
);

echo json_encode($datos);
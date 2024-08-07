<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$almacen = 'Consumibles';
$ubicacion = $_POST["ubicacion"];

// $ods = '021';
// $almacen = 'Consumibles';
// $ubicacion = 'HDT 4700 PARADA TECNICA';

$ubialm = $almacen . ' ODS ' . $ods . ' ' . $ubicacion;

$alm = 'AC'.$ods.$ubicacion;


$buscari2 = "SELECT * FROM  traslados Where origen = '$ubialm'";
$ejeb2 = mysqli_query($conexion, $buscari2);

while($row = mysqli_fetch_object($ejeb2)){

    $items = json_decode($row->items);

    $cantitems = count($items);

    for($i=0; $i<$cantitems; $i++){
        $itemsTS[] = array(
            'cod'=>$items[$i]->cod,
            'cant'=>$items[$i]->cant,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }

}

$buscari2 = "SELECT * FROM  traslados Where ods = '$ods' AND almacen = 'Consumibles'  AND ubicacion='$ubicacion'";
$ejeb2 = mysqli_query($conexion, $buscari2);

while($row = mysqli_fetch_object($ejeb2)){

    $items = json_decode($row->items);

    $cantitems = count($items);

    for($i=0; $i<$cantitems; $i++){
        $itemsTE[] = array(
            'cod'=>$items[$i]->cod,
            'cant'=>$items[$i]->cant,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}

$buscari3 = "SELECT * FROM  entradaconsumibles Where ods = '$ods' AND ubicacion='$ubicacion'";
$ejeb3 = mysqli_query($conexion, $buscari3);

while($row = mysqli_fetch_object($ejeb3)){

    $items = json_decode($row->items);

    $cantitems = count($items);

    for($i=0; $i<$cantitems; $i++){
        $itemsEnt[] = array(
            'cod'=>$items[$i]->cod,
            'cant'=>$items[$i]->cant,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}

$buscari3 = "SELECT * FROM  salidaconsumibles Where ods = '$ods' AND ubicacion='$ubicacion'";
$ejeb3 = mysqli_query($conexion, $buscari3);

while($row = mysqli_fetch_object($ejeb3)){

    $items = json_decode($row->items);

    $cantitems = count($items);

    for($i=0; $i<$cantitems; $i++){
        $itemsSal[] = array(
            'cod'=>$items[$i]->cod,
            'cant'=>$items[$i]->cant,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item
        );
    }
}


$sql = "SELECT * FROM inventario Where ubicacion='$alm' order by articulo";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    if($obj->codtipo != '03' && $obj->clase != 'SERVICIO DE ALQUILER'){

        $codart = $obj->codigo;

        $cantitems = count($itemsTS);
        $cantTS = 0;

        for($i=0; $i<$cantitems; $i++){
            
            if($itemsTS[$i]["cod"] == $codart){
                $cantTS += $itemsTS[$i]["cant"];
            }
        }

        $cantitems = count($itemsTE);
        $cantTE = 0;


        for($i=0; $i<$cantitems; $i++){
            
            if($itemsTE[$i]["cod"] == $codart){
                $cantTE += $itemsTE[$i]["cant"];
            }
        }

        $cantitems = count($itemsEnt);
        $cantEnt = 0;


        for($i=0; $i<$cantitems; $i++){
            
            if($itemsEnt[$i]["cod"] == $codart){
                $cantEnt += $itemsEnt[$i]["cant"];
            }
        }

        $cantitems = count($itemsSal);
        $cantSal = 0;


        for($i=0; $i<$cantitems; $i++){
            
            if($itemsSal[$i]["cod"] == $codart){
                $cantSal += $itemsSal[$i]["cant"];
            }
        }


        
       

        $datos[] = array(
            'id'=>$obj->id,
            'codigo'=>$obj->codigo,
            'unidad'=>$obj->unidad,
            'cantidad'=>$obj->cantidad,
            'articulo'=>$obj->articulo,
            'trasS'=>$cantTS,
            'trasE'=>$cantTE,
            'entradas'=>$cantEnt,
            'salidas'=>$cantSal
        );
    }
}

echo json_encode($datos);
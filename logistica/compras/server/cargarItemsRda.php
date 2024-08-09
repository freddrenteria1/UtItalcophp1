<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM rda Where estado='Aprobado'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $items = json_decode($obj->items);
    $cant = count($items);

    for($i = 0; $i<$cant; $i++){
        
            $coditem = $items[$i]->cod;
            $numrda = $obj->id;

            $query = "SELECT * FROM compras Where estado != 'Anulado'";
            $eje = mysqli_query($conexion, $query);

            $cantcomprado = 0;

            while($fila = mysqli_fetch_object($eje)){

                $itemscompras = json_decode($fila->items);
                $cantcompra = count($itemscompras);

                

                for($b = 0; $b<$cantcompra; $b++){

                    if($itemscompras[$b]->cod == $coditem && intval($itemscompras[$b]->rda) == $numrda){
                        $cantcomprado += $itemscompras[$b]->cant;
                        // echo 'Codigo item desde RDA' . $coditem . ' Rda ' . $numrda .'<br>';
                        // echo 'Codigo item desde COMPRAS ' . $itemscompras[$b]->cod . ' Rda ' . $itemscompras[$b]->rda . ' #COMPRA ' .  $fila->id . '<br>';
                    }

                }
                
            }

            $cantnueva = $items[$i]->cant-$cantcomprado;

            if($cantnueva > 0){
                $datos[] = array(
                    'cant'=>$cantnueva,
                    'cod'=>$items[$i]->cod,
                    'unidad'=>$items[$i]->unidad,
                    'item'=>$items[$i]->item,
                    'det'=>$items[$i]->det,
                    'rda'=>$obj->id,
                    'ods'=>$obj->ods
                ); 
            }  

    }
    
}

echo json_encode($datos);
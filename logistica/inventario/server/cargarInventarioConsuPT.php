<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query1 = "SELECT * FROM inventario Where codtipo != '03' And clase != 'SERVICIO DE ALQUILER'";
$eje1 = mysqli_query($conexion, $query1);

while($row = mysqli_fetch_object($eje1)){

    $inventario[] = array(
        'id'=>$row->id,
        'codigo'=>$row->codigo,
        'unidad'=>$row->unidad,
        'articulo'=>$row->articulo,
        'ubicacion'=>$row->ubicacion,
        'cant'=>$row->cantidad
    );

}

$query = "SELECT * FROM inventario Where codtipo != '03' And clase != 'SERVICIO DE ALQUILER' Group by codigo  ORDER BY articulo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $coditem = $obj->codigo;
    $totalinv = 0;

    // echo 'cod ' . $coditem;
    // echo '<br>';

    $inv[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'ubicacion'=>$obj->ubicacion,
        'articulo'=>$obj->articulo
    );

}


$sql = "SELECT * FROM almacenes WHERE estado = 'Activo'";
$ejes = mysqli_query($conexion, $sql);

$ubicaciones[] = array(
    'almacen'=>'AP'
);

while($fila = mysqli_fetch_object($ejes)){
    $tipo = $fila->almacen;
    $odsalm = $fila->ods;
    $ubica = $fila->ubicacion;

    // echo $ubica;
    // echo '<br>';

    if($tipo ==  'Consumibles'){
        $almc =  'AC'.$odsalm.$ubica;
        $ubicaciones[] = array(
            'almacen'=>$almc
        );
    }
   

}


$cantcod = COUNT($inv);
$cantalm = COUNT($ubicaciones);
$cantinv = COUNT($inventario);

// echo 'Cantidad inv ' . $cantinv;
// echo '<br>';
 
for($a = 0; $a < $cantcod; $a++){
    
    $coditem =  $inv[$a]["codigo"];
    unset($itemsubi);
    $total = 0;
    $totalinv =0;

    for($i = 0; $i < $cantalm; $i++){

        $ubi =  $ubicaciones[$i]["almacen"];

        $cante=0;

        for($b = 0; $b < $cantinv; $b++){

            if($inventario[$b]["codigo"]==$coditem && $inventario[$b]["ubicacion"]==$ubi){
                $cante = $inventario[$b]["cant"];
            }

        }         

        $itemsubi[] = array(
            'ubicacion'=>$ubi,
            'cant'=>$cante
        );

        $totalinv += $cante;

        // echo 'cod: '.  $coditem  .  ' | Cant: ' . $cante .  ' | Alm: ' . $ubi;
        // echo '<br>';
         
    }
 

    $total = $totalinv;

    $datos[] = array(
        'id'=>$inv[$a]["id"],
        'codigo'=>$inv[$a]["codigo"],
        'unidad'=>$inv[$a]["unidad"],
        'articulo'=>$inv[$a]["articulo"],
        'ubicaciones'=>$itemsubi,
        'total'=>$total
    );
    
}

echo json_encode($datos);
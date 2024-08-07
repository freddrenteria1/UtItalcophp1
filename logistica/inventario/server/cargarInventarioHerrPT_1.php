<?php
// header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM inventario Where codtipo = '03' Or clase = 'SERVICIO DE ALQUILER' Group by codigo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $coditem = $obj->codigo;
    $totalinv = 0;

    $inv[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'articulo'=>$obj->articulo
    );

}

$sql = "SELECT * FROM almacenes WHERE estado = 'Activo'";
$ejes = mysqli_query($conexion, $sql);

$ubicaciones[] = array(
    'almacen'=>'AP';
);

while($fila = mysqli_fetch_object($ejes)){
    $tipo = $fila->almacen;
    $odsalm = $fila->ods;
    $ubica = $fila->ubicacion;

    if($tipo ==  'Herramientas'){
        $almc =  'AH'.$odsalm.$ubica;
        $ubicaciones[] = array(
            'almacen'=>$almc;
        );
    }
   

}


    //unset($itemsubi);

    $cantalm = COUNT($ubicaciones);

    for($i = 0, $i <= $cantalm; $i++){
        echo $ubicaciones[$i]["almacen"];
    }



// echo json_encode($datos);
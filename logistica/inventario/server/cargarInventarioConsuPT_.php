<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM inventario Where codtipo != '03' And clase != 'SERVICIO DE ALQUILER' Group by codigo  ORDER BY articulo";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $coditem = $obj->codigo;
    $totalinv = 0;

    unset($itemsubi);

    //BUSCO EL ITEM EN CADA UBICACION

    $cons = "SELECT * FROM inventario Where codtipo != '03' And clase != 'SERVICIO DE ALQUILER' GROUP BY ubicacion";
    $ejec = mysqli_query($conexion, $cons);

    while($rowu = mysqli_fetch_object($ejec)){

        $ubi = $rowu->ubicacion;

        $buscari = "SELECT * FROM  inventario Where codigo = '$coditem' And ubicacion = '$ubi'";
        $ejeb = mysqli_query($conexion, $buscari);

        $encb = mysqli_num_rows($ejeb);

        if($encb > 0){
            $filab = mysqli_fetch_object($ejeb);
            $cante = $filab->cantidad;
        }else{
            $cante = 0;
        }

        $itemsubi[] = array(
            'ubicacion'=>$ubi,
            'cant'=>$cante
        );

        $totalinv += $cante;
    }
  

    $total = $totalinv;

    $datos[] = array(
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'unidad'=>$obj->unidad,
        'articulo'=>$obj->articulo,
        'ubicaciones'=>$itemsubi,
        'total'=>$total
    );

}

echo json_encode($datos);
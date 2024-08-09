<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql = "SELECT * FROM inventario Where ubicacion='AP' And codtipo != '03'  order by articulo";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $codtipo = $obj->codtipo;
    $codclase = $obj->codclase;
    $codigo = $obj->codigo;
    
    $ex = $codtipo.$codclase;

    if($ex != '0405'){

        $datos[] = array(
            'id'=>$obj->id,
            'codigo'=>$obj->codigo,
            'unidad'=>$obj->unidad,
            'cantidad'=>$obj->cantidad,
            'articulo'=>$obj->articulo
        );
    }
}

echo json_encode($datos);
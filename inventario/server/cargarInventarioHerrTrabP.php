<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM invplanta Where almacen = 'Herramientas' and cant > 0 Order by ced";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $ced = $obj->ced;
    $codigo = $obj->codigo;

    $sql2 = "SELECT * FROM trabajadores WHERE cedula = '$ced'";
    $cons2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_object($cons2);
    
    $cargo = $row2->cargo;

    $sql = "SELECT * FROM items WHERE codigo = '$codigo'";
    $cons = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($cons);

    $clase = $row->clase;
    $tipo = $row->tipo;

    $datos[] = array(
        'id'=>$obj->id,
        'ced'=>$obj->ced,
        'nombres'=>$obj->nombres,
        'cargo'=>$cargo,
        'cod'=>$obj->codigo,
        'articulo'=>$obj->articulo,
        'cant'=>$obj->cant,
        'ods'=>$obj->ods,
        'ubicacion'=>$obj->ubicacion,
        'tipo'=>$tipo,
        'clase'=>$clase
    );

}

$query = "SELECT * FROM invactivos Where cant > 0 Order by ced";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $ced = $obj->ced;
    $codigo = $obj->codigo;

    $sql2 = "SELECT * FROM trabajadores WHERE cedula = '$ced'";
    $cons2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_object($cons2);
    
    $cargo = $row2->cargo;

    $codigo = $items[$i]->cod;

    $sql = "SELECT * FROM items WHERE codigo = '$codigo'";
    $cons = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($cons);

    $clase = $row->clase;
    $tipo = $row->tipo;

    $datos[] = array(
        'id'=>$obj->id,
        'ced'=>$obj->ced,
        'nombres'=>$obj->nombres,
        'cargo'=>$cargo,
        'cod'=>$obj->codigo,
        'articulo'=>$obj->articulo,
        'cant'=>$obj->cant,
        'ods'=>$obj->ods,
        'ubicacion'=>'LOGISTICA CENTRAL',
        'tipo'=>$tipo,
        'clase'=>$clase
    );

}

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM salidaconsumibles order by fecha DESC";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $nombres = $obj->nombres;
    $ced = $obj->ced;

    $items = json_decode($obj->items);
    $fecha = $obj->fecha;
    $cant = count($items);

    $sql2 = "SELECT * FROM trabajadores WHERE cedula = '$ced'";
    $cons2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_object($cons2);
    
    $cargo = $row2->cargo;
   

    for($i=0; $i<$cant; $i++){

        $codigo = $items[$i]->cod;

        $sql = "SELECT * FROM items WHERE codigo = '$codigo'";
        $cons = mysqli_query($conexion, $sql);
        $row = mysqli_fetch_object($cons);

        $clase = $row->clase;
        $tipo = $row->tipo;

        $user = $obj->user;

        // $buscar = "SELECT * FROM usuarioslogistica WHERE email = '$user'";
        // $conb = mysqli_query($conexion, $buscar);

        // $filab = mysqli_fetch_object($consb);

        // $entregado = $filab->nombres;

        $datos[] = array(
            'nombres'=>$nombres,
            'ced'=>$ced,
            'cargo'=>$cargo,
            'ods'=>$obj->ods,
            'ubicacion'=>$obj->ubicacion,
            'fecha'=>$fecha,
            'cant'=>$items[$i]->cant,
            'cod'=>$items[$i]->cod,
            'unidad'=>$items[$i]->unidad,
            'item'=>$items[$i]->item,
            'tipo'=>$tipo,
            'clase'=>$clase,
            'entregado'=>$user
        );
    }
}




echo json_encode($datos);
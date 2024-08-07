<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$inicio = $_POST["inicio"];
$fin = $_POST["fin"];

// $ods = '031';
// $inicio = '2023-10-01';
// $fin = '2023-10-26';

$sqlb = "TRUNCATE TABLE `consutemp`";
$ejesb =  mysqli_query($conexion, $sqlb);

$query = "SELECT * FROM salidaconsumibles WHERE fecha BETWEEN '$inicio'  AND '$fin' AND ods = '$ods' GROUP BY ced";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $nombres = $obj->nombres;
    $ced = $obj->ced;

    $sql2 = "SELECT * FROM trabajadores WHERE cedula = '$ced'";
    $cons2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_object($cons2);
    
    $cargo = $row2->cargo;


    $query2 = "SELECT * FROM salidaconsumibles WHERE fecha BETWEEN '$inicio'  AND '$fin' AND ced = '$ced' AND  ods = '$ods'";
    $eje2 = mysqli_query($conexion, $query2);

    while($fila = mysqli_fetch_object($eje2)){

        $items = json_decode($fila->items);
        $fecha = $fila->fecha;
        $cant = count($items);

        $supervisor = $fila->supervisor;
        $frente = $fila->frente;
   

        for($i=0; $i<$cant; $i++){

            $codigo = $items[$i]->cod;

            $sql = "SELECT * FROM items WHERE codigo = '$codigo'";
            $cons = mysqli_query($conexion, $sql);
            $row = mysqli_fetch_object($cons);

            $clase = $row->clase;
            $tipo = $row->tipo;

            //  $clase = '';
            // $tipo = '';

            $user = $fila->user;

            $buscar = "SELECT * FROM usuarioslogistica WHERE email = '$user'";
            $conb = mysqli_query($conexion, $buscar);
            $filab = mysqli_fetch_object($conb);
            $entregado = $filab->nombres;            

            $ubicacion = $fila->ubicacion;
            $cant = $items[$i]->cant;
            $cod = $items[$i]->cod;
            $unidad = $items[$i]->unidad;
            $item = $items[$i]->item;


            $det[] = array(
                'nombres'=>$nombres,
                'ced'=>$ced,
                'cargo'=>$cargo,
                'ods'=>$obj->ods,
                'ubicacion'=>$fila->ubicacion,
                'fecha'=>$fecha,
                'supervisor'=>$supervisor,
                'frente'=>$frente,
                'cant'=>$items[$i]->cant,
                'cod'=>$items[$i]->cod,
                'unidad'=>$items[$i]->unidad,
                'item'=>$items[$i]->item,
                'tipo'=>$tipo,
                'clase'=>$clase,
                'entregado'=>$entregado
            );

            $sqltmp = "INSERT INTO consutemp VALUES('', '$nombres', '$ced', '$cargo', '$ods', '$ubicacion', '$fecha', $cant, '$cod', '$unidad', '$item', '$entregado')";
            $ejetmp = mysqli_query($conexion, $sqltmp);


        }
    }
}

$query = "SELECT *, SUM(cant) AS totitems FROM consutemp WHERE fecha BETWEEN '$inicio'  AND '$fin' AND ods = '$ods' GROUP BY ced";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'nombres'=>$obj->nombres,
        'ced'=>$obj->ced,
        'cargo'=>$obj->cargo,
        'ods'=>$obj->ods,
        'cant'=>$obj->totitems,
    );
}

$info = array(
    'det'=>$det,
    'datos'=>$datos
);

echo json_encode($info);
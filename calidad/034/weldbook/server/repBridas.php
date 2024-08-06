<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$buscar = "SELECT *, COUNT(*) as tot FROM masterbridas GROUP BY especialidad";
$ejeb = mysqli_query($conexion, $buscar);

while($row = mysqli_fetch_object($ejeb)){

    $esp = $row->especialidad;

    $bridas[] = array(
        'especialidad'=>$row->especialidad,
        'cant'=>$row->tot
    );

    $sql = "SELECT *, COUNT(*) as tot FROM masterbridas WHERE especialidad='$esp' GROUP BY linea";
    $eje = mysqli_query($conexion, $sql);

    while($obj = mysqli_fetch_object($eje)){

        $linea = $obj->linea;

        $query = "SELECT *, COUNT(*) as tot FROM masterbridas WHERE especialidad='$esp' and linea = '$linea' and ajustetorque != '' GROUP BY especialidad, linea";
        $ejeq = mysqli_query($conexion, $query);

        $cant = mysqli_num_rows($ejeq);

        if($cant != 0){

            $fila = mysqli_fetch_object($ejeq);
            $ejec = $fila->tot;
        }else{
            $ejec = 0;
        }

        $total = intval($obj->tot);
        $ejec = intval($ejec);

        $avance = round(($ejec/$total)*100);


        $sumbridas[] = array(
            'especialidad'=>$obj->especialidad,
            'linea'=>$obj->linea,
            'cant'=>intval($obj->tot),
            'eje'=>intval($ejec),
            'avance'=>$avance
        );

    }



}

 

echo json_encode($sumbridas);   
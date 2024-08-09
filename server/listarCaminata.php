<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO



    $sql="SELECT * FROM caminata WHERE ods = '$ods' order by semana DESC";
    $exito=mysqli_query($conexion, $sql);

    

    while ($row = mysqli_fetch_object($exito)){

        $semana = $row->semana;

        $buscar="SELECT * FROM semanas WHERE semana = $semana";
        $eje=mysqli_query($conexion, $buscar);

        $fila = mysqli_fetch_object($eje);

        $finicio = $fila->inicio;
        $ffin = $fila->fin;

        $fechas = 'Semana ' . $semana . ': ' . $finicio . ' al ' . $ffin;

        $datos[] = array(
            'id' => $row->id,
            'item' => $row->item,
            'resp'=>$row->resp,
            'semana'=>$fechas,
            'prog'=>$row->prog,
            'eje'=>$row->eje,
            'oportunidad'=>$row->oportunidad,
            'plan'=>$row->plan,
            'fcierre'=>$row->fcierre,
            'ods'=>$row->ods
        );

    }  

echo json_encode($datos);
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

    $sql="SELECT * FROM ods";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){

        $datos[] = array(
            'id' => $row->id,
            'contrato'=>$row->contrato,
            'numods'=>$row->numods,
            'ods'=>$row->ods,
            'estado'=>$row->estado,
            'fechaip'=>$row->fecha_i_p,
            'fechair'=>$row->fecha_i_r,
            'fechafp'=>$row->fecha_f_p,
            'fechafr'=>$row->fecha_f_r
        );

    }  

echo json_encode($datos);
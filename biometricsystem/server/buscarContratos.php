<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$per = 2021;


$query = "SELECT * FROM contratos Where YEAR(finicio) = $per GROUP BY documento";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){

    $doc = $row->documento;

    $sql = "SELECT * FROM contratos WHERE documento = '$doc' AND YEAR(finicio) = $per";
    $cons = mysqli_query($conexion, $sql);

    $dias = 0;

    while($obj =  mysqli_fetch_object($cons)){

        $inicio =$obj->finicio;
        $fin = $obj->ffin;

        $datetime1 = date_create($inicio);
        $datetime2 = date_create($fin);

        $contador = date_diff($datetime2, $datetime1);

        //$dias += $contador;

        $differenceFormat = '%a';

        $dias += $contador->format($differenceFormat);

        $contratos = $obj->contrato . ' - '  . $obj->finicio . ' - '  . $obj->ffin  . ' - '  .  $obj->cargo . ' - '  . $obj->tipo  . ' <br>';
        
    }

    $datos[] = array(
        'doc'=>$row->documento,
        'nombres'=>$row->nombres .  ' ' . $row->apellidos,
        'doc'=>$row->documento,
        'contratos'=>$contratos,
        'dias'=>$dias
        
    );


}

echo json_encode($datos);
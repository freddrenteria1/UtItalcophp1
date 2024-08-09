<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


// $fecha = '31/03/2021';

//$hito = $_POST["hito"];
$ods = $_POST["ods"];


//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM incidentes WHERE ods = '$ods'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $item = $row->item;

    $query = "SELECT * FROM fotosincidentes Where item = '$item' AND ods = '$ods'";
    $eje = mysqli_query($conexion, $query);

    $cant = mysqli_num_rows($eje);

    if($cant != 0){
        $obj = mysqli_fetch_object($eje);
        $soporte  = $obj->foto;
    }else{
        $soporte = '';
    }

    $porcinci += intval($row->avance);
    $cantinci++;

    $porc = $porcinci/$cantinci;

    $datos[] = array(
        'id' => $row->id,
        'item'=>$row->item,
        'fecha'=>$row->fecha,
        'detalles'=>$row->detalles,
        'reporta'=>$row->reporta,
        'criticidad'=>$row->criticidad,
        'tipificacion'=>$row->tipificacion,
        'categoria'=>$row->categoria,
        'valoracion'=>$row->valoracion,
        'estado'=>$row->estado,
        'avance'=>$row->avance,
        'soporte'=>$soporte,
        'porc'=>$porc
    );

} 

echo json_encode($datos);
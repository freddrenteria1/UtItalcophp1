<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechai = $_POST["fechai"];
$fechaf = $_POST["fechaf"];
$ods = $_POST["ods"];

// $fechai = '2021-04-11';
// $fechaf = '2021-06-28';
// $ods = '016';

$sql="SELECT * FROM conversatorios WHERE (fecha between '$fechai' AND '$fechaf')";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id' => $row->id,
        'fecha'=>$row->fecha,
        'tema'=>$row->tema,
        'resp'=>$row->resp,
        'ods'=>$row->ods
    );

} 

for($i = 0; $i < count($datos); ++$i){
    if($datos[$i]['ods']==$ods){
        $data[] = array(
            'id' => $datos[$i]['id'],   
            'fecha'=>$datos[$i]['fecha'],
            'tema'=>$datos[$i]['tema'],
            'resp'=>$datos[$i]['resp'],
            'ods'=>$datos[$i]['ods']
        );
    }
}
echo json_encode($data);
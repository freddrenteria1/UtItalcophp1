<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
//$ods = 'ODS 020';

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$sql="SELECT * FROM junta Where ods='$ods' group by sk";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $sk[] = array(
        'sk' => $row->sk
    );

} 


$sql="SELECT * FROM junta Where ods='$ods'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $juntas[] = array(
        'id' => $row->id,
        'ods' => $row->ods,
        'sk' => $row->sk,
        'numjunta' => $row->juntanum,
        'pulgadas' => $row->pulgadas,
        'detjunta1' => $row->descjunta1,
        'detjunta2' => $row->descjunta2,
        'proceso' => $row->procsold,
        'mataporte' => $row->mataporte
    );

}  

$datos = array(
    'sk'=>$sk,
    'juntas'=>$juntas
);

echo json_encode($datos);
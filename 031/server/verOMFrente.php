<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$frente = $_POST["frente"];
$semana = $_POST["semana"];

$sql="SELECT * FROM ordenmant WHERE frente = '$frente' AND semana = '$semana' GROUP BY numom order by numom DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $om[] = array(
        'id'=>$obj->id,
        'frente'=>$obj->frente,
        'semana'=>$obj->semana,
        'om'=>$obj->numom
    );

}




echo json_encode($om);
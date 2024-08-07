<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os94 WHERE ods='$ods' AND tag  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'especialidad'=>$obj->especialidad,
        'tag'=>$obj->tag,
        'estadoinicial'=>$obj->estadoinicial,
        'datosini'=>$obj->datosini,
        'firmasini'=>$obj->firmasini,
        'estadofinal'=>$obj->estadofinal,
        'datosfin'=>$obj->datosfin,
        'firmasfin'=>$obj->firmasfin,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);
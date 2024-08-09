<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = '015';
// $fecha = '31/03/2021';

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
//$ods='015';

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql1="SELECT * FROM aseguramientos WHERE ods='$ods' AND criticidad = 'N/A'";
$exito=mysqli_query($conexion, $sql1);
$totalacs = mysqli_num_rows($exito);

$sql="SELECT * FROM aseguramientos WHERE ods='$ods' AND criticidad != 'N/A'";
$eje=mysqli_query($conexion, $sql);

$totalacr = mysqli_num_rows($eje);

    $datos = array(
        'totacs'=>$totalacs,
        'totacr'=>$totalacr
    );

echo json_encode($datos);
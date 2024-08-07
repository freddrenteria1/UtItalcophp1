<?php 
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php");
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fechaAct=date("Y-m-d");

$query = "SELECT * FROM personalitalco";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $doc = $obj->doc;

    $sel="SELECT * FROM testcovidpcr Where doc='$doc'";
    $busq=mysqli_query($conexion, $sel);
    $cont=mysqli_num_rows($busq);   

    if ($cont==0){
        $datos[] = array(
            'nombres'=>$obj->nombres,
            'doc'=>$obj->doc,
            'cel'=>$obj->cel,
            'cargo'=>$obj->cargo,
            'ods'=>$obj->ods
        );
    }
}


echo json_encode($datos);
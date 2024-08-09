<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$nit = $_POST["nit"];
$rep = $_POST["rep"];
$gerente = $_POST["gerente"];
$id = $_POST["id"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="UPDATE corporativo SET nit = '$nit', representante = '$rep', gerente = '$gerente' Where id=$id";
$exito=mysqli_query($conexion, $sql);

$sql="SELECT * FROM corporativo";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos = array(
        'id' => $row->id,
        'empresa'=>$row->empresa,
        'nit'=>$row->nit,
        'representante'=>$row->representante,
        'gerente'=>$row->gerente
    );

}  

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

// $ods = '16';
// $fecha = '2021-05-07';

$sql="SELECT * FROM personalotra";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $ced = $row->cedula;

    $query = "SELECT * FROM personalturnos Where cedula='$ced' order by fecha DESC limit 1";
    $cons = mysqli_query($conexion, $query);
    $enc = mysqli_num_rows($cons);

    if($enc != 0){

        $fila = mysqli_fetch_object($cons);
        $turno = $fila->turno;

        $sql2 = "SELECT * FROM codturnos Where turno='$turno'";
        $eje2 = mysqli_query($conexion, $sql2);
        $fila3 = mysqli_fetch_object($eje2);

        $inicio = $fila3->entrada;
        $salida = $fila3->salida;

        $buscar = "UPDATE personalotra SET turno='$turno', entrada='$inicio', salida='$salida' Where cedula='$ced'";
        $eje = mysqli_query($conexion, $buscar);
        
    }


}
 

echo json_encode($datos);
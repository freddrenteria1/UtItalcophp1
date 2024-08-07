<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$totactcorr = $_POST["totactcorr"];
$totactnocorr = $_POST["totactnocorr"];
$totpascorr = $_POST["totpascorr"];
$totpasnocorr = $_POST["totpasnocorr"];
$totpat = $_POST["totpat"];
$toting = $_POST["toting"];
$totgastos = $_POST["totgastos"];
$totcostos = $_POST["totcostos"];
$totutilneta = $_POST["totutilneta"];

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM infofinanciera WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO infofinanciera VALUES('', '$user', $totactcorr, $totactnocorr, $totpascorr, $totpasnocorr, $totpat, $toting, $totgastos, $totcostos, $totutilneta)";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "UPDATE infofinanciera SET activoscorr = $totactcorr, activosnocorr = $totactnocorr, pasivocorr = $totpascorr, pasivonocorr = $totpasnocorr, patrimonio = $totpat, ingresos = $toting, gastos = $totgastos, costos = $totcostos, utilidad = $totutilneta WHERE user='$user'";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
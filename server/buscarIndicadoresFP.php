<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$ods = substr($ods, 4);

$sql="SELECT * FROM conversatorios WHERE ods like  '%$ods%' AND fecha<='$fecha'";
$exito=mysqli_query($conexion, $sql);
$totconversatorios = mysqli_num_rows($exito);

$sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND origen = 'ITALCO'";
$exito=mysqli_query($conexion, $sql);
$totacitalco = mysqli_num_rows($exito);

$sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND criticidad != 'N/A'";
$exito=mysqli_query($conexion, $sql);
$totacriesgo = mysqli_num_rows($exito);

$sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND origen = 'ECOPETROL'";
$exito=mysqli_query($conexion, $sql);
$totacclientes = mysqli_num_rows($exito);

    $sql="SELECT * FROM hallazgos WHERE ods like  '%$ods%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $tothallazgos = mysqli_num_rows($exito);

    $sql="SELECT * FROM auditorias WHERE ods like  '%$ods%' GROUP BY fecha, auditoria, auditor";
    $exito=mysqli_query($conexion, $sql);
    $totauditorias = mysqli_num_rows($exito);

    $cantinsp = 0;
    $sql="SELECT * FROM inspecciones WHERE ods like  '%$ods%'";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        $cantinsp += $row->cant;
    }

    $totinsp = $cantinsp;

    $cantrct = 0;

    $sql="SELECT * FROM rct WHERE ods like  '%$ods%'";
    $exito=mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_object($exito)){
        $cantrct += $row->eje;
    }

    $totrct = $cantrct;

    $cantcam = 0;

    $sql="SELECT * FROM caminata WHERE ods like  '%$ods%'";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){
        $cantcam += $row->eje;
    }

    $totcam = $cantcam;
    $totac = $totacitalco + $totaccliente;


    $datos = array(
        'totconversatorios'=>$totconversatorios,
        'totacitalco'=>$totacitalco,
        'totaccliente'=>$totaccliente,
        'totac'=>$totac,
        'tothallazgos'=>$tothallazgos,
        'totauditorias'=>$totauditorias,
        'totinsp'=>$totinsp,
        'totrct'=>$totrct,
        'totcam'=>$totcam
    );


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = '017';
$fecha = '2021-05-19';

//$hito = $_POST["hito"];
// $ods = $_POST["ods"];
// $fecha = $_POST["fecha"];


    //se busca en que semana estamos
    $sql="SELECT * FROM semanas WHERE ods='$ods' AND inicio<='$fecha' AND fin>='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($exito);

    $semana = $row->semana;

    $sql="SELECT * FROM conversatorios WHERE ods='$ods' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $totconversatorios = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE ods='$ods' AND fechaevento<='$fecha' AND criticidad = 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE ods='$ods' AND fechaevento<='$fecha' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgo = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientoseco WHERE ods='$ods' AND fechaevento<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientes = mysqli_num_rows($exito);

    $totaccliente = $totacclientes + $totacriesgo;

    $sql="SELECT * FROM hallazgos WHERE ods='$ods' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $tothallazgos = mysqli_num_rows($exito);

    $sql="SELECT * FROM auditorias WHERE ods='015' GROUP BY fecha, auditoria";
    $exito=mysqli_query($conexion, $sql);
    $totauditorias = mysqli_num_rows($exito);

    $cantinsp = 0;
    $sql="SELECT * FROM inspecciones WHERE ods='015'";
    $exito=mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_object($exito)){
        $cantinsp += $row->cant;
    }

    $totinsp = $cantinsp;

    $cantrct = 0;
    $sql="SELECT * FROM rct WHERE ods='015'";
    $exito=mysqli_query($conexion, $sql);
    while ($row = mysqli_fetch_object($exito)){
        $cantrct += $row->eje;
    }

    $totrct = $cantrct;

    $cantcam = 0;
    $sql="SELECT * FROM caminata WHERE ods='015'";
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
        'totcam'=>$totcam,
        'semana'=>$semana
    );





echo json_encode($datos);
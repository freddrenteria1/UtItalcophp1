<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$fecha = $_POST["fecha"];
$ods = $_POST["ods"];

$odscomp = $ods;
$numods = substr($ods, 0,3);

$ods = substr($ods, 4);



$fecha = date("Y-m-d",strtotime($fecha."- 1 days")); 


    //Aseguramientos Italco
    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep<='$fecha' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep='$fecha' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalcodia = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep<='$fecha' AND origen = 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientes = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep='$fecha' AND origen = 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientesdia = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep<='$fecha' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgo = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND ods = '$numods' AND fecharep='$fecha' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgodia = mysqli_num_rows($exito);
  

    $sql="SELECT * FROM hallazgos WHERE ods like  '%$odscomp%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $tothallazgositalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM conversatorios WHERE ods like  '%$odscomp%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $totconversatorios = mysqli_num_rows($exito);

    $sas = '';

    $sql="SELECT * FROM sas WHERE ods like '%$odscomp%'";
    $exito=mysqli_query($conexion, $sql);

    if(mysqli_num_rows($exito)!= 0){
        $obj = mysqli_fetch_object($exito);
        $sas = $obj->porcentaje;
        $sas = $sas . '%';
    }


    $totac = $totacitalco +  $totacclientes;
    $totacdia = $totacitalcodia + $totacclientesdia;

    $datos = array(
        'totacitalco'=>$totacitalco,
        'totaccliente'=>$totacclientes,
        'totac'=>$totac,
        'totacitalcodia'=>$totacitalcodia,
        'totacclientedia'=>$totacclientesdia,
        'totacdia'=>$totacdia,
        'tothallazgositalco'=>$tothallazgositalco,
        'totconversatorios'=>$totconversatorios,
        'sas'=>$sas
    );


echo json_encode($datos);
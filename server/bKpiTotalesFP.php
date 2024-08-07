<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$fecha = $_POST["fecha"];
$ods = $_POST["ods"];

$ods = substr($ods, 4);


    //Aseguramientos Italco
    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep='$fecha' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalcodia = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND origen = 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientes = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep='$fecha' AND origen = 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientesdia = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep<='$fecha' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgo = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE frente like  '%$ods%' AND fecharep='$fecha' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgodia = mysqli_num_rows($exito);
  

    $sql="SELECT * FROM hallazgos WHERE ods like  '%$ods%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $tothallazgositalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM conversatorios WHERE ods like  '%$ods%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $totconversatorios = mysqli_num_rows($exito);


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
    );


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];
$ods = $_POST["ods"];

$fechaant = date("Y-m-d",strtotime($fecha."- 1 days")); 

    //Aseguramientos Italco
    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep<='$fechaant' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep='$fechaant' AND origen = 'ITALCO'";
    $exito=mysqli_query($conexion, $sql);
    $totacitalcodia = mysqli_num_rows($exito);

  

    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep<='$fechaant' AND criticidad != 'N/A' AND origen != 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgoitalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep='$fechaant' AND criticidad != 'N/A' AND origen != 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacriesgoitalcodia = mysqli_num_rows($exito);
  

    $sqle="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep<='$fechaant' AND origen = 'ECOPETROL'";
    $exitoe=mysqli_query($conexion, $sqle);
    $totacclientes = mysqli_num_rows($exitoe);

    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND fecharep='$fechaant' AND origen = 'ECOPETROL'";
    $exito=mysqli_query($conexion, $sql);
    $totacclientesdia = mysqli_num_rows($exito);


    $totaccliente = $totacclientes;
    $totacclientedia = $totacclientesdia + $totacriesgoitalcodia;

    $sql="SELECT * FROM hallazgos WHERE ods like '%$ods%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $tothallazgositalco = mysqli_num_rows($exito);

    $sql="SELECT * FROM conversatorios WHERE ods like '%$ods%' AND fecha<='$fecha'";
    $exito=mysqli_query($conexion, $sql);
    $totconversatorios = mysqli_num_rows($exito);


    $totac = $totacitalco +  $totaccliente;
    $totacdia = $totacitalcodia + $totacclientedia;

    $datos = array(
        'totacitalco'=>$totacitalco,
        'totaccliente'=>$totaccliente,
        'totac'=>$totac,
        'totacitalcodia'=>$totacitalcodia,
        'totacclientedia'=>$totacclientedia,
        'totacdia'=>$totacdia,
        'tothallazgositalco'=>$tothallazgositalco,
        'totconversatorios'=>$totconversatorios,
    );


echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$formapago = $_POST["formapago"];
$diasplazo = $_POST["diasplazo"];
$bien1 = $_POST["bien1"];
$bien2 = $_POST["bien2"];
$bien3 = $_POST["bien3"];
$refemp1 = $_POST["refemp1"];
$servemp1 = $_POST["servemp1"];
$contactoemp1 = $_POST["contactoemp1"];
$telemp1 = $_POST["telemp1"];
$refemp2 = $_POST["refemp2"];
$servemp2 = $_POST["servemp2"];
$contactoemp2 = $_POST["contactoemp2"];
$telemp2 = $_POST["telemp2"];

//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM infocomercial WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO infocomercial VALUES('','$formapago',$diasplazo,'$bien1','$bien2','$bien3','$refemp1','$servemp1','$contactoemp1','$telemp1','$refemp2','$servemp2','$contactoemp2','$telemp2','$user')";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "UPDATE infocomercial SET formapago='$formapago', plazo=$diasplazo, servicio1 = '$bien1', servicio2 = '$bien2', servicio3 = '$bien3', emp1='$refemp1', servicioemp1 = '$servemp1', contactoemp1 = '$contactoemp1', telcontactoemp1 = '$telemp1', emp2 = '$refemp2', servicioemp2 = '$servemp2', contactoemp2 = '$contactoemp2', telcontactoemp2 = '$telemp2' WHERE user='$user'";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
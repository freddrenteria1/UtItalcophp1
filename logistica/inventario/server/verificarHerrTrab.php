<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["cod"];
$ced = $_POST["ced"];
$alm = $_POST["alm"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];
$cant = $_POST["cant"];

$sql = "SELECT * FROM invplanta Where codigo='$cod' And ced = '$ced' And ods='$ods' And almacen = '$alm' And ubicacion = '$ubicacion'";
$exito = mysqli_query($conexion, $sql);

$existe = mysqli_num_rows($exito);

if($existe != 0){
    $obj = mysqli_fetch_object($exito);
    $existencia = $obj->cant;
    if($existencia >= $cant){
        $msn = 'Ok';
    }else{
        $msn = 'Cantidad excede a la asignada al trabajador. Asignadas: '.$existencia;
    }
}else{
    $msn='Item no cargado al trabajador';
}

$datos = array(
    'msn'=>$msn
);
   

echo json_encode($datos);
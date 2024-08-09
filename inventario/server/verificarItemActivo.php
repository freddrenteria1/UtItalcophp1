<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["codigo"];
$cant = $_POST["cant"];

$sql = "SELECT * FROM inventario Where codigo='$cod' And ubicacion = 'AP'";
$exito = mysqli_query($conexion, $sql);

$existe = mysqli_num_rows($exito);

if($existe != 0){
    $obj = mysqli_fetch_object($exito);
    $existencia = $obj->cantidad;
    if($existencia >= $cant){
        $msn = 'Ok';
    }else{
        $msn = 'Cantidad excede al inventario. Existencia: '.$existencia;
    }
}else{
    $msn='Item no existe en el inventario';
}

$datos = array(
    'msn'=>$msn
);
   

echo json_encode($datos);
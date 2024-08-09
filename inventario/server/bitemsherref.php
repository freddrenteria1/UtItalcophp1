<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cod = $_POST["cod"];
$ods = $_POST["ods"];

$sql = "SELECT *, SUM(cant) as tot FROM  invplantaalm Where codigo = '$cod' Group by codigo, ods, almacen, ubicacion";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[] =  array(
        'codigo'=>$obj->codigo,
        'articulo'=>$obj->articulo,
        'cant'=>$obj->tot,
        'ods'=>$obj->ods,
        'almacen'=>$obj->almacen,
        'ubicacion'=>$obj->ubicacion
    ); 
    
}
   

echo json_encode($datos);
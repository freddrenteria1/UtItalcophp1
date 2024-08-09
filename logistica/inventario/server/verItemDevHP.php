<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$odsdev = $_POST["odsdev"];
$ubicacion = $_POST["ubicacion"];

$cod = $_POST["codigo"];
$cant = $_POST["cant"];

//BUSCAR SI EXISTE HERRAMIENTA A NOMBRE DEL TRABAJADOR Y DESCUENTA LA CANTIDAD

$buscar = "SELECT * FROM invplantaalm Where codigo = '$cod' And ods='$odsdev' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
$ejeb = mysqli_query($conexion, $buscar);

$cantb = mysqli_num_rows($ejeb);

if($cantb > 0){
    $filab = mysqli_fetch_object($ejeb);
    $cantb = $filab->cant;
    
    if($cantb >= $cant){
        $msn = 'Ok';
    }else{
        $msn = 'Cantidad a devolver excede la cantidad remitida: '.$cantb;
    }
}else{
    $msn = 'Item no ha sido cargado a este almacén...';
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
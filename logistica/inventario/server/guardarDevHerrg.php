<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ced = $_POST["ced"];
$nombres = $_POST["nombres"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];
$items = $_POST["items"];
$cod = $_POST["cod"];
$cant = $_POST["cant"];
$observaciones = $_POST["observaciones"];
$user = $_POST["user"];

$alm = 'AH'.$ods.$ubicacion;

$msn = 'Ok';

//GUARDA LA ENTRADA

if($ced != '' && $items != ''){
    $sql = "INSERT INTO devherramientas VALUES('','$fecha','$ced','$nombres','$ods','$ubicacion','$items','$observaciones','$user')";
    $gent = mysqli_query($conexion, $sql);

    $lastid = mysqli_insert_id($conexion);

    //BUSCAR SI EXISTE HERRAMIENTA A NOMBRE DEL TRABAJADOR Y DESCUENTA LA CANTIDAD

    $buscar = "SELECT * FROM invplanta Where codigo = '$cod' And ced = '$ced' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
    $ejeb = mysqli_query($conexion, $buscar);

    $cantb = mysqli_num_rows($ejeb);

    if($cantb > 0){
        $filab = mysqli_fetch_object($ejeb);
        $cantb = $filab->cant;
        $ncant = $cantb - $cant;

        $query2 = "UPDATE invplanta SET cant = $ncant Where codigo = '$cod' And ced = '$ced' And ods='$ods' And almacen = 'Herramientas' And ubicacion = '$ubicacion'";
        $realizar = mysqli_query($conexion, $query2);
    }

    
}else{
    $msn = 'Error';
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$arrayRecibido = json_decode($_POST["datos"]);

// foreach($arrayRecibido as $fila) {
     
//     $datos = array(
//         'estado' => $fila->estado,
//         'detalles' => $fila->detalles
//     );
// }


$fecharep = $arrayRecibido[0]->fecharep;
$fechaevento = $arrayRecibido[0]->fechaevento;
$estado = $arrayRecibido[0]->estado;
$reporta = $arrayRecibido[0]->reporta;
$criticidad = $arrayRecibido[0]->criticidad;
$tipi = $arrayRecibido[0]->tipi;
$detalles = $arrayRecibido[0]->detalles;
$nivel1 = $arrayRecibido[0]->nivel1;
$nivel2 = $arrayRecibido[0]->nivel2;
$plan = $arrayRecibido[0]->plan;
$ods = $arrayRecibido[0]->ods;


//se almacenan los datos

$query = "INSERT INTO asegriesgos VALUES('', '$fecharep', '$fechaevento', '$reporta', '$detalles', '$criticidad', '$tipi', '$nivel1', '$nivel2', '$plan', '$estado', '$ods')";

$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Guardado...';
};

$datos = array(
    'resp' => $msn
);

echo json_encode($datos);
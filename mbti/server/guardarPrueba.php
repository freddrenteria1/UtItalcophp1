<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$datos = json_decode($_POST["datos"]);
$foto = $_POST["foto"];

$parte1 = $_POST["parte1"];
$parte2 = $_POST["parte2"];
$parte3 = $_POST["parte3"];
$parte4 = $_POST["parte4"];
$resultados = $_POST["resultados"];

$id = $datos[0]->id;
$edad = $datos[0]->edad;
$cargo = $datos[0]->cargo;
$fechan = $datos[0]->fechan;
$fechaa = $datos[0]->fechaa;


//SE VERIFICA QUE EL ID NO ESTÉ REGISTRADO EN LAS ENTRADAS

$query = "UPDATE pruebas SET fecha_e = '$fecha', edad = $edad, fecha_n = '$fechan', cargo = '$cargo', foto = '$foto', parte1 = '$parte1', parte2 = '$parte2', parte3 = '$parte3', parte4 = '$parte4', resultados = '$resultados'  WHERE id = $id";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    

    $msn = mysqli_error($conexion);
 
    
}else{
   $msn = 'Ok';
    
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);
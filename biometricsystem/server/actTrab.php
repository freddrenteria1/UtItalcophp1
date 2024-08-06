<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$codigo = $_POST["codigo"];
$doc = $_POST["doc"];
$nombres = $_POST["nombres"];
$apellidos = $_POST["apellidos"];
$dir = $_POST["dir"];
$tel = $_POST["tel"];
$cargo = $_POST["cargo"];
$turno = $_POST["turno"];
$empresa = $_POST["empresa"];
$grupo = $_POST["grupo"];
$frentetrab = $_POST["frentetrab"];
$lugar = $_POST["lugar"];
$acargo = $_POST["acargo"];
$sistprecio = $_POST["sistprecio"];
$tiponomina = $_POST["tiponomina"];
$detpago = $_POST["detpago"];
$finicio = $_POST["finicio"];
$ffinal = $_POST["ffinal"];
$estado = $_POST["estado"];

$ods = $_POST["ods"];
$id = $_POST["id"];
$ip = $_SERVER['REMOTE_ADDR'];

$user = $_POST["user"];

$sql = "SELECT * FROM grupos Where ods='$ods' AND grupo='$grupo'";
$exito = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_object($exito);

$supervisor = $fila->supervisor;

$query = "UPDATE trabajadores SET contrato='$codigo', cedula='$doc', nombres='$nombres', apellidos='$apellidos', domicilio='$dir', telefono='$tel', cargo='$cargo', lugartrab='$lugar', empresa='$empresa', turno='$turno', fingreso='$finicio', fsalida='$ffinal', acargo='$acargo', sistemaprecio='$sistprecio', tiponomina='$tiponomina', detpago='$detpago', frente='$grupo', supervisor='$supervisor', ods='$ods', frentetrab = '$frentetrab', estado='$estado' where id=$id";
$eje = mysqli_query($conexion, $query);

$nomb = $nombres . ' ' . $apellidos;

$sql = "INSERT INTO bitacorabio VALUES('', '$fecha', '$user', '$doc', '$nomb', '$turno', '$frentetrab', '$estado', '$ods', '$ip')";
$exito = mysqli_query($conexion, $sql);


$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$codtipo = $_POST["tipoitem"];
$codclase = $_POST["claseitem"];
$unidad = $_POST["unidad"];
$item = $_POST["item"];
$user = $_POST["user"];

$query = "SELECT * FROM items order by id DESC limit 1";
$bus = mysqli_query($conexion, $query);
$filaid = mysqli_fetch_object($bus);

$cant = $filaid->id;
$cant++;

$cod = '01' . $cant;


$codigo = $codtipo . $codclase . $cod;

$buscar = "SELECT * FROM tipoitems Where codtipo = '$codtipo'";
$enc = mysqli_query($conexion, $buscar);
$row = mysqli_fetch_object($enc);
$tipo = $row->tipo;

$buscar2 = "SELECT * FROM claseitems Where codclase = '$codclase' AND codtipo = '$codtipo'";
$enc2 = mysqli_query($conexion, $buscar2);
$fila = mysqli_fetch_object($enc2);
$clase = $fila->clase;

$sql="INSERT INTO items VALUES('','$tipo','$codtipo','$clase','$codclase','$item','$codigo','$unidad','$user')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);
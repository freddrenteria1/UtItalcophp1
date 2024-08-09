<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$cargo = $_POST["cargo"];
$ods = $_POST["ods"];
$clave = $_POST["clave"];
$idUser = $_POST["idUser"];

//SE ALMACENA LA FOTO

// Ruta donde se guardar?n las im?genes
$directorio = './firmas/';
// Recibo los datos de la imagen
$nombre = $_FILES['firma']['name'];
$tipo = $_FILES['firma']['type'];
$tamano = $_FILES['firma']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['firma']['tmp_name'],$directorio.$nombre);
$firma=$nombre;

$sql="UPDATE userseval SET nombres='$nombre', email='$email', cargo='$cargo', ods='$ods', clave='$clave', firma='$firma'  Where id=$idUser";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);


echo json_encode($datos);
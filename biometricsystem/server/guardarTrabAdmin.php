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

$nombrecompleto = $nombres.$apellidos;

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

$sql = "SELECT * FROM grupos Where ods='$ods' AND grupo='$grupo'";
$exito = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_object($exito);

$supervisor = $fila->supervisor;

$buscar = "SELECT * FROM trabajadores Where cedula = '$doc'";
$ejeb = mysqli_query($conexion, $buscar);

$enc = mysqli_num_rows($ejeb);

if($enc == 0){

    $sql5 = "SELECT * FROM trabajadores ORDER BY id DESC LIMIT 1";
    $exito5 = mysqli_query($conexion, $sql5);

    $fila = mysqli_fetch_object($exito5);

    $id = $fila->id;
    $id = intval($id)+1;

    $query = "INSERT INTO trabajadores VALUES($id, '$codigo', '$doc','$nombres','$apellidos','$dir','$tel','$cargo','$lugar','$empresa','$turno','$finicio','$ffinal','$acargo','$sistprecio','$tiponomina','$detpago','$grupo','$supervisor','$ods','$frentetrab','$estado')";
    $eje = mysqli_query($conexion, $query);
    
    if(!$eje){
        $msn = mysqli_error($conexion);
    }else{
        $msn = 'Ok';
    }

    $sql = "INSERT INTO programados VALUES('', '$doc', '$ods', '$nombrecompleto', '$cargo', '$frentetrab', '$lugar', '$turno', '$finicio', 'Programado', 'NO')";
    $eje = mysqli_query($conexion, $sql);

}else{

    $sql = "INSERT INTO programados VALUES('', '$doc', '$ods', '$nombrecompleto', '$cargo', '$frentetrab', '$lugar', '$turno', '$finicio', 'Programado','SI')";
    $eje = mysqli_query($conexion, $sql);
    $msn = 'Ok';
    
}



$datos = array(
    'msn'=> $msn
);

echo json_encode($datos);
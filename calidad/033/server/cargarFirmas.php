<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();



date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$clave = $_POST["clave"];

$sql="SELECT * FROM users ";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant != 0){

    while($obj = mysqli_fetch_object($exito)){

        $datos[] = array(
            'nombres'=>$obj->nombres,
            'email'=>$obj->email,
            'tipo'=>$obj->tipo,
            'estado'=>$obj->estado,
            'documento'=>$obj->documento,
            'firma'=>$obj->firma,
            'codigo'=>$codigogen
        );


    }
   
    
}

 

echo json_encode($datos);
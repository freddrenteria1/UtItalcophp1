<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$id = $_POST["id"];

//SE VERIFICA QUE EL ID NO ESTÉ REGISTRADO EN LAS ENTRADAS

$query = "SELECT * FROM pruebas WHERE doc = '$doc' AND id = $id";
$eje = mysqli_query($conexion, $query);
$cont = mysqli_num_rows($eje);

if($cont != 0){

    $obj = mysqli_fetch_object($eje);

    $msn = 'Ok';
   

    $datos = array(
        'id'=>$obj->id,
        'fecha_a'=>$obj->fecha_a,
        'fecha_e'=>$obj->fecha_e,
        'nombre'=>$obj->nombre,
        'doc'=>$obj->doc,
        'edad'=>$obj->edad,
        'fecha_n'=>$obj->fecha_n,
        'cargo'=>$obj->cargo,
        'foto'=>$obj->foto,
        'parte1'=>$obj->parte1,
        'parte2'=>$obj->parte2,
        'parte3'=>$obj->parte3,
        'parte4'=>$obj->parte4,
        'resultados'=>$obj->resultados
    );
    
}else{
   $msn = 'Sin registros';
   $datos = null;
}


echo json_encode($datos);
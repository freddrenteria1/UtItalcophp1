<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$idsubcat = $_POST["id"];

// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM sig WHERE subcategoria_id = $idsubcat order by prefijo ";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    while($obj = mysqli_fetch_object($exito)){
    
        $archivo[] = array(
            'id'=>$obj->id,
            'tipo'=>$obj->tipo,
            'prefijo'=>$obj->prefijo,
            'nombre'=>$obj->nombre,
            'archivo'=>$obj->archivo,
            'version'=>$obj->version,
            'descargas'=>$obj->descargas            
        );

    }

    $msn = 'OK';

}

echo json_encode($archivo);
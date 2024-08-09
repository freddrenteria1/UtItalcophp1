<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$busqueda = $_POST["busqueda"];
$user = $_POST["user"];


$sql1="SELECT * FROM siguser WHERE user = '$user'";
$exito1=mysqli_query($conexion, $sql1);

$row = mysqli_fetch_object($exito1);
$categorias = json_decode($row->categorias);

$cantreg = COUNT($categorias);


// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM sig WHERE prefijo like '%$busqueda%' OR nombre  like '%$busqueda%' OR archivo  like '%$busqueda%'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    while($obj = mysqli_fetch_object($exito)){
    
        for($i=0; $i<$cantreg; $i++){

            $cat = $categorias[$i]->categoria;

            if($cat == $obj->categoria_id){
                $archivo[] = array(
                    'id'=>$obj->id,
                    'tipo'=>$obj->tipo,
                    'prefijo'=>$obj->prefijo,
                    'nombre'=>$obj->nombre,
                    'archivo'=>$obj->archivo,
                    'version'=>$obj->version,
                    'descargas'=>$obj->descargas,
                    'cat'=>$cat         
                );
            }
        }

    }

    $msn = 'OK';

}

echo json_encode($archivo);
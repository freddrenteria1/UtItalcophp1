<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM siguser order by user";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    while($obj = mysqli_fetch_object($exito)){

        $cates = '';

        $categorias = json_decode($obj->categorias);
        $cantreg = COUNT($categorias);

        for($i=0; $i<$cantreg; $i++){

            $cat = $categorias[$i]->categoria;

            $cons = "SELECT * FROM sigcat WHERE id = $cat";
            $ejec = mysqli_query($conexion, $cons);

            $row = mysqli_fetch_object($ejec);

            $cates .= $row->categoria . ' | ';

        }
    
        $datos[] = array(
            'id'=>$obj->id,
            'user'=>$obj->user,
            'clave'=>$obj->clave,
            'categorias'=>$cates
        );

    }

    $msn = 'OK';

}

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$idcat = $_POST["id"];

// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM sigsubcat WHERE categoria_id = $idcat";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    while($obj = mysqli_fetch_object($exito)){
        $idsubcat = $obj->id;
        $subcategoria = $obj->subcategoria;

        $buscar2 = "SELECT * FROM sig WHERE subcategoria_id = $idsubcat";
        $ejeb2 = mysqli_query($conexion, $buscar2);

        $cantarch = mysqli_num_rows($ejeb2);

        $subcate[] = array(
            'idsubcat'=>$idsubcat,
            'subcategoria'=>$subcategoria,
            'cantarch'=>$cantarch
        );


    }

    $msn = 'OK';

}

echo json_encode($subcate);
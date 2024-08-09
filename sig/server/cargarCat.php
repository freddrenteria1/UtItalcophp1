<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$user = $_POST["user"];

// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM siguser WHERE user = '$user'";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){
    $row = mysqli_fetch_object($exito);
    $estado = $row->estado;
    $categorias = json_decode($row->categorias);

    $cantreg = COUNT($categorias);

    for($i=0; $i<$cantreg; $i++){
        $cat = $categorias[$i]->categoria;

        $cons = "SELECT * FROM sigcat WHERE id=$cat";
        $eje = mysqli_query($conexion, $cons);

        $row = mysqli_fetch_object($eje);
        $catid = $row->id;

        $buscar = "SELECT * FROM sigsubcat WHERE categoria_id = $catid";
        $ejeb = mysqli_query($conexion, $buscar);

        $cantenc = mysqli_num_rows($ejeb);

        $buscar2 = "SELECT * FROM sig WHERE categoria_id = $catid";
        $ejeb2 = mysqli_query($conexion, $buscar2);

        $cantarch = mysqli_num_rows($ejeb2);

        $cate[] = array(
            'idcat'=>$row->id,
            'categoria'=>$row->categoria,
            'cantsub'=>$cantenc,
            'cantarch'=>$cantarch
        );
    }

    $msn = 'OK';

}

echo json_encode($cate);
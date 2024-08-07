<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$id = $_POST["id"];

$sql="SELECT * FROM siguser WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    $row = mysqli_fetch_object($exito);
    $estado = $row->estado;
    $categorias = $row->categorias;
    $user = $row->user;
    $clave = $row->clave;

    $categorias = json_decode($row->categorias);
    $cantreg = COUNT($categorias);

    for($i=0; $i<$cantreg; $i++){

        $cat = $categorias[$i]->categoria;

        $cons = "SELECT * FROM sigcat WHERE id = $cat";
        $ejec = mysqli_query($conexion, $cons);

        $obj = mysqli_fetch_object($ejec);

        $categ[] = array(
            'id'=>$cat,
            'categoria'=>$obj->categoria
        );

        $catid[] = array(
            'categoria'=>$cat
        );

    }

    $msn = 'OK';
}

$datos = array(
    'estado'=>$estado,
    'categorias'=>json_encode($categ),
    'catid'=>json_encode($catid),
    'user'=>$user,
    'clave'=>$clave,
    'msn' => $msn
);

echo json_encode($datos);
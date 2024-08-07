<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = intval($_POST["id"]);
$item = intval($_POST["item"]);

//busca el numero del item actual

$buscar = "SELECT * FROM hitoshse WHERE id=$id";
$ejeb = mysqli_query($conexion, $buscar);

$obj = mysqli_fetch_object($ejeb);

$itemant = $obj->item;

if($itemant > $item){

    $sql1 = "UPDATE hitoshse SET item = 0 WHERE id = $id";
    $ejec = mysqli_query($conexion, $sql1);

    $sql3 = "SELECT * FROM hitoshse WHERE item >= $item AND item <= $itemant";
    $ejeact = mysqli_query($conexion, $sql3);
    $cantb = mysqli_num_rows($ejeact);

    while($obj = mysqli_fetch_object($ejeact)){

        $idb = $obj->id;
        $itemv = $obj->item;
        $itemv++;
        

        $arrayH[] = array(
            'idb'=>$idb,
            'itemv'=>$itemv
        );
        
        $sql4 = "UPDATE hitoshse SET item = $itemv WHERE id = $idb";
        $ejec = mysqli_query($conexion, $sql4);
        
    }
    

    $sql4 = "UPDATE hitoshse SET item = $item WHERE id = $id";
    $ejec = mysqli_query($conexion, $sql4);

}else{

    $sql = "UPDATE hitoshse SET item = 0 WHERE id = $id";
    $ejec = mysqli_query($conexion, $sql);

    $sql = "UPDATE hitoshse SET item = item - 1 WHERE item > $itemant AND item <= $item";
    $ejec = mysqli_query($conexion, $sql);

    $sql = "UPDATE hitoshse SET item = $item WHERE id = $id";
    $ejec = mysqli_query($conexion, $sql);

}


if(!$ejec){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok,
    'cantb'=>$cantb,
    'arrayH'=>$arrayH,
    'itemant'=>$itemant,
    'id'=>$id,
    'item'=>$item
);

echo json_encode($datos);
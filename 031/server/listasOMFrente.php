<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$semana = $_POST["semana"];
$frente = $_POST["frente"];

//$semana = $_GET["semana"];


$sql="SELECT * FROM ordenmant WHERE semana = $semana AND frente = '$frente' GROUP BY numom";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    
    $numom = $obj->numom;

    // $query="SELECT * FROM filesom WHERE  numom = '$numom' AND frente = '$frente'";
    // $eje=mysqli_query($conexion, $query);

    // $enc = mysqli_num_rows($eje);

    // if($enc != 0){
    //     $row = mysqli_fetch_object($eje);
    //     $totOM = 1;
    // }else{
    //     $totOM = 0;
    // }

    $totEje = 0;

    $query="SELECT * FROM ordenmant WHERE  numom = '$numom' AND frente = '$frente' AND semana = $semana";
    $eje=mysqli_query($conexion, $query);

    $enc = mysqli_num_rows($eje);

    if($enc != 0){

        while($row = mysqli_fetch_object($eje)){

            $estado = $row->estado;

            if($estado =='Ejecutado'){
                $totEje++;
            }
        }

        $totOP = $enc;

    }else{
        $totOP = 0;
    }

    
    

    $om[] = array(
        'id'=>$obj->id,
        'frente'=>$obj->frente,
        'semana'=>$obj->semana,
        'numom'=>$obj->numom,
        'plan'=>$totOP,
        'eje'=>intval($totEje)
    );

}






echo json_encode($om);
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

    $query="SELECT * FROM ordenmant WHERE  numom = '$numom' AND frente = '$frente' AND semana = $semana";
    $eje=mysqli_query($conexion, $query);

    $enc = mysqli_num_rows($eje);

    if($enc != 0){

       
        while($row = mysqli_fetch_object($eje)){

            $op[] = array(
                'frnete'=>$frente,
                'semana'=>$obj->semana,
                'numom'=>$numom,
                'op'=>$row->op,
                'dpto'=>$row->dpto,
                'unidad'=>$row->unidad,
                'equipo'=>$row->equipo,
                'alcance'=>$row->alcance,
                'actividades'=>$row->actividades,
                'fechaprog'=>$row->fechaprog,
                'fecharep'=>$row->fecharep,
                'estado'=>$row->estado
            );

        }
        

    } 

}

$sql="SELECT * FROM ordenmant WHERE semana = $semana AND frente = '$frente' GROUP BY equipo";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $equipos[] = array(
        'equipo'=>$obj->equipo,

    );

}

$datos = array(
    'op'=>$op,
    'equipos'=>$equipos
);

echo json_encode($datos);

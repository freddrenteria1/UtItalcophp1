<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$om = $_POST["om"];
// $frente = $_POST["frente"];
// $semana = $_POST["semana"];

$buscar="SELECT * FROM ordenmant WHERE numom = '$om' ";
$ejeb = mysqli_query($conexion, $buscar);

$enc = mysqli_num_rows($ejeb);

if($enc != 0){
    $row = mysqli_fetch_object($ejeb);

    $semana = $row->semana;
    $frente = $row->frente;
    $msn = 'Ok';
    
}else{
    $msn = 'OM no está en el registro de programación';
}

$sql="SELECT * FROM filesom WHERE numom = '$om' order by archivo DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $files[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'semana'=>$obj->semana,
        'frente'=>$obj->frente,
        'archivo'=>$obj->archivo
    );

}

//$query="SELECT * FROM ordenmant WHERE  numom = '$om' AND frente = '$frente' AND semana = $semana";

$query="SELECT * FROM ordenmant WHERE  numom = '$om' ";
$eje=mysqli_query($conexion, $query);

$enc = mysqli_num_rows($eje);

if($enc != 0){

    while($row = mysqli_fetch_object($eje)){

        $op[] = array(
            'op'=>$row->op,
            'dpto'=>$row->dpto,
            'unidad'=>$row->unidad,
            'alcance'=>$row->alcance,
            'actividades'=>$row->actividades,
            'fechaprog'=>$row->fechaprog,
            'fecharep'=>$row->fecharep,
            'estado'=>$row->estado
        );

    }

}

$datos = array(
    'files'=>$files,
    'op'=>$op,
    'semana'=>$semana,
    'frente'=>$frente,
    'msn'=>$msn
);
  

echo json_encode($datos);
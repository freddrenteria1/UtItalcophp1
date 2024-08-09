<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/html;charset=utf-8");

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$busqueda = "SELECT * FROM lazos  GROUP BY isometrico";
$ejeb = mysqli_query($conexion, $busqueda);

while($obj = mysqli_fetch_object($ejeb)){

    $datos = null;
    $iso = $obj->isometrico;
    $lazo = $obj->lazo;

    $buscar = "SELECT * FROM lazos WHERE isometrico = '$iso'";
    $eje = mysqli_query($conexion, $buscar);

    while($row = mysqli_fetch_object($eje)){
        $datos[] = array(
            'cml'=>$row->cml,
            'accesorio'=>'',
            'okna'=>''
        );       
    }

    $cmls = json_encode($datos);

    $query2 = "INSERT INTO os114 VALUES('', 'U-2100', '', 'TOPPING 2100', '030', '$iso', '$lazo', '$cmls', '', '', '', '','')";
    $eje2 = mysqli_query($conexion, $query2);

    if(!$eje2){
        $msn = mysqli_error($conexion);
    }else{
        $msn = 'Ok';
    }

}      

$datos = array(
    'msn' => $msn
);
 
echo json_encode($msn);
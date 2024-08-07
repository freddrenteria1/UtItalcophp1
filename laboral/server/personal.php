<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$query = "SELECT * FROM basetrab order by nombres";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    
    while($obj = mysqli_fetch_object($eje)){

           
        
        $datos[] = array(
            'id'=>$obj->id,
            'contrato'=>$obj->contrato,
            'cedula'=>$obj->cedula,
            'tel'=>$obj->tel,
            'nombres'=>$obj->nombres,
            'cargo'=>$obj->cargo,
            'salario'=>$obj->salario,
            'finicio'=>$obj->finicio,
            'objeto'=>$obj->objeto,
            'ffinal'=>$obj->ffinal,
            'ods'=>$obj->ods
       
        );

    }

}else{
    $datos = array(
        'msn'=>'Error'
    );
}

echo json_encode($datos);
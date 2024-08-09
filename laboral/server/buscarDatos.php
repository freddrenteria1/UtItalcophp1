<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];

//$ced = str_replace ( ".", '', $doc);

$query = "SELECT * FROM basetrab WHERE cedula = '$doc' AND finicio != 'ANULADO' AND ffinal != '' order by id ASC";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    
    while($obj = mysqli_fetch_object($eje)){

        $texto = $obj->objeto;

        $buscar = 'ACTIV';

        $pos = stripos($texto, $buscar);
        $objeto = substr($texto, $pos); 
        
        
        $datos[] = array(
            'id'=>$obj->id,
            'contrato'=>$obj->contrato,
            'cedula'=>$obj->cedula,
            'nombres'=>$obj->nombres,
            'cargo'=>$obj->cargo,
            'salario'=>$obj->salario,
            'finicio'=>$obj->finicio,
            'objeto'=>$objeto,
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
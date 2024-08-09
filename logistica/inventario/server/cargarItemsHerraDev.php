<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

	include("conectar.php");
    $conexion=conectar();
 
   

    //se limpia la tabla
    $sql="SELECT * FROM tarjetas order by ID";
	$exito=mysqli_query($conexion, $sql);

    while($obj = mysqli_fetch_object($exito)){
        $cod =  $obj->ID;
        $codtarj = $obj->CODTARJ;
        
        $query = "UPDATE abonos SET CODTARJ = '$cod' Where CODTARJ = '$codtarj'";
        $eje = mysqli_query($conexion, $query);
    }


date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM items Where clase = 'SERVICIO DE ALQUILER' order by articulo";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $codigo = $row->codigo;

    $query = "SELECT * FROM inventario Where codigo='$codigo' and cantidad > 0";
    $eje = mysqli_query($conexion, $query);
    $cant = mysqli_num_rows($eje);

    if($cant != 0){
        $datos[] = array(
            'id'=>$row->id,
            'tipo'=>$row->tipo,
            'codtipo'=>$row->codtipo,
            'clase'=>$row->clase,
            'codclase'=>$row->codclase,
            'item'=>$row->articulo,
            'codigo'=>$row->codigo,
            'unidad'=>$row->unidad
        );
    }
        
}

echo json_encode($datos);
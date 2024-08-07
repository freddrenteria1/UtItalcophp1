<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

if(strlen($ods) > 3){
    //$ods = substr($ods, 4);
    $ods = substr($ods, 4);
    $sql="SELECT * FROM aseguramientos WHERE frente like '%$ods%' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
}else{
    $sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND criticidad != 'N/A'";
    $exito=mysqli_query($conexion, $sql);
}

while ($row = mysqli_fetch_object($exito)){

    
    $datos[] = array(
        'id' => $row->id,
        'item' => $row->item,
        'fecharep'=>$row->fecharep,
        'fechaevento'=>$row->fechaevento,
        'reporta'=>$row->reporta,
        'detalles'=>$row->detalles,
        'criticidad'=>$row->criticidad,
        'tipificacion'=>$row->tipificacion,
        'nivel1'=>$row->nivel1,
        'nivel2'=>$row->nivel2,
        'frente'=>$row->frente,
        'plan'=>$row->plan,
        'fcierre'=>$row->fcierre,
        'estado'=>$row->estado,
        'ods'=>$row->ods
    );

}  
echo json_encode($datos);
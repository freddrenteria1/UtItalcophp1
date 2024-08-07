<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO



$sql="SELECT * FROM aseguramientos WHERE ods = '$ods' AND criticidad != 'N/A' AND fecharep<='$fecha'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    //se busca el plan para el riesgo si lo tiene
    $item = $row->item;
    $query = "SELECT * FROM planacriesgo Where itemacr = '$item' and ods='$ods'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont != 0){
        $fila = mysqli_fetch_object($eje);
        $plan = $fila->plan;
        $fcierre = $fila->fcierre;
    }else{
        $plan = '';
        $fcierre = '';
    }

    $datos[] = array(
        'id' => $row->id,
        'item' => $row->item,
        'fecharep'=>$row->fecharep,
        'fechaevento'=>$row->fechaevento,
        'reporta'=>$row->reporta,
        'detalles'=>$row->detalles,
        'tipificacion'=>$row->tipificacion,
        'criticidad'=>$row->criticidad,
        'nivel1'=>$row->nivel1,
        'nivel2'=>$row->nivel2,
        'plan'=>$plan,
        'fcierre'=>$fcierre,
        'ods'=>$row->ods
    );

} 

echo json_encode($datos);
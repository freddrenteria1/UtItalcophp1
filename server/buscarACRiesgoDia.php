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

$fecha = date("Y-m-d",strtotime($fecha."- 1 days")); 

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM aseguramientos WHERE ods like  '%$ods%' AND criticidad != 'N/A'";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $fecharep = $row->fecharep;
    $fcierre = $row->fcierre;

    $item = $row->item;
    $itemplan = 0;

    if($fecharep == $fecha OR $fcierre == $fecha){

        
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
            'plan'=>$row->plan,
            'fcierre'=>$row->fcierre,
            'foto'=>$row->soportes,
            'ods'=>$row->ods
        );
    }

    
   

} 

echo json_encode($datos);
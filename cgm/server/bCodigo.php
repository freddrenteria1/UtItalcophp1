<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$codigo = $_POST["codigo"];
$numsol = $_POST["numsol"];
$posb = $_POST["posb"];

$sql="SELECT * FROM bdmateriales WHERE cm = '$codigo' AND reserva = '$numsol' AND posres = $posb";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont != 0){
    $row = mysqli_fetch_object($exito);

    $cantreq = $row->cantreq;

    $query = "SELECT * FROM detallesent WHERE codigo='$codigo' AND solicitud = '$numsol' AND pos = $posb";
    $eje = mysqli_query($conexion, $query);

    $cant = mysqli_num_rows($eje);
    
    if($cant != 0){

        while($fila = mysqli_fetch_object($eje)){

            $cantrec = $fila->cantrec;
            $totcantrec += $cantrec;
            $cantreq = $cantreq - $cantrec;

        }    

    }



    $datos = array(
        'id'=>$row->id,
        'item'=>$row->item,
        'reserva'=>$row->reserva,
        'posres'=>$row->posres,
        'cm'=>$row->cm,
        'descripcion'=>$row->descripcion,
        'unidad'=>$row->unidad,
        'cantsol'=>$row->cantreq,
        'cantreq'=>$cantreq,
        'impacto'=>$row->impacto,
        'ods'=>$row->ods,
        'ordenmtto'=>$row->ordenmtto,
        'equipo'=>$row->equipo,
        'sistema'=>$row->sistema,
        'isometrico'=>$row->isometrico,
        'ingenieria'=>$row->ingenieria,
        'obsadicional'=>$row->obsadicional,
        'alcance'=>$row->alcance,
        'ubicatec'=>$row->ubicatec,
        'planeado'=>$row->planeado,
        'etapa'=>$row->etapa,
        'especialidad'=>$row->especialidad,
        'sk'=>$row->sk,
        'numcolada'=>$row->numcolada,
        'certificado'=>$row->certificado,
        'numdoc'=>$row->documento,
        'cantrec'=>$totcantrec
    );

}

echo json_encode($datos);
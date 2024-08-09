<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");
 
$sql="SELECT * FROM compras";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $itemsComp = json_decode($obj->items, false, 512, JSON_UNESCAPED_UNICODE);
    $cantic = count($itemsComp);
    

    $totrec = 0;
    $totpend = 0;
    $totparc = 0;

    $totfact = 0;

    for($a = 0; $a < $cantic; $a++){

        $totfact += $itemsComp[$a]->total;

        if($itemsComp[$a]->cantp == 0){
            
            $totrec++;
        } 
        if($itemsComp[$a]->cantp != 0){
            
            if($itemsComp[$a]->cantp != $itemsComp[$a]->cant){
                $totparc++;
            }else{
                $totpend++;
            }
             
        } 
         
    }

  

    if($totrec == $cantic){
        $estado = 'Recibido';
    }else{
        if($totparc == 0){
            $estado = 'Pendiente';
        }else{
            $estado = 'Parcial';
        }
    }

    $idcompra = $obj->id;

    $query="SELECT * FROM ordenentradatmp WHERE ordencompra = '$idcompra'";
    $eje=mysqli_query($conexion, $query);

    $enco = mysqli_num_rows($eje);

    $ord = '';

    if($enco != 0){
        
        while($row = mysqli_fetch_object($eje)){
            $ord .= $row->id . '-';
            
        }

    }

       
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'proveedor'=>$obj->proveedor,
        'destino'=>$obj->destino,
        'elaborado'=>$obj->elaborado,
        'estado'=>$estado,
        'totrec'=>$totrec,
        'totpend'=>$totpend,
        'ordent'=>$ord,
        'totfact'=>$totfact
    );
}

echo json_encode($datos);
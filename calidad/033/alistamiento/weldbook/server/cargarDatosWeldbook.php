<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM datosw";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'ods'=>$obj->ods,
            'planta'=>$obj->planta,
            'especialidad'=>$obj->especialidad,
            'equipo'=>$obj->equipo,
            'descripcion'=>$obj->descripcion,
            'plano'=>$obj->plano,
            'sk'=>$obj->sk,
            'rev'=>$obj->rev,
            'materialb1'=>$obj->materialb1,
            'materialb2'=>$obj->materialb2,
            'clasemetal'=>$obj->clasemetal,
            'spool'=>$obj->spool,
            'descjunta1'=>$obj->descjunta1,
            'descjunta2'=>$obj->descjunta2,
            'numjunta'=>$obj->numjunta,
            'lugar'=>$obj->lugar,
            'pulgadas'=>$obj->pulgadas,
            'schthk'=>$obj->schthk,
            'proceso'=>$obj->proceso,
            'tipojunta'=>$obj->tipojunta,
            'mataporte'=>$obj->mataporte,
            'wps'=>$obj->wps,
            'fecha'=>$obj->fecha,
            'estw1'=>$obj->estw1,
            'estw2'=>$obj->estw2,
            'estw3'=>$obj->estw3,
            'estw4'=>$obj->estw4,
            'cantw1'=>$obj->cantw1,
            'cantw2'=>$obj->cantw2,
            'cantw3'=>$obj->cantw3,
            'cantw4'=>$obj->cantw4,
            'cantpw1'=>$obj->cantpw1,
            'cantpw2'=>$obj->cantpw2,
            'cantpw3'=>$obj->cantpw3,
            'cantpw4'=>$obj->cantpw4,
            'vt'=>$obj->vt,
            'plpresultado'=>$obj->plpresultado,
            'plpinforme'=>$obj->plpinforme,
            'rxpreresultado'=>$obj->rxpreresultado,
            'rxprefecha'=>$obj->rxprefecha,
            'rxpreinforme'=>$obj->rxpreinforme,
            'utpreresultado'=>$obj->utpreresultado,
            'utprefecha'=>$obj->utprefecha,
            'utpreinforme'=>$obj->utpreinforme,
            'pwhtresultado'=>$obj->pwhtresultado,
            'pwhtfecha'=>$obj->pwhtfecha,
            'pwhtinforme'=>$obj->pwhtinforme,
            'durezaresultado'=>$obj->durezaresultado,
            'durezafecha'=>$obj->durezafecha,
            'durezainforme'=>$obj->durezainforme,
            'rxpostresultado'=>$obj->rxpostresultado,
            'rxpostfecha'=>$obj->rxpostfecha,
            'rxpostinforme'=>$obj->rxpostinforme,
            'utpostresultado'=>$obj->utpostresultado,
            'utpostfecha'=>$obj->utpostfecha,
            'utpostinforme'=>$obj->utpostinforme,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);
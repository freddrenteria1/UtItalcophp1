<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccinter";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $ccinter[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'zona'=>$obj->zona,
            'tag'=>$obj->tag,
            'alcance'=>$obj->alcance,
            'tipo'=>$obj->tipo,
            'numtubos'=>$obj->numtubos,
            'descripcion'=>$obj->descripcion,
            'phtubos'=>$obj->phtubos,
            'phcasco'=>$obj->phcasco,
            'sastubos'=>$obj->sastubos,
            'sascasco'=>$obj->sascasco,
            
            'hazubicacion'=>$obj->hazubicacion,
            'hazretiro'=>$obj->hazretiro,
            'hazlavado'=>$obj->hazlavado,
            'hazeddy'=>$obj->hazeddy,
            'hazinspvisual'=>$obj->hazinspvisual,
            'hazrtpostinsp'=>$obj->hazrtpostinsp,
            'hazejert'=>$obj->hazejert,
            'hazcañuelas'=>$obj->hazcañuelas,
            'hazreentube'=>$obj->hazreentube,
            'hazliberado'=>$obj->hazliberado,

            'canalbubicacion'=>$obj->canalbubicacion,
            'canalbretiro'=>$obj->canalbretiro,
            'canalblavado'=>$obj->canalblavado,
            'canalblimpieza'=>$obj->canalblimpieza,
            'canalbinspvisual'=>$obj->canalbinspvisual,
            'canalbrtpostinsp'=>$obj->canalbrtpostinsp,
            'canalbejert'=>$obj->canalbejert,
            'canalbejealcance'=>$obj->canalbejealcance,
            'canalbliberado'=>$obj->canalbliberado,

            'tcanalubicacion'=>$obj->tcanalubicacion,
            'tcanalretiro'=>$obj->tcanalretiro,
            'tcanallavado'=>$obj->tcanallavado,
            'tcanallimpieza'=>$obj->tcanallimpieza,
            'tcanalinspvisual'=>$obj->tcanalinspvisual,
            'tcanalrtpostinsp'=>$obj->tcanalrtpostinsp,
            'tcanalejert'=>$obj->tcanalejert,
            'tcanalejealcance'=>$obj->tcanalejealcance,
            'tcanalliberado'=>$obj->tcanalliberado,

            'tcabfubicacion'=>$obj->tcabfubicacion,
            'tcabfretiro'=>$obj->tcabfretiro,
            'tcabflavado'=>$obj->tcabflavado,
            'tcabflimpieza'=>$obj->tcabflimpieza,
            'tcabfinspvisual'=>$obj->tcabfinspvisual,
            'tcabfrtpostinsp'=>$obj->tcabfrtpostinsp,
            'tcabfejert'=>$obj->tcabfejert,
            'tcabfejealcance'=>$obj->tcabfejealcance,
            'tcabfliberado'=>$obj->tcabfliberado,

            'amlubicacion'=>$obj->amlubicacion,
            'amlretiro'=>$obj->amlretiro,
            'amllavado'=>$obj->amllavado,
            'amlinspvisual'=>$obj->amlinspvisual,
            'amlrtpostinsp'=>$obj->amlrtpostinsp,
            'amlejert'=>$obj->amlejert,
            'amlejealcance'=>$obj->amlejealcance,
            'amlliberado'=>$obj->amlliberado,

            'cclavado'=>$obj->cclavado,
            'cclimpieza'=>$obj->cclimpieza,
            'ccinspvisual'=>$obj->ccinspvisual,
            'ccrtpostinsp'=>$obj->ccrtpostinsp,
            'ccejert'=>$obj->ccejert,
            'ccejealcance'=>$obj->ccejealcance,
            'ccliberado'=>$obj->ccliberado,

            'tccubicacion'=>$obj->tccubicacion,
            'tccretiro'=>$obj->tccretiro,
            'tcclavado'=>$obj->tcclavado,
            'tcclimpieza'=>$obj->tcclimpieza,
            'tccinspvisual'=>$obj->tccinspvisual,
            'tccrtpostinsp'=>$obj->tccrtpostinsp,
            'tccejert'=>$obj->tccejert,
            'tccejealcance'=>$obj->tccejealcance,
            'tccliberado'=>$obj->tccliberado,

            'armhaz'=>$obj->armhaz,
            'armcanal'=>$obj->armcanal,
            'armtcanal'=>$obj->armtcanal,
            'armtcf'=>$obj->armtcf,
            'armtapacc'=>$obj->armtapacc,

            'phladotubos'=>$obj->phladotubos,
            'phladocasco'=>$obj->phladocasco,

            'normsoldsello'=>$obj->normsoldsello,
            'normpintura'=>$obj->normpintura,
            'normaislamiento'=>$obj->normaislamiento,
            'normretciegos'=>$obj->normretciegos,
            'normrca'=>$obj->normrca,
            
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM resinter";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

while( $obj = mysqli_fetch_object($exito)){

    $res[] = array(
        'actividad'=>$obj->actividad,
        'haztotal'=>intval($obj->haztotal),
        'hazeje'=>intval($obj->hazeje),
        'canaltotal'=>intval($obj->canaltotal),
        'canaleje'=>intval($obj->canaleje),
        'tpcanaltotal'=>intval($obj->tpcanaltotal),
        'tpcanaleje'=>intval($obj->tpcanaleje),
        'tpftotal'=>intval($obj->tpftotal),
        'tpfeje'=>intval($obj->tpfeje),
        'anitotal'=>intval($obj->anitotal),
        'anieje'=>intval($obj->anieje),
        'cascototal'=>intval($obj->cascototal),
        'cascoeje'=>intval($obj->cascoeje),
        'tpcascototal'=>intval($obj->tpcascototal),
        'tpcascoeje'=>intval($obj->tpcascoeje)        
    );


}

$datos = array(
    'ccinter'=>$ccinter,
    'res'=>$res
);


echo json_encode($datos);
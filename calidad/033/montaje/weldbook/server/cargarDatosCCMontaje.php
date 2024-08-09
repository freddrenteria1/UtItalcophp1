<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccmbanco order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $banco[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccmparedpiso order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $piso[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccmparedeslat order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $lateral[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccmparedquema order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $quemadores[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccmparedpantalla order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $pantalla[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccmparedtecho order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $techo[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}


$sql="SELECT * FROM ccmcalentador order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $calentador[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}


$sql="SELECT * FROM ccmriser order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $riser[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividades,
            'totplan'=>$obj->planeado,
            'ejete'=>$obj->ejecutado,
            'acumeje'=>$obj->acumulado,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones,
            'avance'=>$obj->avance
        );
    }

    $msn = 'Ok';
     
}

$datos = array(
    'banco'=>$banco,
    'piso'=>$piso,
    'lateral'=>$lateral,
    'quemadores'=>$quemadores,
    'pantalla'=>$pantalla,
    'techo'=>$techo,
    'calentador'=>$calentador,
    'riser'=>$riser
);


echo json_encode($datos);
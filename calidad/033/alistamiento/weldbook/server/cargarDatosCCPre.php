<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccplaterales order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $laterales[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccppiso order by fecha DESC";
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
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccpfrontal order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $frontal[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccptecho order by fecha DESC";
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
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}

$sql="SELECT * FROM ccppantalla order by fecha DESC";
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
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}

$datos = array(
    'laterales'=>$laterales,
    'piso'=>$piso,
    'frontal'=>$frontal,
    'techo'=>$techo,
    'pantalla'=>$pantalla,
);


echo json_encode($datos);
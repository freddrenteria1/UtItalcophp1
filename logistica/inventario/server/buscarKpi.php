<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql = "SELECT ubicacion, COUNT(*) AS tot FROM inventario GROUP BY ubicacion";
$exito = mysqli_query($conexion, $sql);

While($obj = mysqli_fetch_object($exito)){

    $inventario[] = array(
        'ubicacion'=>$obj->ubicacion,
        'cant'=>intval($obj->tot),
        'msn'=>'Ok'
    );

}

$sql2 = "SELECT ubicacion, COUNT(*) AS tot FROM entradaconsumibles GROUP BY ubicacion";
$exito2 = mysqli_query($conexion, $sql2);

While($obj = mysqli_fetch_object($exito2)){

    $entradasconsu[] = array(
        'ubicacion'=>$obj->ubicacion,
        'cant'=>intval($obj->tot),
        'msn'=>'Ok'
    );

}

$sql3 = "SELECT ubicacion, COUNT(*) AS tot FROM entradaherramientas GROUP BY ubicacion";
$exito3 = mysqli_query($conexion, $sql3);

While($obj = mysqli_fetch_object($exito3)){

    $entradasherra[] = array(
        'ubicacion'=>$obj->ubicacion,
        'cant'=>intval($obj->tot),
        'msn'=>'Ok'
    );

}

$sql4 = "SELECT ubicacion, COUNT(*) AS tot FROM salidaconsumibles GROUP BY ubicacion";
$exito4 = mysqli_query($conexion, $sql4);

While($obj = mysqli_fetch_object($exito4)){

    $salidaconsu[] = array(
        'ubicacion'=>$obj->ubicacion,
        'cant'=>intval($obj->tot),
        'msn'=>'Ok'
    );

}

$sql5 = "SELECT ubicacion, COUNT(*) AS tot FROM salidaherramientas GROUP BY ubicacion";
$exito5 = mysqli_query($conexion, $sql5);

While($obj = mysqli_fetch_object($exito5)){

    $salidaherra[] = array(
        'ubicacion'=>$obj->ubicacion,
        'cant'=>intval($obj->tot),
        'msn'=>'Ok'
    );

}

$query = "SELECT * FROM ordensalidaconsu GROUP BY ubicacion";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){
    $ubica = $row->ubicacion;
    $totremsalida = 0;
    $totremsalidareg = 0;

    $cons = "SELECT * FROM ordensalidaconsu Where ubicacion = '$ubica'";
    $ejec = mysqli_query($conexion, $cons);

    while($file = mysqli_fetch_object($ejec)){
        $numremi = $file->id;
        $totremsalida++;
        
        $consq = "SELECT * FROM entradaconsumibles Where remision='$numremi'";
        $ejecq = mysqli_query($conexion, $consq);
        $enc = mysqli_num_rows($ejecq);
        if($enc != 0){
            $totremsalidareg++;
        }
        
    }

    $listaRemi[] = array(
        'ubicacion'=>$ubica,
        'totremsalida'=>$totremsalida,
        'totremsalidareg'=>$totremsalidareg
    );
}

$query2 = "SELECT * FROM ordensalidaherr GROUP BY ubicacion";
$eje2 = mysqli_query($conexion, $query2);

while($row = mysqli_fetch_object($eje2)){
    $ubica = $row->ubicacion;
    $totremsalida = 0;
    $totremsalidareg = 0;

    $cons = "SELECT * FROM ordensalidaherr Where ubicacion = '$ubica'";
    $ejec = mysqli_query($conexion, $cons);

    while($file = mysqli_fetch_object($ejec)){
        $numremi = $file->id;
        $totremsalida++;
        
        $consq = "SELECT * FROM entradaherramientas Where remision='$numremi'";
        $ejecq = mysqli_query($conexion, $consq);
        $enc = mysqli_num_rows($ejecq);
        if($enc != 0){
            $totremsalidareg++;
        }
        
    }

    $listaRemiHerr[] = array(
        'ubicacion'=>$ubica,
        'totremsalida'=>$totremsalida,
        'totremsalidareg'=>$totremsalidareg
    );
}

$datos = array(
    'inventario'=>$inventario,
    'entradaconsu'=>$entradasconsu,
    'entradaHerr'=>$entradasherra,
    'salidaconsu'=>$salidaconsu,
    'salidaherr'=>$salidaherra,
    'listaRemi'=>$listaRemi,
    'listaRemiHerr'=>$listaRemiHerr
);
   
echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$sql="SELECT *, SUM(cal) as totcal, count(*) as toteval FROM evaluacionsup GROUP BY doc, ods order by nombre";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $doc = $row->doc;
    $ods = $row->ods;

    $calqaqc = '-';
    $callog = '-';
    $calhse = '-';
    $caljefe = '-';

    $query = "SELECT * FROM evaluacionsup WHERE doc = '$doc' AND ods = '$ods' AND cargoeval = 'LÍDER QAQC'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        $calqaqc = $obj->cal;
        $evalqaqc = $obj->evaluador;
    }

    $query = "SELECT * FROM evaluacionsup WHERE doc = '$doc' AND ods = '$ods' AND cargoeval = 'LÍDER LOGÍSTICA'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        $callog = $obj->cal;
        $evallog = $obj->evaluador;
    }

    $query = "SELECT * FROM evaluacionsup WHERE doc = '$doc' AND ods = '$ods' AND cargoeval = 'LÍDER HSE'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        $calhse = $obj->cal;
        $evalhse = $obj->evaluador;
    }

    $query = "SELECT * FROM evaluacionsup WHERE doc = '$doc' AND ods = '$ods' AND cargoeval != 'LÍDER HSE' AND cargoeval != 'LÍDER LOGÍSTICA' AND cargoeval != 'LÍDER LOGÍSTICA' AND cargoeval != 'LÍDER QAQC'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        $caljefe = $obj->cal;
        $evaljefe = $obj->evaluador;
    }
    
    
    $prom = $row->totcal/$row->toteval;
    $prom = number_format($prom, 2);
    $datos[] = array(
        'id'=>$row->id,
        'nombres'=>$row->nombre,
        'doc'=>$row->doc,
        'cargo'=>$row->cargo,
        'ods' => $row->ods,
        'fecha'=> $row->fecha,
        'pinicial'=> $row->pinicial,
        'pfinal'=>$row->pfinal,
        'evaluador'=>$row->evaluador,
        'caljefe'=>$caljefe,
        'evaljefe'=>$evaljefe,
        'calqaqc'=>$calqaqc,
        'evalqaqc'=>$evalqaqc,
        'calhse'=>$calhse,
        'evalhse'=>$evalhse,
        'callog'=>$callog,
        'evallog'=>$evallog,
        'cal'=>$prom,
        'observaciones'=>$row->observaciones,
        'compromisos'=>$row->compromisos,
        'planes'=>$row->planes
    );

}

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$sql="SELECT *, SUM(cal) as totcal, count(*) as toteval FROM evalprov GROUP BY idprov, ods order by proveedor";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $idprov = $row->idprov;
    $ods = $row->ods;

    $calact = '-';
    $calqaqc = '-';
    $caladmin = '-';
    $calhse = '-';

    $sumatotal = 0;
    $canttot = 0;

    $query = "SELECT SUM(cal) as totcal, count(*) as toteval FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Calidad'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        if($obj->totcal != 0){
            $suma = $obj->totcal;
            $total = $obj->toteval;
            $calqaqc = $suma/$total;
            $calqaqc = number_format($calqaqc, 2);
            $sumatotal += $calqaqc;
            $canttot++;
        }
    }

    $query = "SELECT SUM(cal) as totcal, count(*) as toteval FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Ejecución de actividades'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        if($obj->totcal != 0){
            $suma = $obj->totcal;
            $total = $obj->toteval;
            $calact = $suma/$total;
            $calact = number_format($calact, 2);
            $sumatotal += $calact;
            $canttot++;
        }
    }

    $query = "SELECT SUM(cal) as totcal, count(*) as toteval FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'HSE'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        if($obj->totcal != 0){
            $suma = $obj->totcal;
            $total = $obj->toteval;
            $calhse = $suma/$total;
            $calhse = number_format($calhse, 2);
            $sumatotal += $calhse;
            $canttot++;
        }
    }

    $query = "SELECT SUM(cal) as totcal, count(*) as toteval FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Administrativos y Laborales'";
    $eje = mysqli_query($conexion, $query);
    $cont = mysqli_num_rows($eje);

    if($cont!=0){
        $obj=mysqli_fetch_object($eje);
        if($obj->totcal != 0){
            $suma = $obj->totcal;
            $total = $obj->toteval;
            $caladmin = $suma/$total;
            $caladmin = number_format($caladmin, 2);
            $sumatotal += $caladmin;
            $canttot++;
        }
    }
    
    $prom = $sumatotal/$canttot;
    $prom = number_format($prom, 2);

    $datos[] = array(
        'idprov'=>$row->idprov,
        'proveedor'=>$row->proveedor,
        'ods' => $row->ods,
        'fecha'=> $row->fecha,
        'evaluador'=>$row->evaluador,
        'calact'=>$calact,
        'calqaqc'=>$calqaqc,
        'calhse'=>$calhse,
        'caladmin'=>$caladmin,
        'cal'=>$prom
    );

}

echo json_encode($datos);
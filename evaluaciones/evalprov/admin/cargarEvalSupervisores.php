<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];
$ods = $_POST["ods"];

$query = "SELECT * FROM evaluacionsup Where doc='$doc' and ods='$ods'";
$eje = mysqli_query($conexion, $query);

$canteval = 0;

while($obj = mysqli_fetch_object($eje)){

    $cargoeval = $obj->cargoeval;
    $nombre = $obj->nombre;
    $cargo = $obj->cargo;

    $cal = $obj->cal;
    $sum += $cal;
    $canteval++;


    if($cargoeval != 'LÍDER HSE' && $cargoeval != 'LÍDER QAQC' && $cargoeval != 'LÍDER LOGÍSTICA' AND $cargoeval != 'LÍDER PLANEACIÓN'){
        $nomjefe = $obj->evaluador;
        $fechajefe = $obj->fecha;
        $obsjefe = $obj->observaciones;
        $compjefe = $obj->compromisos;
        $planesjefe = $obj->planes;
        $codeval = $obj->cod;
        $pinicial = $obj->pinicial;
        $pfinal = $obj->pfinal;
        $caljefe = $obj->cal;

        $sql = "SELECT * FROM calevalsup Where cod = '$codeval'";
        $cons = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_object($cons)){
            $preg = $row->preg;
            switch ($preg){
                case "p1":
                    $p1 = intval($row->cal);
                break;
                case "p2":
                    $p2 = intval($row->cal);
                break;
                case "p3":
                    $p3 = intval($row->cal);
                break;
                case "p4":
                    $p4 = intval($row->cal);
                break;
                case "p5":
                    $p5 = intval($row->cal);
                break;
                case "p6":
                    $p6 = intval($row->cal);
                break;
                case "p7":
                    $p7 = intval($row->cal);
                break;
                case "p8":
                    $p8 = intval($row->cal);
                break;
                case "p9":
                    $p9 = intval($row->cal);
                break;
                case "p10":
                    $p10 = intval($row->cal);
                break;
                case "p11":
                    $p11 = intval($row->cal);
                break;
            }
        }
    }

    if($cargoeval == 'LÍDER HSE'){
        $nomhse = $obj->evaluador;
        $fechahse = $obj->fecha;
        $obshse = $obj->observaciones;
        $comphse = $obj->compromisos;
        $planeshse = $obj->planes;
        $codeval = $obj->cod;
        $calhse = $obj->cal;

        $sql = "SELECT * FROM calevalsup Where cod = '$codeval'";
        $cons = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_object($cons)){
            $preg = $row->preg;
            switch ($preg){
                case "p15a":
                    $p15a = intval($row->cal);
                break;
                case "p15b":
                    $p15b = intval($row->cal);
                break;
                case "p15c":
                    $p15c = intval($row->cal);
                break;
                case "p16a":
                    $p16a = intval($row->cal);
                break;
                case "p16b":
                    $p16b = intval($row->cal);
                break;
                case "p17a":
                    $p17a = intval($row->cal);
                break;
                case "p17b":
                    $p17b = intval($row->cal);
                break;
                case "p17c":
                    $p17c = intval($row->cal);
                break;
                case "p18a":
                    $p18a = intval($row->cal);
                break;
                case "p18b":
                    $p18b = intval($row->cal);
                break;
            }
        }
    }

    if($cargoeval == 'LÍDER PLANEACIÓN'){
        $nomplan = $obj->evaluador;
        $fechaplan = $obj->fecha;
        $obsplan = $obj->observaciones;
        $compplan = $obj->compromisos;
        $planesplan = $obj->planes;
        $codeval = $obj->cod;
        $calplan = $obj->cal;

        $sql = "SELECT * FROM calevalsup Where cod = '$codeval'";
        $cons = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_object($cons)){
            $preg = $row->preg;
            switch ($preg){
                case "p12a":
                    $p12a = intval($row->cal);
                break;
                case "p12b":
                    $p12b = intval($row->cal);
                break;
                case "p13a":
                    $p13a = intval($row->cal);
                break;
                case "p13b":
                    $p13b = intval($row->cal);
                break;
                case "p13c":
                    $p13c = intval($row->cal);
                break;
                case "p14a":
                    $p14a = intval($row->cal);
                break;
                case "p14b":
                    $p14b = intval($row->cal);
                break;
                case "p14c":
                    $p14c = intval($row->cal);
                break;
                case "p14d":
                    $p14d = intval($row->cal);
                break;
                case "p14e":
                    $p14e = intval($row->cal);
                break;
            }
        }
    }

    if($cargoeval == 'LÍDER QAQC'){
        $nomq = $obj->evaluador;
        $fechaq = $obj->fecha;
        $obsq = $obj->observaciones;
        $compq = $obj->compromisos;
        $planesq = $obj->planes;
        $codeval = $obj->cod;
        $calq = $obj->cal;

        $sql = "SELECT * FROM calevalsup Where cod = '$codeval'";
        $cons = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_object($cons)){
            $preg = $row->preg;
            switch ($preg){
                case "p20a":
                    $p20a = intval($row->cal);
                break;
                case "p20b":
                    $p20b = intval($row->cal);
                break;
                case "p20c":
                    $p20c = intval($row->cal);
                break;
                case "p20d":
                    $p20d = intval($row->cal);
                break;
                case "p20e":
                    $p20e = intval($row->cal);
                break;
                case "p21":
                    $p21 = intval($row->cal);
                break;
            }
        }
    }

    if($cargoeval == 'LÍDER LOGÍSTICA'){
        $nomlog = $obj->evaluador;
        $fechalog = $obj->fecha;
        $obslog = $obj->observaciones;
        $complog = $obj->compromisos;
        $planeslog = $obj->planes;
        $codeval = $obj->cod;
        $callog = $obj->cal;

        $sql = "SELECT * FROM calevalsup Where cod = '$codeval'";
        $cons = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_object($cons)){
            $preg = $row->preg;
            switch ($preg){
                case "p19a":
                    $p19a = intval($row->cal);
                break;
                case "p19b":
                    $p19b = intval($row->cal);
                break;
            }
        }
    }

}

$prom = $sum / $canteval;


$datos = array(
    'nombre'=>$nombre,
    'doc'=>$doc,
    'cargo'=>$cargo,
    'nomjefe'=>$nomjefe,
    'fechajefe'=>$fechajefe,
    'obsjefe'=>$obsjefe,
    'compjefe' => $compjefe,
    'planesjefe'=> $planesjefe,
    'pinicial'=> $pinicial,
    'pfinal'=>$pfinal,
    'cal'=>$prom,
    'cod'=>$codeval,
    'p1'=>$p1,
    'p2'=>$p2,
    'p3'=>$p3,
    'p4'=>$p4,
    'p5'=>$p5,
    'p6'=>$p6,
    'p7'=>$p7,
    'p8'=>$p8,
    'p9'=>$p9,
    'p10'=>$p10,
    'p11'=>$p11,
    'nomplan'=>$nomplan,
    'fechaplan'=>$fechaplan,
    'obsplan'=>$obsplan,
    'compplan' => $compplan,
    'planesplan'=>$planesplan,
    'calplan'=>$calplan,
    'p12a'=>$p12a,
    'p12b'=>$p12b,
    'p13a'=>$p13a,
    'p13b'=>$p13b,
    'p13c'=>$p13c,
    'p14a'=>$p14a,
    'p14b'=>$p14b,
    'p14c'=>$p14c,
    'p14d'=>$p14d,
    'p14e'=>$p14e,
    'nomhse'=>$nomhse,
    'fechahse'=>$fechahse,
    'obshse'=>$obshse,
    'comphse' => $comphse,
    'planeshse'=>$planeshse,
    'calhse'=>$calhse,
    'p15a'=>$p15a,
    'p15b'=>$p15b,
    'p15c'=>$p15c,
    'p16a'=>$p16a,
    'p16b'=>$p16b,
    'p17a'=>$p17a,
    'p17b'=>$p17b,
    'p17c'=>$p17c,
    'p18a'=>$p18a,
    'p18b'=>$p18b,
    'nomq'=>$nomq,
    'fechaq'=>$fechaq,
    'obsq'=>$obsq,
    'compq' => $compq,
    'planesq'=>$planesq,
    'calq'=>$calq,
    'p20a'=>$p20a,
    'p20b'=>$p20b,
    'p20c'=>$p20c,
    'p20d'=>$p20d,
    'p20e'=>$p20e,
    'p21'=>$p21,
    'nomlog'=>$nomlog,
    'fechalog'=>$fechalog,
    'obslog'=>$obslog,
    'complog' => $complog,
    'planeslog'=>$planeslog,
    'callog'=>$callog,
    'p19a'=>$p19a,
    'p19b'=>$p19b,
);

echo json_encode($datos);
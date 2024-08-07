<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];
$ods = $_POST["ods"];

$sql = "SELECT * FROM evalprov Where idprov='$id' and ods='$ods' GROUP BY idprov, ods order by proveedor";
$exito = mysqli_query($conexion, $sql);

$canteval = 0;

while($row = mysqli_fetch_object($exito)){

    $proveedor = $row->proveedor;
    $idprov = $row->idprov;
    $ods = $row->ods;

    $query = "SELECT * FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Ejecución de actividades'";
    $eje = mysqli_query($conexion, $query);
    $cont1 = mysqli_num_rows($eje);

    if($cont1!=0){
        while($obj=mysqli_fetch_object($eje)){
            if($obj->cal != 0){
                $nomact = $obj->evaluador;
                $obsact = $obj->observacion;
                $fechaact = $obj->fecha;
                $preg = $obj->numpreg;
    
                switch ($preg){
                    case "p1a":
                        $p1a = intval($obj->cal);
                        $sum += $p1a;
                        $canteval++;
                    break;
                    case "p1b":
                        $p1b = intval($obj->cal);
                        $sum += $p1b;
                        $canteval++;
                    break;
                    case "p1c":
                        $p1c = intval($obj->cal);
                        $sum += $p1b;
                        $canteval++;
                    break;
                }
            }
        }
    }

    $query = "SELECT * FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Calidad'";
    $eje = mysqli_query($conexion, $query);
    $cont2 = mysqli_num_rows($eje);

    if($cont2!=0){
        while($obj=mysqli_fetch_object($eje)){
            if($obj->cal != 0){
            $nomcalidad = $obj->evaluador;
            $obscalidad = $obj->observacion;
            $fechacalidad = $obj->fecha;
            $preg = $obj->numpreg;

            switch ($preg){
                case "p2a":
                    $p2a = intval($obj->cal);
                    $sum += $p2a;
                    $canteval++;
                break;
                case "p2b":
                    $p2b = intval($obj->cal);
                    $sum += $p2b;
                    $canteval++;
                break;
                case "p2c":
                    $p2c = intval($obj->cal);
                    $sum += $p2c;
                    $canteval++;
                break;
                case "p2d":
                    $p2d = intval($obj->cal);
                    $sum += $p2d;
                    $canteval++;
                break;
                case "p2e":
                    $p2e = intval($obj->cal);
                    $sum += $p2e;
                    $canteval++;
                break;
            }
        }
        }
    }

    $query = "SELECT * FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'HSE'";
    $eje = mysqli_query($conexion, $query);
    $cont3 = mysqli_num_rows($eje);

    if($cont3!=0){
        while($obj=mysqli_fetch_object($eje)){
            if($obj->cal != 0){
                $nomhse = $obj->evaluador;
                $obshse = $obj->observacion;
                $fechahse = $obj->fecha;
                $preg = $obj->numpreg;

                switch ($preg){
                    case "p3a":
                        $p3a = intval($obj->cal);
                        $sum += $p3a;
                        $canteval++;
                    break;
                    case "p3b":
                        $p3b = intval($obj->cal);
                        $sum += $p3b;
                        $canteval++;
                    break;
                    case "p3c":
                        $p2c = intval($obj->cal);
                        $sum += $p3c;
                        $canteval++;
                    break;
                    case "p3d":
                        $p3d = intval($obj->cal);
                        $sum += $p3d;
                        $canteval++;
                    break;
                    case "p3e":
                        $p3e = intval($obj->cal);
                        $sum += $p3e;
                        $canteval++;
                    break;
                }
            }else{
                $nomhse = "";
                $obshse = "";
                $fechahse = "";
                $p3a = '-';
                $p3b = '-';
                $p3c = '-';
                $p3d = '-';
                $p3e = '-';
            }
        }
    }

    $query = "SELECT * FROM evalprov WHERE idprov = '$idprov' AND ods = '$ods' AND aspecto = 'Administrativos y Laborales'";
    $eje = mysqli_query($conexion, $query);
    $cont4 = mysqli_num_rows($eje);

    if($cont4!=0){
        while($obj=mysqli_fetch_object($eje)){
            if($obj->cal != 0){
            $nomadmin = $obj->evaluador;
            $obsadmin = $obj->observacion;
            $fechaadmin = $obj->fecha;
            $preg = $obj->numpreg;

            switch ($preg){
                case "p4a":
                    $p4a = intval($obj->cal);
                    $sum += $p4a;
                    $canteval++;
                break;
                case "p4b":
                    $p4b = intval($obj->cal);
                    $sum += $p4b;
                    $canteval++;
                break;
                case "p4c":
                    $p4c = intval($obj->cal);
                    $sum += $p4c;
                    $canteval++;
                break;
            }
        }
        }
    }
   
}

$prom = $sum / $canteval;
$prom = number_format($prom, 2);


$datos = array(
    'proveedor'=>$proveedor,
    'ods'=>$ods,
    'nomact'=>$nomact,
    'fechaact'=>$fechaact,
    'obsact'=>$obsact,
    'p1a'=>$p1a,
    'p1b'=>$p1b,
    'p1c'=>$p1c,
    'nomcalidad'=>$nomcalidad,
    'fechacalidad'=>$fechacalidad,
    'obscalidad'=>$obscalidad,
    'p2a'=>$p2a,
    'p2b'=>$p2b,
    'p2c'=>$p2c,
    'p2d'=>$p2d,
    'p2e'=>$p2e,
    'nomhse'=>$nomhse,
    'fechahse'=>$fechahse,
    'obshse'=>$obshse,
    'p3a'=>$p3a,
    'p3b'=>$p3b,
    'p3c'=>$p3c,
    'p3d'=>$p3d,
    'p3e'=>$p3e,
    'nomadmin'=>$nomadmin,
    'fechaadmin'=>$fechaadmin,
    'obsadmin'=>$obsadmin,
    'p4a'=>$p4a,
    'p4b'=>$p4b,
    'p4c'=>$p4c,
    'prom'=>$prom,
    'canteval'=>$canteval
);

echo json_encode($datos);
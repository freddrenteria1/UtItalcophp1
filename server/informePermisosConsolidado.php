<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$ods = $_POST["ods"];
$finicio = $_POST["finicio"];
$ffin = $_POST["ffin"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

    $sql="SELECT * FROM permisostrabfinal WHERE ods = '$ods' AND fecha='$finicio'";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){

        $pfrio += $row->pfrio;
        $pcaliente += $row->pcaliente;
        $pelectrico += $row->pelectrico;
        $ramm += $row->ramm;
        $ramh += $row->ramh;
        $ramvh += $row->ramvh;
        $ca1 += $row->ca1;
        $ca2 += $row->ca2;
        $ca3 += $row->ca3;
        $ca5 += $row->ca5;
        $ca6 += $row->ca6;
        $ca7 += $row->ca7;
        $sas += $row->sas;
        $saes += $row->saes;
        $pra += $row->pra;
        $prc += $row->prc;    
        $prg += $row->prg;

        $esp = $row->especialidad;

        if($esp == 'AUTOMOTOR'){
            $espauto++;
        }
        if($esp == 'LOGISTICA'){
            $esplog++;
        }
        if($esp == 'INSPECCION'){
            $espinsp++;
        }
        if($esp == 'ANDAMIOS'){
            $espandamios++;
        }
         
        if($esp == 'ELÉCTRICO'){
            $espelec++;
        }
        if($esp == 'METALMECÁNICA'){
            $espmetal++;
        }
        if($esp == 'MECANICO'){
            $espmeca++;
        }
        if($esp == 'AISLAMIENTO'){
            $espaila++;
        }
        if($esp == 'INSTRUMENTACION'){
            $espinst++;
        }
        if($esp == 'PINTURA'){
            $esppint++;
        }


        
        $prevalidados += $row->prevalidados;
        $pnuevos += $row->pnuevos;
        $pcerrados += $row->pcerrados;

        $tabla[] = array(
            'id' => $row->id,
            'num'=>$row->num,
            'empresa'=>$row->empresa,
            'pfrio'=>$row->pfrio,
            'pcaliente'=>$row->pcaliente,
            'pelectrico'=>$row->pelectrico,
            'actividad'=>$row->actividad,
            'especialidad'=>$row->especialidad,
            'supervisor'=>$row->supervisor,
            'area'=>$row->area,
            'equipo'=>$row->equipo,
            'planta'=>$row->planta,
            'ramm'=>$row->ramm,
            'ramh'=>$row->ramh,
            'ramvh'=>$row->ramvh,
            'ca1'=>$row->ca1,
            'ca2'=>$row->ca2,
            'ca3'=>$row->ca3,
            'ca5'=>$row->ca5,
            'ca6'=>$row->ca6,
            'ca7'=>$row->ca7,
            'sas'=>$row->sas,
            'saes'=>$row->saes,
            'pra'=>$row->pra,
            'prc'=>$row->prc,
            'prg'=>$row->prg,
            'cvias'=>$row->cvias,
            'pizaje'=>$row->pizaje,
            'agua'=>$row->agua,
            'prevalidados'=>$row->prevalidados,
            'pnuevos'=>$row->pnuevos,
            'pcerrados'=>$row->pcerrados,
            'numpcerrado'=>$row->numpcerrado,
            'personas'=>$row->personas,
            'observaciones'=>$row->observaciones
        );
    }  

    $query="SELECT * FROM observacionespermisos WHERE ods = '$ods' AND fecha='$fecha'";
    $eje=mysqli_query($conexion, $query);

    $row = mysqli_fetch_object($eje);

    $observaciones = $row->observaciones;
    $personal = $row->personal;

    $total = $pfrio+$pcaliente+$pelectrico;
    $totalmatriz = $ramh+$ramm+$ramvh;
    $totalca = $ca1 + $ca2 + $ca3 + $ca5 + $ca6 + $ca7 + $sas + $saes;
    $totalpr = $pra + $prc + $prg;

    $datos = array(
        'pfrio'=>$pfrio,
        'pcaliente'=>$pcaliente,
        'pelectrico'=>$pelectrico,
        'totalp'=>$total,
        'ramm'=>$ramm,
        'ramh'=>$ramh,
        'ramvh'=>$ramvh,
        'totalmatriz'=>$totalmatriz,
        'ca1'=>$ca1,
        'ca2'=>$ca2,
        'ca3'=>$ca3,
        'ca5'=>$ca5,
        'ca6'=>$ca6,
        'ca7'=>$ca7,
        'sas'=>$sas,
        'saes'=>$saes,
        'totalca'=>$totalca,
        'pra'=>$pra,
        'prc'=>$prc,
        'prg'=>$prg,
        'totalpr'=>$totalpr,
        'prevalidados'=>$prevalidados,
        'pnuevos'=>$pnuevos,
        'pcerrados'=>$pcerrados,
        'observaciones'=>$observaciones,
        'personal'=>$personal,
        'espauto'=>$espauto,
        'esplog'=>$esplog,
        'espandamios'=>$espandamios,
        'espelec'=>$espelec,
        'espmetal'=>$espmetal,
        'espaila'=>$espaila,
        'espinst'=>$espinst,
        'esppint'=>$esppint,
        'tabla'=>$tabla
     );

echo json_encode($datos);
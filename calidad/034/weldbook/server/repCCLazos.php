<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$buscar = "SELECT * FROM cclazos GROUP BY actividad";
$ejeb = mysqli_query($conexion, $buscar);

while($row = mysqli_fetch_object($ejeb)){

    $act[] = array(
        'actividad'=>$row->actividad
    );

}

$cont = count($act);


$sql="SELECT * FROM cclazos GROUP BY  lazo, isometrico";
$exito=mysqli_query($conexion, $sql);

while( $obj = mysqli_fetch_object($exito)){  

    $lazo = $obj->lazo;
    $iso = $obj->isometrico;

    $query = "SELECT * FROM cclazos WHERE lazo='$lazo' AND isometrico = '$iso'";
    $ejeq = mysqli_query($conexion, $query);

    $act1p=0;
    $act1e=0;
    $act2p=0;
    $act2e=0;
    $act3p=0;
    $act3e=0;
    $act4p=0;
    $act4e=0;
    $act5p=0;
    $act5e=0;
    $act6p=0;
    $act6e=0;
    $act7p=0;
    $act7e=0;

    while($row = mysqli_fetch_object($ejeq)){

        if($row->actividad == 'CAMBIAR TRACING' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act1p++;
        }
        if($row->actividad == 'CAMBIAR TRACING' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act1e++;
        }

        if($row->actividad == 'CAMBIAR VALVULA BRIDADA' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act2p++;
        }
        if($row->actividad == 'CAMBIAR VALVULA BRIDADA' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act2e++;
        }

        if($row->actividad == 'CAMBIAR VENTEO' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act3p++;
        }
        if($row->actividad == 'CAMBIAR VENTEO' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act3e++;
        }

        if($row->actividad == 'CAMBIO DE LINEA' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act4p++;
        }
        if($row->actividad == 'CAMBIO DE LINEA' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act4e++;
        }

        if($row->actividad == 'ELIMINACION DE VENTEO' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act5p++;
        }
        if($row->actividad == 'ELIMINACION DE VENTEO' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act5e++;
        }

        if($row->actividad == 'MANTENIMIENTO DE VALVULA BRIDADA' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act6p++;
        }
        if($row->actividad == 'MANTENIMIENTO DE VALVULA BRIDADA' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act6e++;
        }

        if($row->actividad == 'SOLDADURA DE SELLO' && $row->ejecucion != 'NA' && $row->ejecucion != ''){
            $act7p++;
        }
        if($row->actividad == 'SOLDADURA DE SELLO' && $row->ejecucion != 'NA' && $row->ejecucion != 'X' && $row->ejecucion != '' && $row->verificacion != 'NA' && $row->verificacion != 'X' && $row->verificacion != ''){
            $act7e++;
        }

        

    }

    $sprog = $act1p + $act2p + $act3p + $act4p + $act5p + $act6p + $act7p;
    $seje = $act1e + $act2e + $act3e + $act4e + $act5e + $act6e + $act7e;

    if($seje != 0){
        $avtot = round(($seje/$sprog)*100, 2);
    }else{
        $avtot = 0;
    }

    $avact1 = 0;
    $avact2 = 0;
    $avact3 = 0;
    $avact4 = 0;
    $avact5 = 0;
    $avact6 = 0;
    $avact7 = 0;


    if($act1e != 0){
        $avact1 = round(($act1e/$act1p)*100, 2);
    }

    if($act2e != 0){
        $avact2 = round(($act2e/$act2p)*100, 2);
    }

    if($act3e != 0){
        $avact3 = round(($act3e/$act3p)*100, 2);
    }

    if($act4e != 0){
        $avact4 = round(($act4e/$act4p)*100, 2);
    }

    if($act5e != 0){
        $avact5 = round(($act5e/$act5p)*100, 2);
    }

    if($act6e != 0){
        $avact6 = round(($act6e/$act6p)*100, 2);
    }

    if($act7e != 0){
        $avact7 = round(($act7e/$act7p)*100, 2);
    }


    $actividades[] = array(
        'lazo'=>$lazo,
        'isometrico'=>$iso,
        'act1p'=>$act1p,
        'act1e'=>$act1e,
        'avact1'=>$avact1,
        'act2p'=>$act2p,
        'act2e'=>$act2e,
        'avact2'=>$avact2,
        'act3p'=>$act3p,
        'act3e'=>$act3e,
        'avact3'=>$avact3,
        'act4p'=>$act4p,
        'act4e'=>$act4e,
        'avact4'=>$avact4,
        'act5p'=>$act5p,
        'act5e'=>$act5e,
        'avact5'=>$avact5,
        'act6p'=>$act6p,
        'act6e'=>$act6e,
        'avact6'=>$avact6,
        'act7p'=>$act7p,
        'act7e'=>$act7e,
        'avact7'=>$avact7,
        'sprog'=>$sprog,
        'seje'=>$seje,
        'avtot'=>$avtot
    );
    

}

echo json_encode($actividades);   
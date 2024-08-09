<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//  $ods = '021';
//  $fecha = '2022-01-09';

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];


//INICIO POR TURNOS

$sql="SELECT * FROM personaldiario WHERE ods='$ods' AND fecha = '$fecha' GROUP BY jornada";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $arrayTurnos[] = array(
        'jornada' => $obj->jornada
    );
}

$sql="SELECT * FROM personaldiario WHERE ods='$ods' AND fecha = '$fecha' GROUP BY planta";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $arrayPlantas[] = array(
        'planta' => $obj->planta
    );
}

$sql="SELECT fecha, ods, planta, jornada, SUM(pdir) as totdir, SUM(pindir) as totindir, SUM(tp) as totpers, SUM(hdir) as tothdir, SUM(hindir) as tothindir, SUM(th) as toth FROM personaldiario WHERE ods='$ods' AND fecha = '$fecha' GROUP BY jornada";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $arrayPersonalTurnos[] = array(
        'ods'=>$obj->ods,
        'fecha'=>$obj->fecha,
        'jornada'=>$obj->jornada,
        'directo' => intval($obj->totdir),
        'indirecto' => intval($obj->totindir),
        'totalpersonal' => intval($obj->totpers)
    );
}



$sqlg = "SELECT SUM(hdirectos) as totHDirectos, SUM(hindirectos) as totHIndirectos, SUM(totalhoras) as totHoras FROM horasacumuladas Where ods='$ods' and fecha <= '$fecha' ORDER BY fecha";
$consg = mysqli_query($conexion, $sqlg);

$filag = mysqli_fetch_object($consg);

$acumHDirectos = $filag->totHDirectos;
$acumHIndirectos = $filag->totHIndirectos;
$acumHHTotal = $filag->totHoras;


//TOTAL PERSONAL
$sql = "SELECT SUM(tp) as totper FROM personaldiario Where ods='$ods'";
$cons = mysqli_query($conexion, $sql);
$row = mysqli_fetch_object($cons);

$totalPersonal = $row->totper;

$totConv = $totalPersonal * 0.25;



    $sqlh = "SELECT frente, SUM(directo) as directos, SUM(indirecto) as indirectos, SUM(total) as total FROM turnosdiarios Where fecha='$fecha' and ods = '024' ";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    $filah = mysqli_fetch_object($ejeh);

 
        $directosp24 = intval($filah->directos);
        $indirectosp24 = intval($filah->indirectos);
        $totalp24 = intval($filah->total);
        
        $personal24 = array(
            'directos'=>intval($filah->directos),
            'indirectos'=>intval($filah->indirectos),
            'total'=>intval($filah->total)
        );
 
    $sqlh = "SELECT frente, SUM(hdir) as hdir, SUM(hindir) as hindir, SUM(thh) as thh FROM turnosdiarios Where fecha='$fecha' and ods = '024'  AND fecha <='$fecha'";
    $ejeh = mysqli_query($conexion, $sqlh);

    $filah = mysqli_fetch_object($ejeh);
    
 
        $directosh24 = intval($filah->hdir);
        $indirectosh24 = intval($filah->hindir);
        $totalh24 = intval($filah->thh);
        
        $personalhoras24 = array(
            'hdir'=>intval($filah->hdir),
            'hindir'=>intval($filah->hindir),
            'thh'=>intval($filah->thh)
        );
 
    $sqlh = "SELECT frente, SUM(directo) as directos, SUM(indirecto) as indirectos, SUM(total) as total FROM turnosdiarios Where fecha='$fecha' and ods = '$ods' ";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    $filah = mysqli_fetch_object($ejeh);

        $directosp26 = intval($filah->directos);
        $indirectosp26 = intval($filah->indirectos);
        $totalp26 = intval($filah->total);

        $personal26 = array(
            'directos'=>intval($filah->directos),
            'indirectos'=>intval($filah->indirectos),
            'total'=>intval($filah->total)
        );
    

    $sqlh = "SELECT frente, SUM(hdir) as hdir, SUM(hindir) as hindir, SUM(thh) as thh FROM turnosdiarios Where fecha='$fecha' and ods = '$ods'  AND fecha <='$fecha'";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    $filah = mysqli_fetch_object($ejeh);

        $directosh26 = intval($filah->hdir);
        $indirectosh26 = intval($filah->hindir);
        $totalh26 = intval($filah->thh);
        
        $personalhoras26 = array(
            'hdir'=>intval($filah->hdir),
            'hindir'=>intval($filah->hindir),
            'thh'=>intval($filah->thh)
        );

        $personaluop = array(
            'directos'=>$directosp26+$directosp24,
            'indirectos'=>$indirectosp26+$indirectosp24,
            'total'=>$totalp26+$totalp24
        );

        $personalhuop = array(
            'directos'=>$directosh26+$directosh24,
            'indirectos'=>$indirectosh26+$indirectosh24,
            'total'=>$totalh26+$totalh24
        );
    
    

    $sqlh = "SELECT frente, SUM(hdir) as hdir, SUM(hindir) as hindir, SUM(thh) as thh FROM turnosdiarios Where ods = '024'  AND frente != 'PREFABRICADO EXTERNO' AND fecha <='$fecha'";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    $filah = mysqli_fetch_object($ejeh);

    $horasdirectos24 = intval($filah->hdir);
    $horasindirectos24 = intval($filah->hindir);
    $horastotales24 = intval($filah->thh);
        
    $acumuladoprefabricado = array(
        'hdirAcum'=>intval($filah->hdir),
        'hindirAcum'=>intval($filah->hindir),
        'thhAcum'=>intval($filah->thh)
    );

    $sqlh = "SELECT frente, SUM(hdir) as hdir, SUM(hindir) as hindir, SUM(thh) as thh FROM turnosdiarios Where ods = '026'  AND fecha <='$fecha'";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    $filah = mysqli_fetch_object($ejeh);

    $horasdirectos26 = intval($filah->hdir);
    $horasindirectos26 = intval($filah->hindir);
    $horastotales26 = intval($filah->thh);
        
    $acumuladoalistamiento = array(
        'hdirAcum'=>intval($filah->hdir),
        'hindirAcum'=>intval($filah->hindir),
        'thhAcum'=>intval($filah->thh)
    );

    // $totalods = array(
    //     'hdirAcum'=>$horasdirectos24+$horasdirectos26,
    //     'hindirAcum'=>$horasindirectos24+$horasindirectos26,
    //     'thhAcum'=>$horastotales24+$horastotales26
    // );

    $acumHDirectos = $horasdirectos24+$horasdirectos26;
    $acumHIndirectos = $horasindirectos24+$horasindirectos26;
    $acumHHTotal = $horastotales24+$horastotales26;
        
    
    
    $sqlh = "SELECT * FROM personaldiario Where ods = '$ods' And fecha='$fecha' AND planta = 'ITALCO'";
    $ejeh = mysqli_query($conexion, $sqlh);
    
    while($filah = mysqli_fetch_object($ejeh)){

        $arrayPersonalPlanta[] = array(
            'ods'=>$ods,
            'fecha'=>$fecha,
            'planta'=>$filah->planta,
            'directo' => intval($filah->pdir),
            'indirecto' => intval($filah->pindir),
            'totalpersonal' => intval($filah->tp),
            'hdir'=>intval($filah->hdir),
            'hindir'=>intval($filah->hindir),
            'toth'=>intval($filah->th)
        );
    }


    $sql2="SELECT * FROM hcap WHERE  ods LIKE '%$ods%'";
    $exito2=mysqli_query($conexion, $sql2);

    while($fila = mysqli_fetch_object($exito2)){
        if($fila->fase == 'FASE I'){
            $fase1+=$fila->horas;
        }
        if($fila->fase == 'FASE II'){
            $fase2+=$fila->horas;
        }
        if($fila->fase == 'FASE III'){
            $fase3+=$fila->horas;
        }
        if($fila->fase == 'OTROS'){
            $otros=$fila->horas;
        }
    }

    $query3 = "SELECT SUM(total) as totp From turnosdiarios Where ods='$ods'";
    $eje3 = mysqli_query($conexion, $query3);

    $rowf = mysqli_fetch_object($eje3);

    $totp = $rowf->totp;

    $hcap = ($totp * 15)/60;



$datos = array(
    'arrayFrentesTit'=>$frentestrabtit,
    'personalfrentes'=>$personalfrentes,
    'personal24'=>$personal24,
    'personal26'=>$personal26,
    'personalhoras24'=>$personalhoras24,
    'personalhoras26'=>$personalhoras26,
    'personaluop'=>$personaluop,
    'personalhuop'=>$personalhuop,
    'personalfrenteshoras'=>$personalfrenteshoras,
    'arrayTurnos' => $arrayTurnos,
    'arrayPersonalTurnos' => $arrayPersonalTurnos,
    'acumHDirectos' => intval($acumHDirectos),
    'acumHIndirectos' => intval($acumHIndirectos),
    'acumHHTotal' => intval($acumHHTotal),
    'acumuladoprefabricado'=>$acumuladoprefabricado,
    'acumuladoalistamiento'=>$acumuladoalistamiento,
    'totConv'=>$totConv,
    'arrayPersonalPlanta'=>$arrayPersonalPlanta,
    'fase1'=>intval($fase1),
    'fase2'=>intval($fase2),
    'fase3'=>intval($fase3),
    'otros'=>intval($otros),
    'hcap'=>$hcap
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccpuntos GROUP BY isometrico";
$exito=mysqli_query($conexion, $sql);


while( $obj = mysqli_fetch_object($exito)){  

    $iso = $obj->isometrico;

    $cont = 0;

    $armandamioprog=0;
    $armandamioeje=0;
    $retaislamientoprog=0;
    $retaislamientoeje=0;
    $limpiezaprog=0;
    $limpiezaeje=0;
    $insputespprog=0;
    $insputespeje=0;
    $rtpostinspprog=0;
    $rtpostinspeje=0;
    $ejertprog=0;
    $ejerteje=0;
    $vobocieprog=0;
    $vobocieeje=0;
    $pinturaprog=0;
    $pinturaeje=0;
    $aislamientoprog=0;
    $aislamientoeje=0;
    $desarmandamioprog=0;
    $desarmandamioeje=0;
    $regcontrolprog=0;
    $regcontroleje=0;

    $buscar = "SELECT * FROM ccpuntos WHERE isometrico = '$iso'";
    $eje = mysqli_query($conexion, $buscar);

    while( $row = mysqli_fetch_object($eje)){  

        $cont++;

        if($row->armandamio != 'NA' && $row->armandamio != ''){
            $armandamioprog++;
        }
        if($row->armandamio != 'NA' && $row->armandamio != 'X' && $row->armandamio != ''){
            $armandamioeje++;
        }

        if($row->retaislamiento != 'NA' && $row->retaislamiento != ''){
            $retaislamientoprog++;
        }
        if($row->retaislamiento != 'NA' && $row->retaislamiento != 'X' && $row->retaislamiento != ''){
            $retaislamientoeje++;
        }

        if($row->limpieza != 'NA' && $row->limpieza != ''){
            $limpiezaprog++;
        }
        if($row->limpieza != 'NA' && $row->limpieza != 'X' && $row->limpieza != ''){
            $limpiezaeje++;
        }

        if($row->insputesp != 'NA' && $row->insputesp != ''){
            $insputespprog++;
        }
        if($row->insputesp != 'NA' && $row->insputesp != 'X' && $row->insputesp != ''){
            $insputespeje++;
        }

        if($row->rtpostinsp != 'NA' && $row->rtpostinsp != ''){
            $rtpostinspprog++;
        }
        if($row->rtpostinsp != 'NA' && $row->rtpostinsp != 'X' && $row->rtpostinsp != ''){
            $rtpostinspeje++;
        }

        if($row->ejert != 'NA' && $row->ejert != ''){
            $ejertprog++;
        }
        if($row->ejert != 'NA' && $row->ejert != 'X' && $row->ejert != ''){
            $ejerteje++;
        }

        if($row->vobocie != 'NA' && $row->vobocie != ''){
            $vobocieprog++;
        }
        if($row->vobocie != 'NA' && $row->vobocie != 'X' && $row->vobocie != ''){
            $vobocieeje++;
        }

        if($row->pintura != 'NA' && $row->pintura != ''){
            $pinturaprog++;
        }
        if($row->pintura != 'NA' && $row->pintura != 'X' && $row->pintura != ''){
            $pinturaeje++;
        }

        if($row->aislamiento != 'NA' && $row->aislamiento != ''){
            $aislamientoprog++;
        }
        if($row->aislamiento != 'NA' && $row->aislamiento != 'X' && $row->aislamiento != ''){
            $aislamientoeje++;
        }

        if($row->desarmandamio != 'NA' && $row->desarmandamio != ''){
            $desarmandamioprog++;
        }
        if($row->desarmandamio != 'NA' && $row->desarmandamio != 'X' && $row->desarmandamio != ''){
            $desarmandamioeje++;
        }

        if($row->regcontrol != 'NA' && $row->regcontrol != ''){
            $regcontrolprog++;
        }
        if($row->regcontrol != 'NA' && $row->regcontrol != 'X' && $row->regcontrol != ''){
            $regcontroleje++;
        }

    }

    if($armandamioeje != 0){
        $aarmandamio = round(($armandamioeje/$armandamioprog)*100, 2);
    }else{
        $aarmandamio = 0;
    }

    if($retaislamientoeje != 0){
        $aretaislamiento = round(($retaislamientoeje/$retaislamientoprog)*100, 2);
    }else{
        $aretaislamiento = 0;
    }

    if($limpiezaeje != 0){
        $alimpieza = round(($limpiezaeje/$limpiezaprog)*100, 2);
    }else{
        $alimpieza = 0;
    }

    if($insputespeje != 0){
        $ainsputesp = round(($insputespeje/$insputespprog)*100, 2);
    }else{
        $ainsputesp = 0;
    }

    if($rtpostinspeje != 0){
        $artpostinsp = round(($rtpostinspeje/$rtpostinspprog)*100, 2);
    }else{
        $artpostinsp = 0;
    }

    if($ejerteje != 0){
        $aejert = round(($ejerteje/$ejertprog)*100, 2);
    }else{
        $aejert = 0;
    }

    if($vobocieeje != 0){
        $avobocie = round(($vobocieeje/$vobocieprog)*100, 2);
    }else{
        $avobocie = 0;
    }

    if($pinturaeje != 0){
        $apintura = round(($pinturaeje/$pinturaprog)*100, 2);
    }else{
        $apintura = 0;
    }

    if($aislamientoeje != 0){
        $aaislamiento = round(($aislamientoeje/$aislamientoprog)*100, 2);
    }else{
        $aaislamiento = 0;
    }

    if($desarmandamioeje != 0){
        $adesarmandamio = round(($desarmandamioeje/$desarmandamioprog)*100, 2);
    }else{
        $adesarmandamio = 0;
    }

    if($regcontroleje != 0){
        $aregcontrol = round(($regcontroleje/$regcontrolprog)*100, 2);
    }else{
        $aregcontrol = 0;
    }

    // echo 'Arm Andamio: ' . $aarmandamio . '<br>';
    // echo 'reta: ' . $aretaislamiento . '<br>';
    // echo 'limp: ' . $alimpieza . '<br>';
    // echo 'insp: ' . $ainsputesp . '<br>';
    // echo 'rtpost: ' . $artpostinsp . '<br>';
    // echo 'ejert: ' . $aejert . '<br>';
    // echo 'vobo: ' . $avobocie . '<br>';
    // echo 'pintura: ' . $apintura . '<br>';
    // echo 'Aislam: ' . $aaislamiento . '<br>';
    // echo 'Des Andamio: ' . $adesarmandamio . '<br>';
    // echo 'Reg control: ' . $aregcontrol . '<br>';

    // echo 'Arm Andamio: ' . $armandamioprog . '<br>';
    // echo 'reta: ' . $retaislamientoprog . '<br>';
    // echo 'limp: ' . $limpiezaprog . '<br>';
    // echo 'insp: ' . $insputespprog . '<br>';
    // echo 'rtpost: ' . $rtpostinspprog . '<br>';
    // echo 'ejert: ' . $ejertprog . '<br>';
    // echo 'vobo: ' . $vobocieprog . '<br>';
    // echo 'pintura: ' . $pinturaprog . '<br>';
    // echo 'Aislam: ' . $aislamientoprog . '<br>';
    // echo 'Des Andamio: ' . $desarmandamioprog . '<br>';
    // echo 'Reg control: ' . $regcontrolprog . '<br>';

    // echo 'Arm Andamio: ' . $armandamioeje . '<br>';
    // echo 'reta: ' . $armandamioeje . '<br>';
    // echo 'limp: ' . $limpiezaeje . '<br>';
    // echo 'insp: ' . $insputespeje . '<br>';
    // echo 'rtpost: ' . $rtpostinspeje . '<br>';
    // echo 'ejert: ' . $ejerteje . '<br>';
    // echo 'vobo: ' . $vobocieeje . '<br>';
    // echo 'pintura: ' . $pinturaeje . '<br>';
    // echo 'Aislam: ' . $aislamientoeje . '<br>';
    // echo 'Des Andamio: ' . $desarmandamioeje . '<br>';
    // echo 'Reg control: ' . $regcontroleje . '<br>';
    


    
    // $datos[] = array(
    //     'lazo'=>$obj->lazo,
    //     'isometrico'=>$obj->isometrico,
    //     'cmls'=>$cont,
    //     'armandamioprog'=>$armandamioprog,
    //     'armandamioeje'=>$armandamioeje,
    //     'aarmandamio'=>$aarmandamio,
    //     'retaislamientoprog'=>$retaislamientoprog,
    //     'retaislamientoeje'=>$retaislamientoeje,
    //     'aretaislamiento'=>$aretaislamiento,
    //     'limpiezaprog'=>$limpiezaprog,
    //     'limpiezaeje'=>$limpiezaeje,
    //     'insputespprog'=>$insputespprog,
    //     'insputespeje'=>$insputespeje,
    //     'rtpostinspprog'=>$rtpostinspprog,
    //     'rtpostinspeje'=>$rtpostinspeje,
    //     'ejertprog'=>$ejertprog,
    //     'ejerteje'=>$ejerteje,
    //     'vobocieprog'=>$vobocieprog,
    //     'vobocieeje'=>$vobocieeje,
    //     'pinturaprog'=>$pinturaprog,
    //     'pinturaeje'=>$pinturaeje,
    //     'aislamientoprog'=>$aislamientoprog,
    //     'aislamientoeje'=>$aislamientoeje,
    //     'desarmandamioprog'=>$desarmandamioprog,
    //     'desarmandamioeje'=>$desarmandamioeje,
    //     'regcontrolprog'=>$regcontrolprog,
    //     'regcontroleje'=>$regcontroleje,
    // );

    $datos[] = array(
        'lazo'=>$obj->lazo,
        'isometrico'=>$obj->isometrico,
        'cmls'=>$cont,
        'armandamioprog'=>$armandamioprog,
        'armandamioeje'=>$armandamioeje,
        'aarmandamio'=>$aarmandamio,
        'retaislamientoprog'=>$retaislamientoprog,
        'retaislamientoeje'=>$retaislamientoeje,
        'aretaislamiento'=>$aretaislamiento,
        'limpiezaprog'=>$limpiezaprog,
        'limpiezaeje'=>$limpiezaeje,
        'alimpieza'=>$alimpieza,
        'insputespprog'=>$insputespprog,
        'insputespeje'=>$insputespeje,
        'ainsputesp'=>$ainsputesp,
        'rtpostinspprog'=>$rtpostinspprog,
        'rtpostinspeje'=>$rtpostinspeje,
        'artpostinsp'=>$artpostinsp,
        'ejertprog'=>$ejertprog,
        'ejerteje'=>$ejerteje,
        'aejert'=>$aejert,
        'vobocieprog'=>$vobocieprog,
        'vobocieeje'=>$vobocieeje,
        'avobocie'=>$avobocie,
        'pinturaprog'=>$pinturaprog,
        'pinturaeje'=>$pinturaeje,
        'apintura'=>$apintura,
        'aislamientoprog'=>$aislamientoprog,
        'aislamientoeje'=>$aislamientoeje,
        'aaislamiento'=>$aaislamiento,
        'desarmandamioprog'=>$desarmandamioprog,
        'desarmandamioeje'=>$desarmandamioeje,
        'adesarmandamio'=>$adesarmandamio,
        'regcontrolprog'=>$regcontrolprog,
        'regcontroleje'=>$regcontroleje,
        'aregcontrol'=>$aregcontrol,         
    );

    

}



echo json_encode($datos);
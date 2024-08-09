<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//TOTAL JUNTAS REALIZADAS

$sql="SELECT COUNT(*) AS totjunt FROM datosw WHERE fecha != ''";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc!=0){
    $row = mysqli_fetch_object($exito);
    $totjuntas = $row->totjunt;
}else{
    $totjuntas = 0;
}

//TOTAL JUNTAS REALIZADAS BW

$sql="SELECT COUNT(*) AS totjuntbw FROM datosw WHERE fecha != '' AND tipojunta = 'BW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc!=0){
    $row = mysqli_fetch_object($exito);
    $totjuntasbw = $row->totjuntbw;
}else{
    $totjuntasbw = 0;
}


//TOTAL JUNTAS RECHAZADAS BW RX/UT

$sql="SELECT * FROM datosw WHERE fecha != '' AND tipojunta = 'BW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);
$totjuntasbwr=0;

if($enc!=0){
    while($row = mysqli_fetch_object($exito)){
        if($row->rxpreresultado == 'RECHAZADA' || $row->rxpreresultado == 'RECHAZADAOK' || $row->utpresultado == 'RECHAZADA' || $row->utpresultado == 'RECHAZADAOK'){
            $totjuntasbwr++;
        }
    }    
}

//TOTAL JUNTAS BW RX/UT

$sql="SELECT * FROM datosw WHERE fecha != '' AND tipojunta = 'BW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);
$totjuntasbwp=0;

if($enc!=0){
    while($row = mysqli_fetch_object($exito)){
        if($row->rxpreresultado != 'NA' OR $row->utpresultado != 'NA'){
            $totjuntasbwp++;
        }
    }    
}

//TOTAL JUNTAS REALIZADAS SW

$sql="SELECT COUNT(*) AS totjuntbw FROM datosw WHERE fecha != '' AND tipojunta = 'SW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc!=0){
    $row = mysqli_fetch_object($exito);
    $totjuntassw = $row->totjuntbw;
}else{
    $totjuntassw = 0;
}


//TOTAL JUNTAS RECHAZADAS BW RX/UT

$sql="SELECT * FROM datosw WHERE fecha != '' AND tipojunta = 'SW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);
$totjuntasswr=0;

if($enc!=0){
    while($row = mysqli_fetch_object($exito)){
        if($row->rxpreresultado == 'RECHAZADA' || $row->rxpreresultado == 'RECHAZADAOK' || $row->utpresultado == 'RECHAZADA' || $row->utpresultado == 'RECHAZADAOK'){
            $totjuntasswr++;
        }
    }    
}

//TOTAL JUNTAS BW RX/UT

$sql="SELECT * FROM datosw WHERE fecha != '' AND tipojunta = 'SW'";
$exito=mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);
$totjuntasswp=0;

if($enc!=0){
    while($row = mysqli_fetch_object($exito)){
        if($row->rxpreresultado != 'NA' OR $row->utpresultado != 'NA'){
            $totjuntasswp++;
        }
    }    
}

$totjuntasrechazadas = $totjuntasswr + $totjuntasbwr;
$pordefbw = round(($totjuntasbwr/$totjuntasbw)*100, 2);
$pordefsw = round(($totjuntasswr/$totjuntassw)*100, 2);
$pordef = round(($totjuntasrechazadas/$totjuntas)*100, 2);



$sql="SELECT * FROM infdef WHERE juntasoldador like '%RECHAZADA%'";
$exito=mysqli_query($conexion, $sql);

$fi = 0;
$ff = 0;
$pi = 0;
$il = 0;
$ir = 0;
$exp = 0;
$hi = 0;
$gl = 0;
$gt = 0;
$pa = 0;
$pag = 0;
$pt = 0;
$pv = 0;
$iea = 0;
$iei = 0;
$a = 0;
$ce = 0;
$ci = 0;
$se = 0;
$si = 0;
$q = 0;
$it = 0;
$cir = 0;
$t = 0;

while($obj = mysqli_fetch_object($exito)){

    //FI

    if($obj->abnv1 == 'FI'){
        $fi++;
    }
    if($obj->abnv2 == 'FI'){
        $fi++;
    }
    if($obj->abnv3 == 'FI'){
        $fi++;
    }

    if($obj->bcnv1 == 'FI'){
        $fi++;
    }
    if($obj->bcnv2 == 'FI'){
        $fi++;
    }
    if($obj->bcnv3 == 'FI'){
        $fi++;
    }

    if($obj->canv1 == 'FI'){
        $fi++;
    }
    if($obj->canv2 == 'FI'){
        $fi++;
    }
    if($obj->canv3 == 'FI'){
        $fi++;
    }

    if($obj->danv1 == 'FI'){
        $fi++;
    }
    if($obj->danv2 == 'FI'){
        $fi++;
    }
    if($obj->danv3 == 'FI'){
        $fi++;
    }

    if($obj->eanv1 == 'FI'){
        $fi++;
    }
    if($obj->eanv2 == 'FI'){
        $fi++;
    }
    if($obj->eanv3 == 'FI'){
        $fi++;
    }

    //FF
    if($obj->abnv1 == 'FF'){
        $ff++;
    }
    if($obj->abnv2 == 'FF'){
        $ff++;
    }
    if($obj->abnv3 == 'FF'){
        $ff++;
    }

    if($obj->bcnv1 == 'FF'){
        $ff++;
    }
    if($obj->bcnv2 == 'FF'){
        $ff++;
    }
    if($obj->bcnv3 == 'FF'){
        $ff++;
    }

    if($obj->canv1 == 'FF'){
        $ff++;
    }
    if($obj->canv2 == 'FF'){
        $ff++;
    }
    if($obj->canv3 == 'FF'){
        $ff++;
    }

    if($obj->danv1 == 'FF'){
        $ff++;
    }
    if($obj->danv2 == 'FF'){
        $ff++;
    }
    if($obj->danv3 == 'FF'){
        $ff++;
    }

    if($obj->eanv1 == 'FF'){
        $ff++;
    }
    if($obj->eanv2 == 'FF'){
        $ff++;
    }
    if($obj->eanv3 == 'FF'){
        $ff++;
    }

    //PI
    if($obj->abnv1 == 'PI'){
        $pi++;
    }
    if($obj->abnv2 == 'PI'){
        $pi++;
    }
    if($obj->abnv3 == 'PI'){
        $pi++;
    }

    if($obj->bcnv1 == 'PI'){
        $pi++;
    }
    if($obj->bcnv2 == 'PI'){
        $pi++;
    }
    if($obj->bcnv3 == 'PI'){
        $pi++;
    }

    if($obj->canv1 == 'PI'){
        $pi++;
    }
    if($obj->canv2 == 'PI'){
        $pi++;
    }
    if($obj->canv3 == 'PI'){
        $pi++;
    }

    if($obj->danv1 == 'PI'){
        $pi++;
    }
    if($obj->danv2 == 'PI'){
        $pi++;
    }
    if($obj->danv3 == 'PI'){
        $pi++;
    }

    if($obj->eanv1 == 'PI'){
        $pi++;
    }
    if($obj->eanv2 == 'PI'){
        $pi++;
    }
    if($obj->eanv3 == 'PI'){
        $pi++;
    }

    //IL
    if($obj->abnv1 == 'IL'){
        $il++;
    }
    if($obj->abnv2 == 'IL'){
        $il++;
    }
    if($obj->abnv3 == 'IL'){
        $il++;
    }

    if($obj->bcnv1 == 'IL'){
        $il++;
    }
    if($obj->bcnv2 == 'IL'){
        $il++;
    }
    if($obj->bcnv3 == 'IL'){
        $il++;
    }

    if($obj->canv1 == 'IL'){
        $il++;
    }
    if($obj->canv2 == 'IL'){
        $il++;
    }
    if($obj->canv3 == 'IL'){
        $il++;
    }

    if($obj->danv1 == 'IL'){
        $il++;
    }
    if($obj->danv2 == 'IL'){
        $il++;
    }
    if($obj->danv3 == 'IL'){
        $il++;
    }

    if($obj->eanv1 == 'IL'){
        $il++;
    }
    if($obj->eanv2 == 'IL'){
        $il++;
    }
    if($obj->eanv3 == 'IL'){
        $il++;
    }

    //IR
    if($obj->abnv1 == 'IR'){
        $ir++;
    }
    if($obj->abnv2 == 'IR'){
        $ir++;
    }
    if($obj->abnv3 == 'IR'){
        $ir++;
    }

    if($obj->bcnv1 == 'IR'){
        $ir++;
    }
    if($obj->bcnv2 == 'IR'){
        $ir++;
    }
    if($obj->bcnv3 == 'IR'){
        $ir++;
    }

    if($obj->canv1 == 'IR'){
        $ir++;
    }
    if($obj->canv2 == 'IR'){
        $ir++;
    }
    if($obj->canv3 == 'IR'){
        $ir++;
    }

    if($obj->danv1 == 'IR'){
        $ir++;
    }
    if($obj->danv2 == 'IR'){
        $ir++;
    }
    if($obj->danv3 == 'IR'){
        $ir++;
    }

    if($obj->eanv1 == 'IR'){
        $ir++;
    }
    if($obj->eanv2 == 'IR'){
        $ir++;
    }
    if($obj->eanv3 == 'IR'){
        $ir++;
    }

    //EXP
    if($obj->abnv1 == 'EXP'){
        $exp++;
    }
    if($obj->abnv2 == 'EXP'){
        $exp++;
    }
    if($obj->abnv3 == 'EXP'){
        $exp++;
    }

    if($obj->bcnv1 == 'EXP'){
        $exp++;
    }
    if($obj->bcnv2 == 'EXP'){
        $exp++;
    }
    if($obj->bcnv3 == 'EXP'){
        $exp++;
    }

    if($obj->canv1 == 'EXP'){
        $exp++;
    }
    if($obj->canv2 == 'EXP'){
        $exp++;
    }
    if($obj->canv3 == 'EXP'){
        $exp++;
    }

    if($obj->danv1 == 'EXP'){
        $exp++;
    }
    if($obj->danv2 == 'EXP'){
        $exp++;
    }
    if($obj->danv3 == 'EXP'){
        $exp++;
    }

    if($obj->eanv1 == 'EXP'){
        $exp++;
    }
    if($obj->eanv2 == 'EXP'){
        $exp++;
    }
    if($obj->eanv3 == 'EXP'){
        $exp++;
    }

    //HI
    if($obj->abnv1 == 'HI'){
        $hi++;
    }
    if($obj->abnv2 == 'HI'){
        $hi++;
    }
    if($obj->abnv3 == 'HI'){
        $hi++;
    }

    if($obj->bcnv1 == 'HI'){
        $hi++;
    }
    if($obj->bcnv2 == 'HI'){
        $hi++;
    }
    if($obj->bcnv3 == 'HI'){
        $hi++;
    }

    if($obj->canv1 == 'HI'){
        $hi++;
    }
    if($obj->canv2 == 'HI'){
        $hi++;
    }
    if($obj->canv3 == 'HI'){
        $hi++;
    }

    if($obj->danv1 == 'HI'){
        $hi++;
    }
    if($obj->danv2 == 'HI'){
        $hi++;
    }
    if($obj->danv3 == 'HI'){
        $hi++;
    }

    if($obj->eanv1 == 'HI'){
        $hi++;
    }
    if($obj->eanv2 == 'HI'){
        $hi++;
    }
    if($obj->eanv3 == 'HI'){
        $hi++;
    }

    //GL
    if($obj->abnv1 == 'GL'){
        $gl++;
    }
    if($obj->abnv2 == 'GL'){
        $gl++;
    }
    if($obj->abnv3 == 'GL'){
        $gl++;
    }

    if($obj->bcnv1 == 'GL'){
        $gl++;
    }
    if($obj->bcnv2 == 'GL'){
        $gl++;
    }
    if($obj->bcnv3 == 'GL'){
        $gl++;
    }

    if($obj->canv1 == 'GL'){
        $gl++;
    }
    if($obj->canv2 == 'GL'){
        $gl++;
    }
    if($obj->canv3 == 'GL'){
        $gl++;
    }

    if($obj->danv1 == 'GL'){
        $gl++;
    }
    if($obj->danv2 == 'GL'){
        $gl++;
    }
    if($obj->danv3 == 'GL'){
        $gl++;
    }

    if($obj->eanv1 == 'GL'){
        $gl++;
    }
    if($obj->eanv2 == 'GL'){
        $gl++;
    }
    if($obj->eanv3 == 'GL'){
        $gl++;
    }

    //GT
    if($obj->abnv1 == 'GT'){
        $gt++;
    }
    if($obj->abnv2 == 'GT'){
        $gt++;
    }
    if($obj->abnv3 == 'GT'){
        $gt++;
    }

    if($obj->bcnv1 == 'GT'){
        $gt++;
    }
    if($obj->bcnv2 == 'GT'){
        $gt++;
    }
    if($obj->bcnv3 == 'GT'){
        $gt++;
    }

    if($obj->canv1 == 'GT'){
        $gt++;
    }
    if($obj->canv2 == 'GT'){
        $gt++;
    }
    if($obj->canv3 == 'GT'){
        $gt++;
    }

    if($obj->danv1 == 'GT'){
        $gt++;
    }
    if($obj->danv2 == 'GT'){
        $gt++;
    }
    if($obj->danv3 == 'GT'){
        $gt++;
    }

    if($obj->eanv1 == 'GT'){
        $gt++;
    }
    if($obj->eanv2 == 'GT'){
        $gt++;
    }
    if($obj->eanv3 == 'GT'){
        $gt++;
    }

    //PA
    if($obj->abnv1 == 'PA'){
        $pa++;
    }
    if($obj->abnv2 == 'PA'){
        $pa++;
    }
    if($obj->abnv3 == 'PA'){
        $pa++;
    }

    if($obj->bcnv1 == 'PA'){
        $pa++;
    }
    if($obj->bcnv2 == 'PA'){
        $pa++;
    }
    if($obj->bcnv3 == 'PA'){
        $pa++;
    }

    if($obj->canv1 == 'PA'){
        $pa++;
    }
    if($obj->canv2 == 'PA'){
        $pa++;
    }
    if($obj->canv3 == 'PA'){
        $pa++;
    }

    if($obj->danv1 == 'PA'){
        $pa++;
    }
    if($obj->danv2 == 'PA'){
        $pa++;
    }
    if($obj->danv3 == 'PA'){
        $pa++;
    }

    if($obj->eanv1 == 'PA'){
        $pa++;
    }
    if($obj->eanv2 == 'PA'){
        $pa++;
    }
    if($obj->eanv3 == 'PA'){
        $pa++;
    }

    //PAG
    if($obj->abnv1 == 'PAG'){
        $pag++;
    }
    if($obj->abnv2 == 'PAG'){
        $pag++;
    }
    if($obj->abnv3 == 'PAG'){
        $pag++;
    }

    if($obj->bcnv1 == 'PAG'){
        $pag++;
    }
    if($obj->bcnv2 == 'PAG'){
        $pag++;
    }
    if($obj->bcnv3 == 'PAG'){
        $pag++;
    }

    if($obj->canv1 == 'PAG'){
        $pag++;
    }
    if($obj->canv2 == 'PAG'){
        $pag++;
    }
    if($obj->canv3 == 'PAG'){
        $pag++;
    }

    if($obj->danv1 == 'PAG'){
        $pag++;
    }
    if($obj->danv2 == 'PAG'){
        $pag++;
    }
    if($obj->danv3 == 'PAG'){
        $pag++;
    }

    if($obj->eanv1 == 'PAG'){
        $pag++;
    }
    if($obj->eanv2 == 'PAG'){
        $pag++;
    }
    if($obj->eanv3 == 'PAG'){
        $pag++;
    }

    //PT
    if($obj->abnv1 == 'PT'){
        $pt++;
    }
    if($obj->abnv2 == 'PT'){
        $pt++;
    }
    if($obj->abnv3 == 'PT'){
        $pt++;
    }

    if($obj->bcnv1 == 'PT'){
        $pt++;
    }
    if($obj->bcnv2 == 'PT'){
        $pt++;
    }
    if($obj->bcnv3 == 'PT'){
        $pt++;
    }

    if($obj->canv1 == 'PT'){
        $pt++;
    }
    if($obj->canv2 == 'PT'){
        $pt++;
    }
    if($obj->canv3 == 'PT'){
        $pt++;
    }

    if($obj->danv1 == 'PT'){
        $pt++;
    }
    if($obj->danv2 == 'PT'){
        $pt++;
    }
    if($obj->danv3 == 'PT'){
        $pt++;
    }

    if($obj->eanv1 == 'PT'){
        $pt++;
    }
    if($obj->eanv2 == 'PT'){
        $pt++;
    }
    if($obj->eanv3 == 'PT'){
        $pt++;
    }

    //PV
    if($obj->abnv1 == 'PV'){
        $pv++;
    }
    if($obj->abnv2 == 'PV'){
        $pv++;
    }
    if($obj->abnv3 == 'PV'){
        $pv++;
    }

    if($obj->bcnv1 == 'PV'){
        $pv++;
    }
    if($obj->bcnv2 == 'PV'){
        $pv++;
    }
    if($obj->bcnv3 == 'PV'){
        $pv++;
    }

    if($obj->canv1 == 'PV'){
        $pv++;
    }
    if($obj->canv2 == 'PV'){
        $pv++;
    }
    if($obj->canv3 == 'PV'){
        $pv++;
    }

    if($obj->danv1 == 'PV'){
        $pv++;
    }
    if($obj->danv2 == 'PV'){
        $pv++;
    }
    if($obj->danv3 == 'PV'){
        $pv++;
    }

    if($obj->eanv1 == 'PV'){
        $pv++;
    }
    if($obj->eanv2 == 'PV'){
        $pv++;
    }
    if($obj->eanv3 == 'PV'){
        $pv++;
    }

    //IEA
    if($obj->abnv1 == 'IEA'){
        $iea++;
    }
    if($obj->abnv2 == 'IEA'){
        $iea++;
    }
    if($obj->abnv3 == 'IEA'){
        $iea++;
    }

    if($obj->bcnv1 == 'IEA'){
        $iea++;
    }
    if($obj->bcnv2 == 'IEA'){
        $iea++;
    }
    if($obj->bcnv3 == 'IEA'){
        $iea++;
    }

    if($obj->canv1 == 'IEA'){
        $iea++;
    }
    if($obj->canv2 == 'IEA'){
        $iea++;
    }
    if($obj->canv3 == 'IEA'){
        $iea++;
    }

    if($obj->danv1 == 'IEA'){
        $iea++;
    }
    if($obj->danv2 == 'IEA'){
        $iea++;
    }
    if($obj->danv3 == 'IEA'){
        $iea++;
    }

    if($obj->eanv1 == 'IEA'){
        $iea++;
    }
    if($obj->eanv2 == 'IEA'){
        $iea++;
    }
    if($obj->eanv3 == 'IEA'){
        $iea++;
    }

    //IEI
    if($obj->abnv1 == 'IEI'){
        $iei++;
    }
    if($obj->abnv2 == 'IEI'){
        $iei++;
    }
    if($obj->abnv3 == 'IEI'){
        $iei++;
    }

    if($obj->bcnv1 == 'IEI'){
        $iei++;
    }
    if($obj->bcnv2 == 'IEI'){
        $iei++;
    }
    if($obj->bcnv3 == 'IEI'){
        $iei++;
    }

    if($obj->canv1 == 'IEI'){
        $iei++;
    }
    if($obj->canv2 == 'IEI'){
        $iei++;
    }
    if($obj->canv3 == 'IEI'){
        $iei++;
    }

    if($obj->danv1 == 'IEI'){
        $iei++;
    }
    if($obj->danv2 == 'IEI'){
        $iei++;
    }
    if($obj->danv3 == 'IEI'){
        $iei++;
    }

    if($obj->eanv1 == 'IEI'){
        $iei++;
    }
    if($obj->eanv2 == 'IEI'){
        $iei++;
    }
    if($obj->eanv3 == 'IEI'){
        $iei++;
    }

    //A
    if($obj->abnv1 == 'A'){
        $a++;
    }
    if($obj->abnv2 == 'A'){
        $a++;
    }
    if($obj->abnv3 == 'A'){
        $a++;
    }

    if($obj->bcnv1 == 'A'){
        $a++;
    }
    if($obj->bcnv2 == 'A'){
        $a++;
    }
    if($obj->bcnv3 == 'A'){
        $a++;
    }

    if($obj->canv1 == 'A'){
        $a++;
    }
    if($obj->canv2 == 'A'){
        $a++;
    }
    if($obj->canv3 == 'A'){
        $a++;
    }

    if($obj->danv1 == 'A'){
        $a++;
    }
    if($obj->danv2 == 'A'){
        $a++;
    }
    if($obj->danv3 == 'A'){
        $a++;
    }

    if($obj->eanv1 == 'A'){
        $a++;
    }
    if($obj->eanv2 == 'A'){
        $a++;
    }
    if($obj->eanv3 == 'A'){
        $a++;
    }

    //CE
    if($obj->abnv1 == 'CE'){
        $ce++;
    }
    if($obj->abnv2 == 'CE'){
        $ce++;
    }
    if($obj->abnv3 == 'CE'){
        $ce++;
    }

    if($obj->bcnv1 == 'CE'){
        $ce++;
    }
    if($obj->bcnv2 == 'CE'){
        $ce++;
    }
    if($obj->bcnv3 == 'CE'){
        $ce++;
    }

    if($obj->canv1 == 'CE'){
        $ce++;
    }
    if($obj->canv2 == 'CE'){
        $ce++;
    }
    if($obj->canv3 == 'CE'){
        $ce++;
    }

    if($obj->danv1 == 'CE'){
        $ce++;
    }
    if($obj->danv2 == 'CE'){
        $ce++;
    }
    if($obj->danv3 == 'CE'){
        $ce++;
    }

    if($obj->eanv1 == 'CE'){
        $ce++;
    }
    if($obj->eanv2 == 'CE'){
        $ce++;
    }
    if($obj->eanv3 == 'CE'){
        $ce++;
    }

    //CI
    if($obj->abnv1 == 'CI'){
        $ci++;
    }
    if($obj->abnv2 == 'CI'){
        $ci++;
    }
    if($obj->abnv3 == 'CI'){
        $ci++;
    }

    if($obj->bcnv1 == 'CI'){
        $ci++;
    }
    if($obj->bcnv2 == 'CI'){
        $ci++;
    }
    if($obj->bcnv3 == 'CI'){
        $ci++;
    }

    if($obj->canv1 == 'CI'){
        $ci++;
    }
    if($obj->canv2 == 'CI'){
        $ci++;
    }
    if($obj->canv3 == 'CI'){
        $ci++;
    }

    if($obj->danv1 == 'CI'){
        $ci++;
    }
    if($obj->danv2 == 'CI'){
        $ci++;
    }
    if($obj->danv3 == 'CI'){
        $ci++;
    }

    if($obj->eanv1 == 'CI'){
        $ci++;
    }
    if($obj->eanv2 == 'CI'){
        $ci++;
    }
    if($obj->eanv3 == 'CI'){
        $ci++;
    }

    //SE
    if($obj->abnv1 == 'SE'){
        $se++;
    }
    if($obj->abnv2 == 'SE'){
        $se++;
    }
    if($obj->abnv3 == 'SE'){
        $se++;
    }

    if($obj->bcnv1 == 'SE'){
        $se++;
    }
    if($obj->bcnv2 == 'SE'){
        $se++;
    }
    if($obj->bcnv3 == 'SE'){
        $se++;
    }

    if($obj->canv1 == 'SE'){
        $se++;
    }
    if($obj->canv2 == 'SE'){
        $se++;
    }
    if($obj->canv3 == 'SE'){
        $se++;
    }

    if($obj->danv1 == 'SE'){
        $se++;
    }
    if($obj->danv2 == 'SE'){
        $se++;
    }
    if($obj->danv3 == 'SE'){
        $se++;
    }

    if($obj->eanv1 == 'SE'){
        $se++;
    }
    if($obj->eanv2 == 'SE'){
        $se++;
    }
    if($obj->eanv3 == 'SE'){
        $se++;
    }

    //SI
    if($obj->abnv1 == 'SI'){
        $si++;
    }
    if($obj->abnv2 == 'SI'){
        $si++;
    }
    if($obj->abnv3 == 'SI'){
        $si++;
    }

    if($obj->bcnv1 == 'SI'){
        $si++;
    }
    if($obj->bcnv2 == 'SI'){
        $si++;
    }
    if($obj->bcnv3 == 'SI'){
        $si++;
    }

    if($obj->canv1 == 'SI'){
        $si++;
    }
    if($obj->canv2 == 'SI'){
        $si++;
    }
    if($obj->canv3 == 'SI'){
        $si++;
    }

    if($obj->danv1 == 'SI'){
        $si++;
    }
    if($obj->danv2 == 'SI'){
        $si++;
    }
    if($obj->danv3 == 'SI'){
        $si++;
    }

    if($obj->eanv1 == 'SI'){
        $si++;
    }
    if($obj->eanv2 == 'SI'){
        $si++;
    }
    if($obj->eanv3 == 'SI'){
        $si++;
    }

    //Q
    if($obj->abnv1 == 'Q'){
        $q++;
    }
    if($obj->abnv2 == 'Q'){
        $q++;
    }
    if($obj->abnv3 == 'Q'){
        $q++;
    }

    if($obj->bcnv1 == 'Q'){
        $q++;
    }
    if($obj->bcnv2 == 'Q'){
        $q++;
    }
    if($obj->bcnv3 == 'Q'){
        $q++;
    }

    if($obj->canv1 == 'Q'){
        $q++;
    }
    if($obj->canv2 == 'Q'){
        $q++;
    }
    if($obj->canv3 == 'Q'){
        $q++;
    }

    if($obj->danv1 == 'Q'){
        $q++;
    }
    if($obj->danv2 == 'Q'){
        $q++;
    }
    if($obj->danv3 == 'Q'){
        $q++;
    }

    if($obj->eanv1 == 'Q'){
        $q++;
    }
    if($obj->eanv2 == 'Q'){
        $q++;
    }
    if($obj->eanv3 == 'Q'){
        $q++;
    }

    //IT
    if($obj->abnv1 == 'IT'){
        $it++;
    }
    if($obj->abnv2 == 'IT'){
        $it++;
    }
    if($obj->abnv3 == 'IT'){
        $it++;
    }

    if($obj->bcnv1 == 'IT'){
        $it++;
    }
    if($obj->bcnv2 == 'IT'){
        $it++;
    }
    if($obj->bcnv3 == 'IT'){
        $it++;
    }

    if($obj->canv1 == 'IT'){
        $it++;
    }
    if($obj->canv2 == 'IT'){
        $it++;
    }
    if($obj->canv3 == 'IT'){
        $it++;
    }

    if($obj->danv1 == 'IT'){
        $it++;
    }
    if($obj->danv2 == 'IT'){
        $it++;
    }
    if($obj->danv3 == 'IT'){
        $it++;
    }

    if($obj->eanv1 == 'IT'){
        $it++;
    }
    if($obj->eanv2 == 'IT'){
        $it++;
    }
    if($obj->eanv3 == 'IT'){
        $it++;
    }

    //CIR
    if($obj->abnv1 == 'CIR'){
        $cir++;
    }
    if($obj->abnv2 == 'CIR'){
        $cir++;
    }
    if($obj->abnv3 == 'CIR'){
        $cir++;
    }

    if($obj->bcnv1 == 'CIR'){
        $cir++;
    }
    if($obj->bcnv2 == 'CIR'){
        $cir++;
    }
    if($obj->bcnv3 == 'CIR'){
        $cir++;
    }

    if($obj->canv1 == 'CIR'){
        $cir++;
    }
    if($obj->canv2 == 'CIR'){
        $cir++;
    }
    if($obj->canv3 == 'CIR'){
        $cir++;
    }

    if($obj->danv1 == 'CIR'){
        $cir++;
    }
    if($obj->danv2 == 'CIR'){
        $cir++;
    }
    if($obj->danv3 == 'CIR'){
        $cir++;
    }

    if($obj->eanv1 == 'CIR'){
        $cir++;
    }
    if($obj->eanv2 == 'CIR'){
        $cir++;
    }
    if($obj->eanv3 == 'CIR'){
        $cir++;
    }

    //T
    if($obj->abnv1 == 'T'){
        $t++;
    }
    if($obj->abnv2 == 'T'){
        $t++;
    }
    if($obj->abnv3 == 'T'){
        $t++;
    }

    if($obj->bcnv1 == 'T'){
        $t++;
    }
    if($obj->bcnv2 == 'T'){
        $t++;
    }
    if($obj->bcnv3 == 'T'){
        $t++;
    }

    if($obj->canv1 == 'T'){
        $t++;
    }
    if($obj->canv2 == 'T'){
        $t++;
    }
    if($obj->canv3 == 'T'){
        $t++;
    }

    if($obj->danv1 == 'T'){
        $t++;
    }
    if($obj->danv2 == 'T'){
        $t++;
    }
    if($obj->danv3 == 'T'){
        $t++;
    }

    if($obj->eanv1 == 'T'){
        $t++;
    }
    if($obj->eanv2 == 'T'){
        $t++;
    }
    if($obj->eanv3 == 'T'){
        $t++;
    }
   
    
}

$totind = $fi+$ff+$pi+$il+$ir+$exp+$hi+$gl+$gt+$pa+$pag+$pt+$pv+$iea+$iei+$a+$ce+$ci+$se+$si+$q+$it+$cir+$t;

$ind = array(
    'fi'=>$fi,
    'ff'=>$ff,
    'pi'=>$pi,
    'il'=>$il,
    'ir'=>$ir,
    'exp'=>$exp,
    'hi'=>$hi,
    'gl'=>$gl,
    'gt'=>$gt,
    'pa'=>$pa,
    'pag'=>$pag,
    'pt'=>$pt,
    'pv'=>$pv,
    'iea'=>$iea,
    'iei'=>$iei,
    'a'=>$a,
    'ce'=>$ce,
    'ci'=>$ci,
    'se'=>$se,
    'si'=>$si,
    'q'=>$q,
    'it'=>$it,
    'cir'=>$cir,
    't'=>$t,
    'totind'=>$totind,
);

$ana = array(
    'totjuntas'=>$totjuntas,
    'totjuntasbw'=>$totjuntasbw,
    'totjuntasbwr'=>$totjuntasbwr,
    'totjuntasbwp'=>$totjuntasbwp,
    'totjuntassw'=>$totjuntassw,
    'totjuntasswr'=>$totjuntasswr,
    'totjuntasswp'=>$totjuntasswp,
    'totjuntasrechazadas'=>$totjuntasrechazadas,
    'pordefbw'=>$pordefbw,
    'pordefsw'=>$pordefsw,
    'pordef'=>$pordef
);


$datos =  array(
    'ind'=>$ind,
    'ana'=>$ana
);


echo json_encode($datos);   
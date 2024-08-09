<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechai = $_POST["fechai"];
$fechaf = $_POST["fechaf"];
$ods = $_POST["ods"];

// $fechai = '2021-04-01';
// $fechaf = '2021-06-28';
// $ods = '016';

//BUSCAR MAYO PERSONAL DENTRO Y FUERA DE LA GRB

$sqld = "SELECT fecha, SUM(tp) AS mtp, SUM(pdir) AS mpdir, SUM(pindir) AS mpindir FROM personaldiario WHERE fecha BETWEEN '$fechai' and '$fechaf' and planta != 'TALLER PREF' GROUP by fecha";
$exitod = mysqli_query($conexion, $sqld);
$filad = mysqli_fetch_object($exitod);

$mayorDirectoGRB = $filad->mpdir;
$mayorIndirectoGRB = $filad->mpindir;
$mayorTotalGRB = $filad->mtp;

$sqli = "SELECT fecha, SUM(tp) AS mtp, SUM(pdir) AS mpdir, SUM(pindir) AS mpindir FROM personaldiario WHERE fecha BETWEEN '$fechai' and '$fechaf' and planta = 'TALLER PREF' GROUP by fecha";
$exitoi = mysqli_query($conexion, $sqli);
$filai = mysqli_fetch_object($exitoi);

$mayorDirectoFGRB = $filai->mpdir;
$mayorIndirectoFGRB = $filai->mpindir;
$mayorTotalFGRB = $filai->mtp;

//FIN MAYOR PERSONAL

//SUMA HORAS DENTRO DEL GRB 

$sqlh = "SELECT SUM(hdir) as sumpdir, SUM(hindir) as sumpindir, SUM(th) as sumtot FROM personaldiario WHERE fecha BETWEEN '$fechai' AND '$fechaf' AND planta != 'TALLER PREF'";
$exitoh = mysqli_query($conexion, $sqlh);
$filah = mysqli_fetch_object($exitoh);

$sumaDirectosGRB = $filah->sumpdir;
$sumaIndirectosGRB = $filah->sumpindir;
$sumaTotalGRB = $filah->sumtot;

//FIN SUMA HORAS DENTRO DEL GRB

//SUMA HORAS FUERA DEL GRB 

$sqlhf = "SELECT SUM(hdir) as sumpdir, SUM(hindir) as sumpindir, SUM(th) as sumtot FROM personaldiario WHERE fecha BETWEEN '$fechai' AND '$fechaf' AND planta = 'TALLER PREF'";
$exitohf = mysqli_query($conexion, $sqlhf);
$filahf = mysqli_fetch_object($exitohf);

$sumaDirectosFGRB = $filahf->sumpdir;
$sumaIndirectosFGRB = $filahf->sumpindir;
$sumaTotalFGRB = $filahf->sumtot;

//FIN SUMA HORAS FUERA DEL GRB

//TOTALES HORAS DENTRO Y FUERA DE LA GRB

$totalDirectos = $sumaDirectosGRB + $sumaDirectosFGRB;
$totalIndirectos = $sumaIndirectosGRB + $sumaIndirectosFGRB;
$totalHorasSemana = $totalDirectos + $totalIndirectos;

//FIN TOTALES HORAS DENTROY FUERA DE LA GRB


//suma el acumulado general

$sql = "SELECT sum(hdirectos) as totHDirectos, sum(hindirectos) as totHIndirectos, sum(totalhoras) as totHoras FROM horasacumuladas Where ods='$ods' and (fecha between '$fechai' AND '$fechaf') ORDER BY fecha";
$cons = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_object($cons);

$acumHDirectos = $fila->totHDirectos;
$acumHIndirectos = $fila->totHIndirectos;
$acumHHTotal = $fila->totHoras;



$sql3 = "SELECT SUM(tp) as totper FROM personaldiario Where fecha between '$fechai' AND '$fechaf' ";
$cons3 = mysqli_query($conexion, $sql3);
$fila3 = mysqli_fetch_object($cons3);

$totalPersonal += $fila3->totper;
$totConv = $totalPersonal * 0.25;

$datos = array(
    'mayorDirectoGRB' => intval($mayorDirectoGRB),
    'mayorIndirectoGRB' => intval($mayorIndirectoGRB),
    'mayorTotalGRB' => intval($mayorTotalGRB),
    'mayorDirectoFGRB' => intval($mayorDirectoFGRB),
    'mayorIndirectoFGRB' => intval($mayorIndirectoFGRB),
    'mayorTotalFGRB' => intval($mayorTotalFGRB),
    'sumaDirectosGRB' => intval($sumaDirectosGRB),
    'sumaIndirectosGRB' => intval($sumaIndirectosGRB),
    'sumaTotalGRB' => intval($sumaTotalGRB),
    'sumaDirectosFGRB' => intval($sumaDirectosFGRB),
    'sumaIndirectosFGRB' => intval($sumaIndirectosFGRB),
    'sumaTotalFGRB' => intval($sumaTotalFGRB),
    'totalDirectos'=>intval($totalDirectos),
    'totalIndirectos' => intval($totalIndirectos),
    'totalHorasSemana' => intval($totalHorasSemana),
    'acumHDirectos' => intval($acumHDirectos),
    'acumHIndirectos' => intval($acumHIndirectos),
    'acumHHTotal' => intval($acumHHTotal),
    'totConv' => intval($totConv),
);


echo json_encode($datos);
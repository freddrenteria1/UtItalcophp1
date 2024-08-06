<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$finicio = $_GET["f1"];
$ffinal = $_GET["f2"];

$cons = "SELECT novedad, COUNT(*) as tot, nombres, cargo, fecha FROM asistencias Where fecha between '$finicio' And '$ffinal' And novedad != 'DESCANSO' And novedad != '' And novedad != 'RETIRADO' GROUP BY contrato Order by fecha ASC";
$eje = mysqli_query($conexion, $cons);

$html = '<table border="1"><thead><th>NOMBRE</th><th>CARGO</th><th>NOVEDAD</th><th>DIAS</th></thead>';
$html .= '<tbody>';

while($obj = mysqli_fetch_object($eje)){

    $html .= '<tr>';

    $html .= '<td>'.$obj->nombres.'</td>';
    $html .= '<td>'.$obj->cargo.'</td>';
    $html .= '<td>'.$obj->novedad.'</td>';
    $html .= '<td>'.$obj->tot.'</td>';

    $html .= '</tr>';
   
}

$html .= '</tbody></table>';

echo $html;
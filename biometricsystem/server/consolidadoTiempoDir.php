<?php
header('Access-Control-Allow-Origin: *');


include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$fecha = $_GET["fecha"];
$ods = $_GET["ods"];

$directos = 0;
$indirectos = 0;

$cons = "SELECT * FROM marcaciones Where fecha = '$fecha' And tipo = 'Entrada'";
$eje = mysqli_query($conexion, $cons);

while($obj = mysqli_fetch_object($eje)){
    $doc = $obj->doc;


    $sql = "SELECT * FROM trabajadores Where id = $doc";
    $exito = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_object($exito);

    if($row->ods==$ods){
        if($row->tiponomina == 'Directo' && $row->acargo == 'Ecopetrol'){
            $directos++;
        }
        if($row->tiponomina == 'Indirecto' && $row->acargo == 'Ecopetrol'){
            $indirectos++;
        }
    }
   
}

$html = '<h2>Personal ODS ' .  $ods .' a cargo de Ecopetrol</h2>';
$html .= '<table border="1"><thead>';
$html .= '<th>TIPO</th>';

$html .= '<th>CANT</th>';

$html .= '</tdead>';
$html .= '<tbody>';

$html .= '<tr>';
$html .= '<td>DIRECTOS</td>';
    
$html .= '<td>'.$directos.'</td>';

$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>INDIRECTOS</td>';
    
$html .= '<td>'.$indirectos.'</td>';

$html .= '</tr>';



$html .= '</tbody>';
$html .= '</table>';



echo $html;
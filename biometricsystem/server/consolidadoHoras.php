<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$finicio = $_GET["f1"];
$ffinal = $_GET["f2"];

$cons = "SELECT * FROM asistencias Where fecha between '$finicio' And '$ffinal'";
$eje = mysqli_query($conexion, $cons);


while($obj = mysqli_fetch_object($eje)){
    $frente = $obj->frente;
    
    if($frente == 'MTTO ROTATIVO' || $frente == 'HALLAZGOS HSE' || $frente == 'MTTO PUENTE GRUA' || $frente == 'TRANSVERSAL' || $frente == 'MTTO ROTATIVO (RMECAMRC)'){
        if($obj->tiponomina == 'DIRECTO'){
            $horasmantenimientoDIR += $obj->hht;
        }else{
            $horasmantenimientoINDIR += $obj->hht;
        }
    }

    if($frente == 'AROMATICOS' || $frente == 'INGENIERIA VIRGIN OIL'){
        if($obj->tiponomina == 'DIRECTO'){
            $horaspetroDIR += $obj->hht;
        }else{
            $horaspetroINDIR += $obj->hht;
        }
    }

    if($frente == 'H-4100AB ETILENO' || $frente == 'T-2874 AMINA'){
        if($obj->tiponomina == 'DIRECTO'){
            $horascrackinDIR += $obj->hht;
        }else{
            $horascrackinINDIR += $obj->hht;
        }
    }

    if($frente == 'BANCO TUBERIA 18' || $frente == 'BANCO TUBERIA 1' || $frente == 'INGENIERIA NAFTA' || $frente == 'INGENIERIA SODA'){
        if($obj->tiponomina == 'DIRECTO'){
            $horasmateriasDIR += $obj->hht;
        }else{
            $horasmateriasINDIR += $obj->hht;
        }
    }

    if($frente == "DRUM-4006"){
        if($obj->tiponomina == 'DIRECTO'){
            $horasptarDIR += $obj->hht;
        }else{
            $horasptarINDIR += $obj->hht;
        }
    }
    
    if($frente == 'LAVADO B-955 B-954'){
        if($obj->tiponomina == 'DIRECTO'){
            $horasserviciosDIR += $obj->hht;
        }else{
            $horasserviciosINDIR += $obj->hht;
        }
    }

    if($frente == 'INGENIERIA LINEA HIDROGENO'){
        if($obj->tiponomina == 'DIRECTO'){
            $horasrefinacionDIR += $obj->hht;
        }else{
            $horasrefinacionINDIR += $obj->hht;
        }
    }

}   
$totalmantenimiento = $horasmantenimientoDIR+$horasmantenimientoINDIR;
$totalpetro = $horaspetroDIR + $horaspetroINDIR;
$totalcrackin = $horascrackinDIR + $horascrackinINDIR;
$totalmaterias = $horasmateriasDIR + $horasmateriasINDIR;
$totalpetar = $horasptarDIR + $horasptarINDIR;
$totalservicios = $horasserviciosDIR + $horasserviciosINDIR;
$totalrefi = $horasrefinacionDIR + $horasrefinacionINDIR;


$html = '<table border="1"><thead><th>DEPARTAMENTO</th><th>HORAS DIR</th><th>HORAS INDIR</th><th>TOTAL</th></thead>';
$html .= '<tbody>';

$html .= '<tr>';

$html .= '<td>MANTENIMIENTO</td>';
$html .= '<td>'.$horasmantenimientoDIR.'</td>';
$html .= '<td>'.$horasmantenimientoINDIR.'</td>';
$html .= '<td>'.$totalmantenimiento.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>PETROQUIMICA</td>';
$html .= '<td>'.$horaspetroDIR.'</td>';
$html .= '<td>'.$horaspetroINDIR.'</td>';
$html .= '<td>'.$totalpetro.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>CRACKING I</td>';
$html .= '<td>'.$horascrackinDIR.'</td>';
$html .= '<td>'.$horascrackinINDIR.'</td>';
$html .= '<td>'.$totalcrackin.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>MATERIAS PRIMAS</td>';
$html .= '<td>'.$horasmateriasDIR.'</td>';
$html .= '<td>'.$horasmateriasINDIR.'</td>';
$html .= '<td>'.$totalmaterias.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>PTAR</td>';
$html .= '<td>'.$horasptarDIR.'</td>';
$html .= '<td>'.$horasptarINDIR.'</td>';
$html .= '<td>'.$totalpetar.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>SERVICIOS INDUSTRIALES REFINERIA</td>';
$html .= '<td>'.$horasserviciosDIR.'</td>';
$html .= '<td>'.$horasserviciosINDIR.'</td>';
$html .= '<td>'.$totalservicios.'</td>';

$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>REFINACIÓN DE CRUDOS</td>';
$html .= '<td>'.$horasrefinacionDIR.'</td>';
$html .= '<td>'.$horasrefinacionINDIR.'</td>';
$html .= '<td>'.$totalrefi.'</td>';

$html .= '</tr>';

$html .= '</tbody>';
$html .= '</table>';

echo $html;
<?php
header('Access-Control-Allow-Origin: *');


include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$finicio = $_GET["f1"];
$ffinal = $_GET["f2"];
$ods = $_GET["ods"];

$cons = "SELECT * FROM asistencias Where fecha between '$finicio' And '$ffinal' and ods='$ods' group by fecha Order by fecha ASC";
$eje = mysqli_query($conexion, $cons);

while($obj = mysqli_fetch_object($eje)){
    $fecha = $obj->fecha;

    $arrayFechas[] = array(
        'fecha'=>$fecha
    );

    $sql1 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha'  and ods='$ods' And detallepago = 'ECP X PLANTILLA' Group by fecha";
    $exito1 = mysqli_query($conexion, $sql1);
    $row1 = mysqli_fetch_object($exito1);

    $datosDirEcpxPlantilla[] = array(
        'fecha'=>$fecha,
        'hht'=>$row1->toth
    );

    $sql2 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods' And detallepago = 'ECP X FCIN' Group by fecha";
    $exito2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_object($exito2);

    $datosIndirEcpxFcin[] = array(
        'fecha'=>$fecha,
        'hht'=>$row2->toth
    );

    $sql3 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods'  And detallepago = 'ECP X HSE' Group by fecha";
    $exito3 = mysqli_query($conexion, $sql3);
    $row3 = mysqli_fetch_object($exito3);

    $datosIndirEcpxHse[] = array(
        'fecha'=>$fecha,
        'hht'=>$row3->toth
    );

    $sql4 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha'  and ods='$ods' And detallepago = 'ECP X TARIFA' Group by fecha";
    $exito4 = mysqli_query($conexion, $sql4);
    $row4 = mysqli_fetch_object($exito4);

    $datosDirEcpxTarifa[] = array(
        'fecha'=>$fecha,
        'hht'=>$row4->toth
    );

    $sql5 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods' And tiponomina = 'DIRECTO'  And detallepago = 'TRANSVERSAL' And acargo='ECOPETROL'  Group by fecha";
    $exito5 = mysqli_query($conexion, $sql5);
    $row5 = mysqli_fetch_object($exito5);

    $datosEcpTrans[] = array(
        'fecha'=>$fecha,
        'hht'=>$row5->toth
    );

    $sql9 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods' And tiponomina = 'INDIRECTO'  And detallepago = 'TRANSVERSAL' And acargo='ECOPETROL'  Group by fecha";
    $exito9 = mysqli_query($conexion, $sql9);
    $row9 = mysqli_fetch_object($exito9);

    $datosEcpIndTrans[] = array(
        'fecha'=>$fecha,
        'hht'=>$row9->toth
    );

    $sql6 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods' And tiponomina = 'DIRECTO' And detallepago = 'TRANSVERSAL' And acargo='ITALCO' Group by fecha";
    $exito6 = mysqli_query($conexion, $sql6);
    $row6 = mysqli_fetch_object($exito6);

    $datosDirItalco[] = array(
        'fecha'=>$fecha,
        'hht'=>$row6->toth
    );

    $sql7 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha' and ods='$ods' And tiponomina = 'INDIRECTO' And detallepago = 'TRANSVERSAL' And acargo='ITALCO' Group by fecha";
    $exito7 = mysqli_query($conexion, $sql7);
    $row7 = mysqli_fetch_object($exito7);

    $datosIndirItalco[] = array(
        'fecha'=>$fecha,
        'hht'=>$row7->toth
    );

    $sql8 = "SELECT SUM(hht) as toth From asistencias Where fecha = '$fecha'  and ods='$ods' And detallepago = 'ECP X LOGISTICA' Group by fecha";
    $exito8 = mysqli_query($conexion, $sql8);
    $row8 = mysqli_fetch_object($exito8);

    $datosEcpxLog[] = array(
        'fecha'=>$fecha,
        'hht'=>$row8->toth
    );

   
}

$datos = array(
    'direcpxplantilla'=>$datosDirEcpxPlantilla,
    'indirecpxfcin'=> $datosIndirEcpxFcin,
    'indirecpxhse'=>$datosIndirEcpxHse,
    'direcpxtarifa'=>$datosDirEcpxTarifa,
    'ecptrans'=>$datosEcpTrans,
    'ecpinditrans'=>$datosEcpIndTrans,
    'dirtransitalco'=>$datosDirItalco,
    'indirtransitalco'=>$datosIndirItalco,
    'EcpxLog'=>$datosEcpxLog
);

$html = '<table border="1"><thead>';
$html .= '<th>TIPO</th>';

$contf = count($arrayFechas);

for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    $html .= '<th>'.$fecha.'</th>';
}

$html .= '</tdead>';
$html .= '<tbody>';

$html .= '<tr>';
$html .= '<td>DIRECTOS ECP X PLANTILLA</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["direcpxplantilla"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>INDIRECTOS ECP X FCIN</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["indirecpxfcin"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>DIRECTOS ECP X HSE</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["indirecpxhse"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>DIRECTOS ECP X TARIFA</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["direcpxtarifa"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>DIRECTOS ECP X LOGISTICA</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["EcpxLog"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>DIRECTOS ECP X TRANSVERSAL</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["ecptrans"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>INDIRECTOS ECP X TRANSVERSAL</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["ecpinditrans"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>DIRECTOS TRANSVERSALES ITALCO</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["dirtransitalco"][$i]["hht"].'</td>';
}
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td>INDIRECTOS TRANSVERSALES ITALCO</td>';
for($i=0; $i<$contf;$i++){
    $fecha = $arrayFechas[$i]["fecha"];
    
    $html .= '<td>'.$datos["indirtransitalco"][$i]["hht"].'</td>';
}
$html .= '</tr>';


$html .= '</tbody>';
$html .= '</table>';



echo $html;
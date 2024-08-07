<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_GET["fecha"];

$ods = '017';
//$fecha = '2021-06-13';



$query="SELECT * FROM personalturnos WHERE ods='$ods' AND fecha = '$fecha'";
$eje=mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

$sumaDirectos = 0;
$sumaHorasDirectos = 0;
$sumaIndirectos = 0;
$sumaHorasIndirectos = 0;

while ($row = mysqli_fetch_object($eje)){

    if($row->recurso == 'DIRECTO'){
        $sumaDirectos++;
        $sumaHorasDirectos += $row->horashombre;
    }

    if($row->recurso == 'INDIRECTO'){
        $sumaIndirectos++;
        $sumaHorasIndirectos += $row->horashombre;
    }

}

$totalPersonal = $sumaDirectos + $sumaIndirectos;
$totalhoras = $sumaHorasDirectos + $sumaHorasIndirectos;

//borra si existe y guarda de nuevo

if($cant != 0){

$sql = "DELETE FROM horasacumuladas WHERE fecha = '$fecha' AND ods = '$ods'";
$eje = mysqli_query($conexion, $sql);

//SE GUARDA EL ACUMULADO SI LA FECHA ES DIFERENTE DE 0000-00-00 Y TOTAL HORAS DIFERENTE DE 0

$query = "INSERT INTO horasacumuladas VALUES('', $sumaHorasDirectos, $sumaHorasIndirectos, $totalhoras, '$fecha', '$ods')";
$eje = mysqli_query($conexion, $query);

}




$datos = array(
    'msn' => $msn,
    'DIRECTOS' => $sumaDirectos,
    'INDIRECTOS'=>$sumaIndirectos,
    'HorasDirectos'=>$sumaHorasDirectos,
    'HorasIndirectos'=>$sumaHorasIndirectos,
    'total Personal'=>$totalPersonal,
    'total Horas'=>$totalhoras
);
 
echo json_encode($datos);
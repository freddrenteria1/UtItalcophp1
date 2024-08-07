<?php
// header('Content-type: application/json');
// header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

 $ods = $_GET["ods"];

// $fecha = '31/03/2021';

//$hito = $_POST["hito"];
//$ods = $_POST["ods"];
//$fecha = $_POST["fecha"];

$sql="SELECT * FROM galeria WHERE ods like '%$ods%' order by fecha";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $foto = $row->foto;
    echo '<div style="margin: 10px; float: left;">';
    echo '<img src="'.$foto.'" width="320px" height="320px">';
    echo '<div style="margin: 5px; width: 320px;">FECHA: '. $row->fecha . ' -> '.$row->detalles.'</div>';
    echo '</div>';

}

//echo json_encode($datos);
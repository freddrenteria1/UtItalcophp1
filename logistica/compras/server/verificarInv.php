<?php
//header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$tipo = $_POST["tipo"];

$sql="SELECT * FROM articulos order by art";
$exito=mysqli_query($conexion, $sql);

$html = '<table>';


while($row = mysqli_fetch_object($exito)){
    $item = $row->art;

    $query="SELECT * FROM items Where articulo ='$item'";
    $eje=mysqli_query($conexion, $query);

    $cant = mysqli_num_rows($eje);
    if($cant == 0){
        $html .= '<tr><td>'.$item.'</td></tr>';
    }

}

$html .= '</table>';

echo $html;
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$fecha = $_POST["fecha"];

$fecha = date("d/m/Y", strtotime($fecha));


$buscar="SELECT  * FROM datoswp GROUP BY estw1";   
$ejeb = mysqli_query($conexion, $buscar);

while( $row = mysqli_fetch_object($ejeb)){

    $est = $row->estw1;

    //CONSULTA NOMBRE SOLDADOR

    $sql = "SELECT * FROM soldadores WHERE estampe = '$est'";
    $cons = mysqli_query($conexion, $sql);
    $fila = mysqli_fetch_object($cons);

    $nombre = $fila->nombre;
    
    $query = "SELECT estw1, SUM(pulgdiam) as totpg, COUNT(numjunta) as totjt FROM datoswp WHERE estw1 = '$est' GROUP BY estw1";
    $eje = mysqli_query($conexion, $query);

    while($obj = mysqli_fetch_object($eje)){

         

        //CONSULTA JUNTAS BW

        $sql = "SELECT *, COUNT(tipojunta) as totbw FROM datoswp WHERE estw1 = '$est' AND tipojunta = 'BW'";
        $cons = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_object($cons);

        $totjbw = intval($fila->totbw);

        //CONSULTA CUANTAS CON RX

        $sql = "SELECT *, COUNT(rxpreresultado) as totrx FROM datoswp WHERE estw1 = '$est' AND rxpreresultado != 'NA'";
        $cons = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_object($cons);

        $totrx = intval($fila->totrx);

        //CONSULTA CUANTAS CON RX RECHAZADAS

        $sql = "SELECT *, COUNT(rxpreresultado) as totrxr FROM datoswp WHERE estw1 = '$est' AND rxpreresultado like '%RECHAZADA%'";
        $cons = mysqli_query($conexion, $sql);
        $fila = mysqli_fetch_object($cons);

        $totrxr = intval($fila->totrxr);

        if($totrxr > 0){
            $def = ($totrxr/$totrx) * 100;
        }else{
            $def = 0;
        }

        
        //CONSULTA JUNTAS BW

        $sql = "SELECT *, COUNT(numjunta) as totjdia FROM datoswp WHERE estw1 = '$est'  GROUP BY fecha";
        $cons = mysqli_query($conexion, $sql);
         

        $totjd = mysqli_num_rows($cons);

        $prom = intval($obj->totpg) /  $totjd;

        $datos[] = array(
            'nombre'=>$nombre,
            'est'=>$obj->estw1,
            'pulg'=>intval($obj->totpg),
            'jtas'=>intval($obj->totjt),
            'totbw'=>$totjbw,
            'totrx'=>$totrx,
            'totrxr'=>$totrxr,
            'def'=>$def,
            'prom'=>$prom,
            'dias'=>$totjd
        );
    }


}




echo json_encode($datos);


<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fechainfo = $_POST["fecha"];
//$fechainfo = "2024-02-19";

$sql="SELECT * FROM curvasoldadura order by fecha";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $soldp[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'progacum'=>doubleval($obj->progacum),
        'progdia'=>doubleval($obj->progdia)
    );

}


$sql="SELECT SUM(pulgdiam) AS totpulg FROM datoswp";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$totsold = $obj->totpulg;

$totreg = count($soldp);


// echo 'Total reg '. $totreg;

// $fechabm = date("d/m/Y", strtotime('2024-02-05'));

// $sql="SELECT SUM(pulgdiam) AS totpulg FROM datoswp  WHERE fecha < '$fechabm'";
// $exito=mysqli_query($conexion, $sql);

// $obj = mysqli_fetch_object($exito);

// $totsoldr =  $obj->totpulg;

//$totsoldr = ($totsoldr / $totsold) * 100;

$ejeacum = 75.5;


for($i=0; $i<$totreg; $i++){

    $fechab = $soldp[$i]["fecha"];

    $fechabuscar = date("Y-m-d", strtotime($fechab));
    //$fechabuscar = $fechainfo;
    

    if($fechabuscar <= $fechainfo){

        $fechabm = date("d/m/Y", strtotime($fechab));
        // echo $fechab . '<br>';
        // echo $fechabm . '<br>';
    
        $sql2="SELECT SUM(pulgdiam) AS totpulg FROM datoswp WHERE fecha='$fechabm'";
        $eje=mysqli_query($conexion, $sql2);
        $obj = mysqli_fetch_object($eje);
    
        $porf = doubleval($obj->totpulg);
    
        $ejeacum+=$porf;

        // echo $ejeacum . '<br>';
    
        $solde[] = array(
            'fecha'=>$fechab,
            'ejeacum'=>doubleval($ejeacum),
            'ejedia'=>doubleval($porf)
        );
    }


}

// $newDate = date("d/m/Y", strtotime($fecha));
// echo $newDate;

// $sql2="SELECT * FROM datosw WHERE ";
// $exito=mysqli_query($conexion, $sql2);

$datos = array(
    'soldp'=>$soldp,
    'solde'=>$solde,
    'totsold'=>$totsold
);

echo json_encode($datos);
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM listalazso GROUP BY isometrico";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $lazo = $row->lazo;
    $isometrico = $row->isometrico;

    $sql2="SELECT * FROM listalazso WHERE lazo = '$lazo' AND isometrico = '$isometrico'";
    $exito2=mysqli_query($conexion, $sql2);

    while($obj = mysqli_fetch_object($exito2)){

        $item = $obj->item;
        $actividad = $obj->actividad;
        $firma = '[{"fechasup":"","horasup":"","nombresup":"","firmasup":"","registrosup":"", "fechaq":"","horaq":"","nombreq":"","firmaq":"","registroq":"", "fechaecp":"","horaecp":"","nombreecp":"","firmaecp":"","registroecp":""}]';
    
        $query = "INSERT INTO osLazos VALUES('', 'U-2800', 'VISCORREDUTORA II', '028', '$lazo', '$isometrico', $item, '', '', '', '$actividad', '$firma')";
        $eje = mysqli_query($conexion, $query);

    }

    $query2 = "INSERT INTO obsLazos VALUES('', '028', '$isometrico', '$lazo', '', '')";
    $eje2 = mysqli_query($conexion, $query2);

    $query3 = "INSERT INTO tags VALUES('', '028', 'U-2800', 'VISCORREDUTORA II', 'TUBERÍA', 'LAZOS DE CORROSIÓN', 'ALISTAMIENTO', '$lazo', '$isometrico', 'OS022-31')";
    $eje3 = mysqli_query($conexion, $query3);


}

    


echo json_encode($datos);
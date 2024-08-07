<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$user = $_POST["user"];
$clave = $_POST["clave"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM evaluacionpersonal order by nombre";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){

    $evaluador = $row->evaluador;

    $query = "SELECT * FROM userseval Where nombres = '$evaluador'";
    $cons = mysqli_query($conexion, $query);

    $obj = mysqli_fetch_object($cons);

    $cedula = $obj->clave;

    $firma = '<img src="http://italco.tk/recursoshumanos/firmas/'  . $cedula . '.jpg" height="60px">';

    $datos[] = array(
        'id'=>$row->id,
        'nombres'=>$row->nombre,
        'doc'=>$row->doc,
        'cargo'=>$row->cargo,
        'ods' => $row->ods,
        'fecha'=> $row->fecha,
        'pinicial'=> $row->pinicial,
        'pfinal'=>$row->pfinal,
        'evaluador'=>$row->evaluador,
        'cal'=>$row->cal,
        'observaciones'=>$row->observaciones,
        'compromisos'=>$row->compromisos,
        'planes'=>$row->planes,
        'p1'=>$row->p1,
        'p2'=>$row->p2,
        'p3'=>$row->p3,
        'p4'=>$row->p4,
        'p5'=>$row->p5,
        'p6'=>$row->p6,
        'p7'=>$row->p7,
        'p8'=>$row->p8,
        'p9'=>$row->p9,
        'p10'=>$row->p10,
        'p11'=>$row->p11,
        'p12a'=>$row->p12a,
        'p12b'=>$row->p12b,
        'p13'=>$row->p13,
        'p14'=>$row->p14,
        'firma'=>$firma
    );
}

echo json_encode($datos);
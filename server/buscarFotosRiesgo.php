<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$id = $_POST["id"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="SELECT * FROM aseguramientos WHERE id = $id";
$exito=mysqli_query($conexion, $sql);
$enc = mysqli_num_rows($exito);

$row = mysqli_fetch_object($exito);

$fotos = json_decode($row->soportes);

$cant = count($fotos);


for($i=0; $i<$cant; $i++){

    $archivo = 'https://utitalcobarranca.com/hse/archvos/'.$fotos[$i]->foto;
    $extension = pathinfo($archivo, PATHINFO_EXTENSION);
    
    $datos[] = array(
        'foto'=>$fotos[$i]->foto,
        'extension'=>$extension
    );

}

echo json_encode($datos);
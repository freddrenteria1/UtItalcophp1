<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM insp";
$exito=mysqli_query($conexion, $sql);


// $componentes[0] = json_decode($_POST["componentes"]);
// $criterios[0] = json_decode($_POST["criterios"]);

while($obj = mysqli_fetch_object($exito)){
    
    $componentes = json_decode($obj->componentes);
    $criterios = json_decode($obj->criterios);

    $datos[] =  array(
        'id'=>$obj->id,
        'fechainsp'=>$obj->fechainsp,
        'elemento'=>$obj->elemento,
        'marca'=>$obj->marca,
        'serial'=>$obj->serial,
        'fechafab'=>$obj->fechafab,
        'numprecant'=>$obj->numprecant,
        'numprecact'=>$obj->numprecact,
        'colorprec'=>$obj->colorprec,
        'estado'=>$obj->estado,
        'mantenimiento'=>$obj->mantenimiento,
        'partemetal'=>$componentes[0]->partemetal,
        'partepasta'=>$componentes[0]->partepasta,
        'partetextil'=>$componentes[0]->partetextil,
        'indicadoresimpacto'=>$componentes[0]->indicadoresimpacto,
        'costura'=>$componentes[0]->costura,
        'estadofichatec'=>$componentes[0]->estadofichatec,
        'estadogeneral'=>$componentes[0]->estadogeneral,
        'oxidometal'=>$criterios[0]->oxidometal,
        'argollasimpactadas'=>$criterios[0]->argollasimpactadas,
        'rupturapastas'=>$criterios[0]->rupturapastas,
        'corrometal'=>$criterios[0]->corrometal,
        'riatasimpactadas'=>$criterios[0]->riatasimpactadas,
        'hebillasimpactadas'=>$criterios[0]->hebillasimpactadas,
        'contactoquimicos'=>$criterios[0]->contactoquimicos,
        'quemaduras'=>$criterios[0]->quemaduras,
        'indicadorimpactado'=>$criterios[0]->indicadorimpactado,
        'observaciones'=>$obj->observaciones,
        'foto'=>$obj->foto,
        'evaluador'=>$obj->evaluador
    );
}

echo json_encode($datos);
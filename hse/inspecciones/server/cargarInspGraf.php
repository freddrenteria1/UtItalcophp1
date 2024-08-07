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

    if($componentes[0]->partemetal=='NO Conforme'){
        $partemetal++;
    }

    if($componentes[0]->partepasta=='NO Conforme'){
        $partepasta++;
    }

    if($componentes[0]->partetextil=='NO Conforme'){
        $partetextil++;
    }

    if($componentes[0]->indicadoresimpacto=='NO Conforme'){
        $indicadoresimpacto++;
    }

    if($componentes[0]->costura=='NO Conforme'){
        $costura++;
    }

    if($componentes[0]->estadofichatec=='NO Conforme'){
        $estadofichatec++;
    }

    if($componentes[0]->estadogeneral=='NO Conforme'){
        $estadogeneral++;
    }

    if($criterios[0]->oxidometal=='SI'){
        $oxidometal++;
    }

    if($criterios[0]->argollasimpactadas=='SI'){
        $argollasimpactadas++;
    }

    if($criterios[0]->rupturapastas=='SI'){
        $rupturapastas++;
    }

    if($criterios[0]->corrometal=='SI'){
        $corrometal++;
    }

    if($criterios[0]->riatasimpactadas=='SI'){
        $riatasimpactadas++;
    }

    if($criterios[0]->hebillasimpactadas=='SI'){
        $hebillasimpactadas++;
    }

    if($criterios[0]->contactoquimicos=='SI'){
        $contactoquimicos++;
    }

    if($criterios[0]->quemaduras=='SI'){
        $quemaduras++;
    }

    if($criterios[0]->indicadorimpactado=='SI'){
        $indicadorimpactado++;
    }

    if($obj->estado == 'Aprobado'){
        $aprobado++;
    }else{
        $rechazado++;
    }

    if($obj->colorprec == 'Azul'){
        $azul++;
    }else{
        $rojo++;
    }

    $total = $azul + $rojo;
    $porazul = (100 * $azul)/$total;
    $porrojo = (100 * $rojo)/$total;

    $totalinsp = $aprobado + $rechazado;
    $poraprobado = (100 * $aprobado)/$totalinsp;
    $porrechazado = (100 * $rechazado)/$totalinsp;
    
}

$datos =  array(
    'oxidometal'=>$oxidometal,
    'argollasimpactadas'=>$argollasimpactadas,
    'rupturapastas'=>$rupturapastas,
    'corrometal'=>$corrometal,
    'riatasimpactadas'=>$riatasimpactadas,
    'hebillasimpactadas'=>$hebillasimpactadas,
    'contactoquimicos'=>$contactoquimicos,
    'quemaduras'=>$quemaduras,
    'indicadorimpactado'=>$indicadorimpactado,
    'partemetal'=>$partemetal,
    'partepasta'=>$partepasta,
    'partetextil'=>$partetextil,
    'indicadoresimpacto'=>$indicadoresimpacto,
    'costura'=>$costura,
    'estadofichatec'=>$estadofichatec,
    'estadogeneral'=>$estadogeneral,
    'aprobados'=>$aprobado,
    'rechazados'=>$rechazado,
    'azul'=>$azul,
    'rojo'=>$rojo,
    'porazul'=>$porazul,
    'porrojo'=>$porrojo,
    'totalinsp'=>$totalinsp,
    'poraprobado'=>$poraprobado,
    'porrechazado'=>$porrechazado
);

echo json_encode($datos);
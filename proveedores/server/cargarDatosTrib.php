<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$msn = 'Ok';

$sql = "SELECT * FROM infotributaria WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'tipoact' => $obj->tipoact,
        'tipopersona' => $obj->tipopersona,
        'regimen' => $obj->regimen,
        'actprincipal' => $obj->actprincipal,
        'grancontri' => $obj->grancontri,
        'resgran' => $obj->resgran,
        'fecharesgran' => $obj->fecharesgran,
        'autoretenedor' => $obj->autoretenedor,
        'resauto' => $obj->resauto,
        'fecharesauto' => $obj->fecharesauto,
        'excentorete' => $obj->excentorete,
        'resexcentorete' => $obj->resexcentorete,
        'fecharesexcentorete' => $obj->fecharesexcentorete,
        'excentoica' => $obj->excentoica,
        'resexcentoica' => $obj->resexcentoica,
        'fecharesexcentoica' => $obj->fecharesexcentoica,
        'ciiu' => $obj->ciiu,
        'fechaciiu' => $obj->fechaciiu,
        'tarifaica' => $obj->tarifaica,
        'ciudadica' => $obj->ciudadica
    );

}

echo json_encode($datos);
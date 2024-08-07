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

$sql = "SELECT * FROM datosprov WHERE user = '$user'";
$eje = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    $obj = mysqli_fetch_object($eje);

    $datos = array(
        'empresa' => $obj->razon,
        'tipodoc' => $obj->tipodoc,
        'docemp' => $obj->docemp,
        'replegal' => $obj->replegal,
        'cedreplegal' => $obj->docreplegal,
        'dirofi' => $obj->diroficina,
        'tel' => $obj->telefonos,
        'email' => $obj->email,
        'web' => $obj->web,
        'pais' => $obj->pais,
        'ciudad' => $obj->ciudad,
        'nombcont' => $obj->contconta,
        'cargonombcont' => $obj->cargocontconta,
        'emailnombcont' => $obj->emailcontconta,
        'telnombcont' => $obj->telcontconta,
        'nombcom' => $obj->contcom,
        'cargonombcom' => $obj->cargocontcom,
        'emailnombcom' => $obj->emailcontcom,
        'telnombcom' => $obj->telcontcom,
        'tipocta' => $obj->tipoctabanco,
        'codbanco' => $obj->swift,
        'entidad' => $obj->banco,
        'numcuenta' => $obj->numcuenta,
        'titularcta' => $obj->titular
    );

}

echo json_encode($datos);
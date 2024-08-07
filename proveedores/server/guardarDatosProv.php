<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$empresa = $_POST["empresa"];
$tipodoc = $_POST["tipodoc"];
$docemp = $_POST["docemp"];
$replegal = $_POST["replegal"];
$cedreplegal = $_POST["cedreplegal"];
$dirofi = $_POST["dirofi"];
$tel = $_POST["tel"];
$email = $_POST["email"];
$web = $_POST["web"];
$pais = $_POST["pais"];
$ciudad = $_POST["ciudad"];
$nombcont = $_POST["nombcont"];
$cargonombcont = $_POST["cargonombcont"];
$emailnombcont = $_POST["emailnombcont"];
$telnombcont = $_POST["telnombcont"];
$nombcom = $_POST["nombcom"];
$cargonombcom = $_POST["cargonombcom"];
$emailnombcom = $_POST["emailnombcom"];
$telnombcom = $_POST["telnombcom"];
$tipocta = $_POST["tipocta"];
$codbanco = $_POST["codbanco"];
$entidad = $_POST["entidad"];
$numcuenta = $_POST["numcuenta"];
$titularcta = $_POST["titularcta"];


//GUARDA LA ENTRADA
$msn = 'Ok';

//verifica si el user ya existe y actualiza los campos

$consulta = "SELECT * FROM datosprov WHERE user = '$user'";
$ejec = mysqli_query($conexion, $consulta);

$enc = mysqli_num_rows($ejec);

if($enc == 0){
    $sql = "INSERT INTO datosprov VALUES('','$user','$fecha','$empresa','$tipodoc','$docemp','$replegal','$cedreplegal','$dirofi','$tel','$email','$web','$pais','$ciudad','$nombcont','$cargonombcont','$emailnombcont','$telnombcont','$nombcom','$cargonombcom','$emailnombcom','$telnombcom','$tipocta','$codbanco','$entidad','$numcuenta','$titularcta')";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}else{
    $sql = "UPDATE datosprov SET razon='$empresa', tipodoc='$tipodoc', docemp='$docemp', replegal='$replegal', docreplegal='$cedreplegal', diroficina='$dirofi', telefonos='$tel', email='$email', web='$web', pais='$pais', ciudad='$ciudad', contconta='$nombcont', cargocontconta='$cargonombcont', emailcontconta='$emailnombcont', telcontconta='$telnombcont', contcom='$nombcom', cargocontcom='$cargonombcom', emailcontcom='$emailnombcom', telcontcom='$telnombcom', tipoctabanco='$tipocta', swift='$codbanco', banco='$entidad', numcuenta='$numcuenta', titular='$titularcta' WHERE user='$user'";
    $guardar = mysqli_query($conexion, $sql);

    if(!$guardar){
        $msn = mysqli_error($conexion);
    }
}





$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);
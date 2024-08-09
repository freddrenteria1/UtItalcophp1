<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$turno = $_POST["turno"];
$pdir = $_POST["pdir"];
$pindir = $_POST["pindir"];
$equipos = $_POST["equipos"];
$aspectos = $_POST["aspectos"];
$novedades = $_POST["novedades"];
$fotos = $_POST["fotos"];


$query = "INSERT INTO bitacorares VALUES('', '$fecha', '$nombres', $doc, '$turno', $pdir, $pindir, '$equipos', '$aspectos', '$novedades', '$ods', '$fotos')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}

$texto = 'Registro de Bitacora Rescatistas por ' . $nombres . ' con los siguientes datos: <br><br>';

$texto .= 'Datos del registro: <br><br>';
$texto .= 'Fecha: ' . $fecha . '<br>';
$texto .= 'Turno: ' . $turno . '<br>';
$texto .= 'Personal Directo: ' . $pdir . '<br>';
$texto .= 'Personal Indirecto: ' . $pindir . '<br>';
$texto .= 'Equipos: ' . $equipos . '<br>';
$texto .= 'Aspectos relevantes: ' . $aspectos . '<br>';
$texto .= 'Novedades del turno: ' . $novedades . '<br>';

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='jairocruzprogramador@gmail.com';
$mail->Password='@3142141645';

$mail->setFrom('bitacoras@utitalco.tk','Sistema Bitacoras');
$mail->addAddress('planeadorbca11@utitalco.com');
$mail->addBCC('hsebca@utitalco.com');

$mail->CharSet = 'UTF-8';

$mail->isHTML(true);
$mail->Subject='Reporte Bitacora HSE UT Italco';
$mail->Body=$texto;

if(!$mail->send()){
    $msn = 'Email de confirmación no fue enviado...';
}else{
    $msn = 'Ok';
}

$msn = 'Ok';

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
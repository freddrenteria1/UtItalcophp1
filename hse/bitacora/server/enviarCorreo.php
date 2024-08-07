<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$texto = '<h1><img src="http://italco.tk/pruebapcr/server/logo_p.png" width="150px"> </h1>';
$texto .= '<h3>Registro Prueba PCR</h3>';

$texto .= 'Buenos días, con el fin de actualizar nuestra base de datos con respecto a las pruebas COVID-19, agradecemos diligenciar el siguiente link: <br><br>';

$texto .= '. <br><br>';

$texto .= '<a href="http://italco.tk/pruebapcr/">http://italco.tk/pruebapcr/</a>';


require 'PHPMailer/PHPMailerAutoload.php';


$mail = new PHPMailer;

$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='utitalcobarranca@gmail.com';
$mail->Password='@Aa11318';

$mail->setFrom('comunicados@utitalco.tk','Ut Italco');
$mail->addAddress('jairocruzprogramador@gmail.com');

$mail->CharSet = 'UTF-8';

$mail->isHTML(true);
$mail->Subject='Registros Pruebas COVID-19';
$mail->Body=$texto;


$query = "SELECT * FROM correos limit 400, 200";
$eje = mysqli_query($conexion, $query);

While($obj = mysqli_fetch_object($eje)){

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "comunicados@utitalco.tk";
    $to = "jairocruzprogramador@gmail.com";
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = "From:" . $from;
    mail($to,$subject,$message, implode("\r\n", $headers));
    echo "The email message was sent.";


    $email = $obj->correo;
    $mail->AddAddress($email); // Cargamos el e-mail destinatario a la clase PHPMailer
     

    if(!$mail->send()) {
        $msn = $mail->ErrorInfo;
        $error++;
    } else {
        $contador++;
        $msn = 'Enviado';
    }

    $sql = "UPDATE correos SET fecha='$fecha', estado='$msn' Where correo='$email'";
    $exito = mysqli_query($sql);

    $mail->ClearAddresses(); // Limpia los "Address" cargados previamente para volver a cargar uno.
}

$datos = array(
    'enviados'=>$contador,
    'error'=>$error
);

echo json_encode($datos);
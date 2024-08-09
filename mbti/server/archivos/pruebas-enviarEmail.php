<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar_.php"); 
$conexion=conectar();

$lista = json_decode($_POST["lista"]);

$tot = count($lista);

// ini_set( 'display_errors', 1 );
// error_reporting( E_ALL );

// for($i=0; $i < $tot; $i++){

// $para  = $lista[$i]->correo;
// //$para  = 'jcsistemascolombia@gmail.com';

// // Asunto
// $titulo = 'PRUEBA MBTI - UT ITALCO';

// // Cuerpo o mensaje
// $mensaje = '
// <html>
// <head>
// <title>PRUEBA MBTI - UT ITALCO</title>
// </head>
// <body>
// <img src="https://utitalco.com/biometricsystem/img/logo_p.png" width="200px">


//   <p>
//   Usted ha recibido la prueba MBTI por parte de la empresa: UNION TEMPORAL ITALCO, con el fin de gestionar su perfil Psicológico. Agradecemos dar clic en el siguiente enlace para ingresar.
//   <br><br>

//   '.$lista[$i]->link .'

//   <br><br>

// Recordamos el uso de computador o celular con cámara.  <br><br>


// Nota: La realización de la prueba no garantiza la vinculación con UT ITALCO. <br><br><br><br>


// Cordialmente  <br>
// PS. DIANA AGAMEZ RRHH <br><br>

// Cualquier Inquietud con el diligenciamiento de la prueba, por favor dirigirse al correo electrónico de la persona responsable de la prueba: psicologabca@utitalco.com

  
  
//   </body>
//   </html>
// ';

// // Cabecera que especifica que es un HMTL
// $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
// $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// // Cabeceras adicionales
// $cabeceras .= 'From: PRUEBA MBTI - UT ITALCO <pruebambti@utitalcobca.com>' . "\r\n";


// // enviamos el correo!
// // mail($para, $titulo, $mensaje, $cabeceras);

// echo $para . '<br>';
// echo $mensaje . '---------------------------------------------------------------------------------------------<br>';

// $datos[] = array(
//   'correo'=>$lista[$i]->correo,
//   'link'=>$lista[$i]->link
// );

// }


for($i=0; $i < $tot; $i++){

  $data[] = array(
      'correo'=>$lista[$i]->correo,
      'link'=>$lista[$i]->link
    );
}

$datos = array(
  'data'=>$data,
  'tot'=>$tot
);


echo json_encode($datos);

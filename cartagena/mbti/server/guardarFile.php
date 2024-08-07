<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = 'pruebas-';

// Ruta donde se guardar?n las im?genes
$directorio = 'archivos/';

// Recibo los datos de la imagen
$nombre = $_FILES['adjunto']['name'];
$tipo = $_FILES['adjunto']['type'];
$tamano = $_FILES['adjunto']['size'];

if(isset($_FILES['adjunto'])){
    // temporal al directorio definitivo
    move_uploaded_file($_FILES['adjunto']['tmp_name'],$directorio.$cadena.$nombre);
    $archivo=$cadena.$nombre;
}else{
    $archivo = '';
}

$msn = 'Ok';
$numeroDeFila = 1;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $archivo; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}else{

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {

            if($fila[0] != ''){

                $sql = "INSERT INTO pruebas VALUES('', '$fecha', '', '$fila[0]', '$fila[1]', 0, '', '$fila[2]', '', '', '', '', '', '')";
                $eje = mysqli_query($conexion, $sql);

                if(!$eje){
                    $msn = mysqli_error($conexion);
                }else{
                    $idreg = mysqli_insert_id($conexion);
                    $link = 'https://utitalco.com/cartagena/mbti/index.html?doc='.$fila[1].'&id='.$idreg;

                    $datospersonal[] = array(
                        'correo'=>$fila[3],
                        'link'=>$link
                    );

                }

            }


        }

        $numeroDeFila++;


    }

}

$datos = array(
    'msn'=>$msn,
    'listado'=>$datospersonal
);

echo json_encode($datos);
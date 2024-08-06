<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/html;charset=utf-8");

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = $fecha . '-';

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';

$nombre = 'valvulas.csv';

$excel=$directorio.$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

//$nombreArchivo = 'tags.csv';

# Abrir el archivo
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}else{
    #  Comenzar a leer, $numeroDeFila es para llevar un índice
    $msn = 'Datos importados correctamente!!!';
    $numeroDeFila = 1;

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {
            
            if($fila[0] != ''){
 
                $query = "INSERT INTO tags VALUES('', '028', 'U-2500', 'DEMEX', 'ESTÁTICO', 'VÁLVULAS DE SEGURIDAD', 'ALISTAMIENTO', '', '$fila[3]', 'OS02')";
                $eje = mysqli_query($conexion, $query);

                $query2 = "INSERT INTO os02 VALUES('', 'U-2500', '$fila[2]', '028', '$fila[3]', '$fila[4]','$fila[5]', '', '','','','','','')";
                $eje2 = mysqli_query($conexion, $query2);
                
                if(!$eje2){
                    $msn = mysqli_error($conexion);
                }

                
            }
        }

        # Aumentar el índice
        $numeroDeFila++;
          
    }

    # Al finar cerrar el gestor
    fclose($gestor);
}

$datos = array(
    'msn' => $msn
);
 
echo json_encode($msn);
<?php
//header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$cadena = $fecha . '-';

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$cadena.$nombre);
$excel=$cadena.$nombre;

$longitudDeLinea = 5000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}else{
    #  Comenzar a leer, $numeroDeFila es para llevar un índice
    $msn = 'Ok';
    $numeroDeFila = 1;

    //borra todas las marcaciones de la fecha
    $borrar = "DELETE FROM materiales";
    $ejeb2 = mysqli_query($conexion, $borrar);   

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {
            
            if($fila[0] != ''){

                $texto = $fila[1]; 
                $texto =  str_replace(';', ",", $texto);
                $texto =  str_replace("'", "", $texto);
                $det =  str_replace('"', "IN", $texto);

                $query = "INSERT INTO materiales VALUES('', '$fila[0]','$det','$fila[2]','$fila[3]','$det','$fila[5]','$fila[6]')";
                $eje = mysqli_query($conexion, $query);

                if(!$eje){
                    $msn = $fila[0] . ' - ' . mysqli_error($conexion);
                    break; 
                }else{
                    $totalcarg++;
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
    'msn' => $msn,
    'totalcarg' => $totalcarg
);
 
echo json_encode($datos);
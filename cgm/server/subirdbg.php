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
    $borrar = "DELETE FROM bdmateriales";
    $ejeb2 = mysqli_query($conexion, $borrar);   

    while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {

        if ($numeroDeFila > 1) {
            
            if($fila[0] != ''){

                $texto = $fila[4]; 
                $texto =  str_replace(';', ",", $texto);
                $texto =  str_replace("'", "", $texto);
                $det =  str_replace('"', "IN", $texto);

                $texto2 = $fila[15];

                $det2 = preg_replace('([^A-Za-z0-9])', ' ', $texto2);
                

                $query = "INSERT INTO bdmateriales VALUES('', '$fila[0]','$fila[1]','$fila[2]','$fila[3]','$det','$fila[5]','$fila[6]','$fila[7]','$fila[8]','$fila[9]','$fila[10]','$fila[11]','$fila[12]','$fila[13]','$fila[14]','$det2','$fila[16]','$fila[17]','$fila[18]','$fila[19]','$fila[20]','$fila[21]','$fila[22]','','')";
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
<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$cadena = $ods . '-' . $fecha . '-';

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$cadena.$nombre);
$excel=$cadena.$nombre;

$longitudDeLinea = 3000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

$msn = 'Ok';


while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

        
        if($fila[1] != ''){

            $ced = $fila[1];

            //busca la cedula

            $buscar = "SELECT * FROM trabajadores Where cedula = '$ced'";
            $ex = mysqli_query($conexion, $buscar);

            $enc = mysqli_num_rows($ex);

            if($enc == 0){
                $query = "INSERT INTO trabajadores VALUES('', '$fila[0]', '$fila[1]','$fila[2]','$fila[3]','$fila[4]','$fila[5]','$fila[6]','$fila[7]','$fila[8]','$fila[9]','$fila[10]','$fila[11]','$fila[12]','$fila[13]','$fila[14]','$fila[15]','','$fila[17]','$fila[18]','','$fila[20]')";
                $eje = mysqli_query($conexion, $query);
            }else{
                $cons = "UPDATE trabajadores SET fingreso='$fila[10]', frente = '', supervisor='$fila[17]', frentetrab = '$fila[19]', estado='$fila[20]', ods = '$fila[18]' Where cedula = '$ced'";
                $ejec = mysqli_query($conexion, $cons);
            }
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }
    
     # Aumentar el índice
     $numeroDeFila++;
}

# Al finar cerrar el gestor
fclose($gestor);

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
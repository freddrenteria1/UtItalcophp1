<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fechamod=date("Y-m-d h:m:s");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$fechacargue = $_POST["fecha"];

if($fechacargue == ''){
    $fechacargue = $fecha;
}

// Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// Recibo los datos de la imagen
$nombre = $_FILES['excel']['name'];
$tipo = $_FILES['excel']['type'];
$tamano = $_FILES['excel']['size'];

// temporal al directorio definitivo
move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$nombre);
$excel=$nombre;

$longitudDeLinea = 15000;
$delimitador = ";"; # Separador de columnas
$caracterCircundante = '"'; # A veces los valores son encerrados entre comillas
$nombreArchivo = $excel; #Ruta del archivo, en este caso está junto a este script

# Abrir el archivo
$gestor = fopen($directorio.$nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 7;
$contb = 0;

$sql = "DELETE FROM ccdesmantelamiento WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$contb++;

$msn = 'Realizado...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    

        if($fila[0] != ''){

            $query = "INSERT INTO ccdesmantelamiento VALUES('', '$fila[0]', '$fila[1]', '$fila[6]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[10]', '$fila[11]', '$fechacargue')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    
    
    # Aumentar el índice
    $numeroDeFila++;
}


# Al finar cerrar el gestor
fclose($gestor);

$sql = "INSERT INTO bitacoraccdesmante VALUES('', '$user', '$fechamod', '$excel')";
$exito = mysqli_query($conexion, $sql);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
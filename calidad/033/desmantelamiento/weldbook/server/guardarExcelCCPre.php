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
$numeroDeFila = 1;
$contb = 0;

$sql = "DELETE FROM ccplaterales WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccppiso WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccpfrontal WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccptecho WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccppantalla WHERE fecha = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);


$contb++;

$msn = 'Realizado...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila == 8 || $numeroDeFila == 18 ||  $numeroDeFila == 24 ||  $numeroDeFila == 34 ||  $numeroDeFila == 44 ||  $numeroDeFila == 45 ||  $numeroDeFila == 46) {

        if($fila[1] != ''){

            $query = "INSERT INTO ccplaterales VALUES('', $fila[1], '$fila[2]', '$fila[7]', '$fila[8]', '$fila[10]', '$fechacargue', '$fila[12]', '$fila[13]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila == 51 || $numeroDeFila == 61 ||  $numeroDeFila == 67 ||  $numeroDeFila == 77 ||  $numeroDeFila == 87 ||  $numeroDeFila == 90 ||  $numeroDeFila == 99) {

        if($fila[1] != ''){

            $query = "INSERT INTO ccppiso VALUES('', $fila[1], '$fila[2]', '$fila[7]', '$fila[8]', '$fila[10]', '$fechacargue', '$fila[12]', '$fila[13]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila == 114 || $numeroDeFila == 124 ||  $numeroDeFila == 130 ||  $numeroDeFila == 140 ||  $numeroDeFila == 150 ||  $numeroDeFila == 153 ||  $numeroDeFila == 162) {

        if($fila[1] != ''){

            $query = "INSERT INTO ccpfrontal VALUES('', $fila[1], '$fila[2]', '$fila[7]', '$fila[8]', '$fila[10]', '$fechacargue', '$fila[12]', '$fila[13]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila == 177 || $numeroDeFila == 187 ||  $numeroDeFila == 193 ||  $numeroDeFila == 203 ||  $numeroDeFila == 213 ||  $numeroDeFila == 216 ||  $numeroDeFila == 225) {

        if($fila[1] != ''){

            $query = "INSERT INTO ccptecho VALUES('', $fila[1], '$fila[2]', '$fila[7]', '$fila[8]', '$fila[10]', '$fechacargue', '$fila[12]', '$fila[13]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila == 240 || $numeroDeFila == 250 ||  $numeroDeFila == 256 ||  $numeroDeFila == 266 ||  $numeroDeFila == 276 ||  $numeroDeFila == 279 ||  $numeroDeFila == 288) {

        if($fila[1] != ''){

            $query = "INSERT INTO ccppantalla VALUES('', $fila[1], '$fila[2]', '$fila[7]', '$fila[8]', '$fila[10]', '$fechacargue', '$fila[12]', '$fila[13]')";
            $eje = mysqli_query($conexion, $query);
    
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

$sql = "INSERT INTO bitacoraccpre VALUES('', '$user', '$fechamod', '$excel')";
$exito = mysqli_query($conexion, $sql);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
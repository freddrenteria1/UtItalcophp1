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

$sql = "DELETE FROM ccmbanco WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmparedpiso WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmparedeslat WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmparedquema WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmparedpantalla WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmparedtecho WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmcalentador WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);

$sql = "DELETE FROM ccmriser WHERE fechacargue = '$fechacargue'";
$exit = mysqli_query($conexion, $sql);


$contb++;

$msn = 'Realizado...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila >= 7 && $numeroDeFila <= 11) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmbanco VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila >= 15 && $numeroDeFila <= 21) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmparedpiso VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    // if ($numeroDeFila >= 25 && $numeroDeFila <= 31) {

    //     if($fila[2] != ''){

    //         $query = "INSERT INTO ccmparedeslat VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
    //         $eje = mysqli_query($conexion, $query);
    
    //         if(!$eje){
    //             $msn = mysqli_error($conexion);
    //         }
            
    //     }

    // }

    // if ($numeroDeFila >= 35 && $numeroDeFila <= 41) {

    //     if($fila[2] != ''){

    //         $query = "INSERT INTO ccmparedquema VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
    //         $eje = mysqli_query($conexion, $query);
    
    //         if(!$eje){
    //             $msn = mysqli_error($conexion);
    //         }
            
    //     }

    // }

    if ($numeroDeFila >= 25 && $numeroDeFila <= 31) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmparedpantalla VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila >= 35 && $numeroDeFila <= 41) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmparedtecho VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila >= 45 && $numeroDeFila <= 51) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmcalentador VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
            $eje = mysqli_query($conexion, $query);
    
            if(!$eje){
                $msn = mysqli_error($conexion);
            }
            
        }

    }

    if ($numeroDeFila >= 55 && $numeroDeFila <= 61) {

        if($fila[2] != ''){

            $query = "INSERT INTO ccmriser VALUES('', '$fila[1]', '$fila[2]', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[11]', '$fila[12]', '$fila[13]', '$fechacargue', '$fila[10]')";
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

$sql = "INSERT INTO bitacoraccmontaje VALUES('', '$user', '$fechamod', '$excel')";
$exito = mysqli_query($conexion, $sql);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
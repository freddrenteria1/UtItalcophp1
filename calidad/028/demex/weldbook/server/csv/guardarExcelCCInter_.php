<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d h:m:s");

$user = $_POST["user"];

// // Ruta donde se guardar?n las im?genes
$directorio = 'csv/';
// // Recibo los datos de la imagen
// $nombre = $_FILES['excel']['name'];
// $tipo = $_FILES['excel']['type'];
// $tamano = $_FILES['excel']['size'];

// // temporal al directorio definitivo
// move_uploaded_file($_FILES['excel']['tmp_name'],$directorio.$nombre);

$excel='FRM-BCA-19.370.3.OS35 CC Intercambiadores V3 Demex.csv';

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
$numeroDeFila = 0;
$contb = 0;

$msn = 'Realizado...';

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 15) {

        if($contb == 0){
            $sql = "DELETE FROM ccinter";
            $exit = mysqli_query($conexion, $sql);
            
            $contb++;
        } 
        
        $tag = trim($fila[2]);
        $alcance = trim($fila[3]);
        $tipo = trim($fila[4]);
        $desc = trim($fila[6]);

        if($fila[2] != ''){

            echo  '$tag' . '<br>';

            $query = "INSERT INTO ccinter VALUES('', $fila[0], '$fila[1]', '$tag', '$alcance', '$tipo', '$fila[5]', '$desc', '$fila[7]', '$fila[8]', '$fila[9]', '$fila[10]', '$fila[11]', '$fila[12]', '$fila[13]', '$fila[14]', '$fila[15]', '$fila[16]', '$fila[17]', '$fila[18]', '$fila[19]', '$fila[20]', '$fila[21]', '$fila[22]', '$fila[23]', '$fila[24]', '$fila[25]', '$fila[26]', '$fila[27]', '$fila[28]', '$fila[29]', '$fila[30]', '$fila[31]', '$fila[32]', '$fila[33]', '$fila[34]', '$fila[35]', '$fila[36]', '$fila[37]', '$fila[38]', '$fila[39]', '$fila[40]', '$fila[41]', '$fila[42]', '$fila[43]', '$fila[44]', '$fila[45]', '$fila[46]', '$fila[47]', '$fila[48]', '$fila[49]', '$fila[50]', '$fila[51]', '$fila[52]', '$fila[53]', '$fila[54]', '$fila[55]', '$fila[56]', '$fila[57]', '$fila[58]', '$fila[59]', '$fila[60]', '$fila[61]', '$fila[62]', '$fila[63]', '$fila[64]', '$fila[65]', '$fila[66]', '$fila[67]', '$fila[68]', '$fila[69]', '$fila[70]', '$fila[71]', '$fila[72]', '$fila[73]', '$fila[74]', '$fila[75]', '$fila[76]', '$fila[77]', '$fila[78]', '$fila[79]', '$fila[80]', '$fila[81]', '$fila[82]', '$fila[83]')";
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

$sql = "INSERT INTO bitacoraccinter VALUES('', '$user', '$fecha', '$excel')";
$exito = mysqli_query($conexion, $sql);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);
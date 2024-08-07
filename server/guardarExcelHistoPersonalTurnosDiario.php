<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$cadena = 'personaldia' . $ods . $fecha;

// Ruta donde se guardar?n las im?genes
$directorio = './';
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
$gestor = fopen($nombreArchivo, "r");
if (!$gestor) {
    $msn = "No se puede abrir el archivo " . $nombreArchivo;
}

#  Comenzar a leer, $numeroDeFila es para llevar un índice
$numeroDeFila = 1;

$msn = 'Realizado...';

//echo 'Cargando.... un momento por favor...';
$sql = "DELETE FROM turnosdiarios WHERE ods='$ods' and fecha = '$fecha'";
$exito = mysqli_query($conexion, $sql);

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {

        $fila[3] = trim($fila[3]);

        $query = "INSERT INTO turnosdiarios VALUES('', '$fecha', '$fila[1]', '$fila[2]', '$fila[3]', $fila[4], $fila[5], $fila[6], $fila[7], $fila[8], $fila[9], '$ods')";
        $eje = mysqli_query($conexion, $query);

        if($fila[3] == 'ECOPETROL'){
            $pdirp += $fila[4];
            $pindirp += $fila[5];
            $ptotalp += $fila[6];
            $hdirp += $fila[7];
            $hindirp += $fila[8];
            $thhp += $fila[9];
        }

        if($fila[3] == 'ITALCO'){
            $pdirg += $fila[4];
            $pindirg += $fila[5];
            $ptotalg += $fila[6];
            $hdirg += $fila[7];
            $hindirg += $fila[8];
            $thhg += $fila[9];
        }

        if(!$eje){
            $msn = mysqli_error($conexion);
        }

    }
    
    # Aumentar el índice
    $numeroDeFila++;
}
# Al finar cerrar el gestor
fclose($gestor);

$sql = "DELETE FROM personaldiario WHERE ods='$ods' and fecha = '$fecha'";
$exito = mysqli_query($conexion, $sql);

$query = "INSERT INTO personaldiario VALUES('', '$fecha', '$ods', 'ECOPETROL', '7:00 AM A 5:00 PM', $pdirp, $pindirp, $ptotalp, $hdirp, $hindirp, $thhp)";
$eje = mysqli_query($conexion, $query);

$query = "INSERT INTO personaldiario VALUES('', '$fecha', '$ods', 'ITALCO', '7:00 AM A 5:00 PM', $pdirg, $pindirg, $ptotalg, $hdirg, $hindirg, $thhg)";
$eje = mysqli_query($conexion, $query);

$sumaHorasDirectos = $hdirp + $hdirg;
$sumaHorasIndirectos = $hindirp + $hindirg;
$totalhoras = $sumaHorasDirectos + $sumaHorasIndirectos;

$totalPersonal = $ptotalp + $ptotalg;


$sql = "DELETE FROM horasacumuladas WHERE fecha = '$fecha' AND ods = '$ods'";
$eje = mysqli_query($conexion, $sql);

//SE GUARDA EL ACUMULADO SI LA FECHA ES DIFERENTE DE 0000-00-00 Y TOTAL HORAS DIFERENTE DE 0

$query = "INSERT INTO horasacumuladas VALUES('', $sumaHorasDirectos, $sumaHorasIndirectos, $totalhoras, '$fecha', '$ods')";
$eje = mysqli_query($conexion, $query);



$datos = array(
    'msn' => $msn,
    'tot' => $totalPersonal
);
 
echo json_encode($datos);
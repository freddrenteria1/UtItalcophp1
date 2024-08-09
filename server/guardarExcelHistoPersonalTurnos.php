<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$fecha = $_POST["fecha"];

$cadena = 'hitopersonalturnos' . $ods . $fecha;

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
$sql = "DELETE FROM personalturnos WHERE ods='$ods' and fecha = '$fecha'";
$exito = mysqli_query($conexion, $sql);

while (($fila = fgetcsv($gestor, $longitudDeLinea, $delimitador, $caracterCircundante)) !== false) {
    
    if ($numeroDeFila > 1) {


        $query = "INSERT INTO personalturnos VALUES('', '$fila[1]', '$fila[2]', '$fila[3]', '$fila[4]', '$fila[5]', '$fila[6]', '$fila[7]', $fila[8], '$fecha', '$ods')";
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

$query="SELECT * FROM personalturnos WHERE ods='$ods' AND fecha = '$fecha'";
$eje=mysqli_query($conexion, $query);
$cant = mysqli_num_rows($eje);

$sumaDirectos = 0;
$sumaHorasDirectos = 0;
$sumaIndirectos = 0;
$sumaHorasIndirectos = 0;

while ($row = mysqli_fetch_object($eje)){

    if($row->recurso == 'DIRECTO'){
        $sumaDirectos++;
        $sumaHorasDirectos += $row->horashombre;
    }

    if($row->recurso == 'INDIRECTO'){
        $sumaIndirectos++;
        $sumaHorasIndirectos += $row->horashombre;
    }

}

$totalPersonal = $sumaDirectos + $sumaIndirectos;
$totalhoras = $sumaHorasDirectos + $sumaHorasIndirectos;

//borra si existe y guarda de nuevo

if($cant != 0){

$sql = "DELETE FROM horasacumuladas WHERE fecha = '$fecha' AND ods = '$ods'";
$eje = mysqli_query($conexion, $sql);

//SE GUARDA EL ACUMULADO SI LA FECHA ES DIFERENTE DE 0000-00-00 Y TOTAL HORAS DIFERENTE DE 0

$query = "INSERT INTO horasacumuladas VALUES('', $sumaHorasDirectos, $sumaHorasIndirectos, $totalhoras, '$fecha', '$ods')";
$eje = mysqli_query($conexion, $query);

}




$datos = array(
    'msn' => $msn,
    'tot' => $totalPersonal
);
 
echo json_encode($datos);